<?php

namespace App\Http\Controllers;

use DateTime;
use App\Exports\SuratExport;
use App\Models\Surat;
use App\Models\SuratDetail;
use App\Models\TemplateSurat;
use App\Models\KondisiSurat;
use App\Models\KondisiSuratDetail;
use App\Models\TemplateSuratAttr;
use Carbon\Carbon;
use DB;
use Excel;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class SuratController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Surat::query();
        $filter = [
            'id' => '',
            'template_surat_id' => '',
            'created_at' => '',
        ];
        $role = Auth::user()->roles->pluck('name')[0];
        if ($role == "User") {
            $list = $list->where('user_id', '=', Auth::user()->id);
        }

        if ($request->id) {
            $list = $list->where('id', '=', $request->id);
            $filter['id'] = $request->id;
        }
        if ($request->template_surat_id != "") {
            $list = $list->where('template_surat_id', '=', $request->template_surat_id);
            $filter['template_surat_id'] = $request->template_surat_id;
        }
        if ($request->created_at) {
            $list = $list->whereDate('created_at', $request->created_at);
            $filter['created_at'] = $request->created_at;
        }

        $list = $list->with(['template_surat'])->orderBy('created_at', 'DESC')->paginate('10');
        $listTemplateSurat = TemplateSurat::all();
        $count = $list->count();
        $user = Auth::user();
        return view('surat/index', compact('list', 'listTemplateSurat', 'count', 'filter', 'user'));
    }

    public function create()
    {
        $listTemplateSurat = TemplateSurat::where('is_active', '1')->get();
        // dd($listTemplateSurat);
        return view('surat/create', compact('listTemplateSurat'));
    }

    public function onChangeTypeSurat(Request $request)
    {
        $details = TemplateSurat::find($request->id);


        return response()->json(['data' => [
            'details' => $details->TemplateSuratDetails()->get(),
            'surat' => $details,
        ]]);
    }

    public function getDetailSuratValueBySuratIdAndTagCode($suratId, $tagCode)
    {
        return SuratDetail::where("surat_id", $suratId)
            ->where("tag", $tagCode)
            ->first()
            ->value;
    }

    public static function checkCondition($leftValue, $operator, $rightValue): bool
    {
        // Default to empty string if null values are passed
        $leftValue = $leftValue ?? '';
        $rightValue = $rightValue ?? '';

        // Check if both values are in 'Y-m-d' date format
        if (self::isDateOnly($leftValue) && self::isDateOnly($rightValue)) {
            try {
                // dd('test');
                // Create Carbon instances from the 'Y-m-d' format
                $leftValue = Carbon::parse($leftValue)->startOfDay();  // Ensure it's at the start of the day (for date-only comparison)
                $rightValue = Carbon::parse($rightValue)->startOfDay(); // Same here for the right value
            } catch (\Exception $e) {
                // Log or handle the error as needed
                return false; // Invalid date format encountered
            }
        }
        // Check if both are numeric values
        elseif (is_numeric($leftValue) && is_numeric($rightValue)) {
            $leftValue = (float) $leftValue;
            $rightValue = (float) $rightValue;
        }

        // Perform the comparison based on the operator
        switch ($operator) {
            case '=':
                return $leftValue == $rightValue;
            case '>':
                return $leftValue > $rightValue;
            case '<':
                return $leftValue < $rightValue;
            case '>=':
                return $leftValue >= $rightValue;
            case '<=':
                return $leftValue <= $rightValue;
            case '<>':
                return $leftValue != $rightValue;
            default:
                return false; // Return false for invalid operators
        }
    }

    // ✅ Only match if format is 'Y-m-d' and a valid date
    private static function isDateOnly($value): bool
    {
        try {
            // Attempt to parse the date with 'Y-m-d' format
            $d = Carbon::createFromFormat('Y-m-d', $value);

            // Check if it matches the expected format
            return $d->format('Y-m-d') === $value;
        } catch (\Exception $e) {
            // Return false if the value is not a valid date
            return false;
        }
    }

    public function getDataOnPrint(Request $request)
    {
        $data = Surat::find($request->id);
        $isRePrint = $data->code_surat_printed != null;
        $bodySurat = $isRePrint ? $data->body_surat_printed : $data->body_surat;
        // dd($bodySurat);
        $templateSurat = TemplateSurat::find($data->template_surat_id);
        $conditions = KondisiSurat::where("template_surat_id", $data->template_surat_id)->get();
        $codeSurat = $this->getCodeSurat($data, $templateSurat, $isRePrint);

        $arrMonth = $this->getMonthArray();
        $document = [];

        // Process conditions
        foreach ($conditions as $condition) {
            $bodySurat = $this->processCondition($condition, $bodySurat, $data);
        }
        // Process surat details
        $bodySurat = $this->processSuratDetails($data, $bodySurat, $document);
        //dd($data->detail());
        // Generate new codeSurat if not reprint
        if (!$isRePrint) {
            $codeSurat = $this->generateCodeSurat($bodySurat, $data, $arrMonth, $codeSurat);
        }

        // $bodySurat = $this->removeParagraFromSurat($bodySurat);
        $bodySurat = $this->replaceTanggalCetak($bodySurat);

        return response()->json(['data' => [
            'bodySurat' => $bodySurat,
            'document' => $document,
            'codeSurat' => $codeSurat,
            'jenisSurat' => $templateSurat->type_surat,
            'isRePrint' => $isRePrint,
        ]]);
    }

    private function replaceTanggalCetak($bodySurat)
    {
        setlocale(LC_TIME, 'id_ID.utf8'); // Set lokal Bahasa Indonesia
        $tanggal = $this->replaceMonthToIndonesian(now());
        $hasil = str_replace('[TANGGALCETAK]', $tanggal, $bodySurat); // Ganti dengan tanggal
        $hasil = str_replace('[<span>TANGGALCETAK</span><span>]</span>', $tanggal, $hasil); // Ganti dengan tanggal

        // dd($hasil);
        return $hasil;
    }

    public function replaceMonthToIndonesian($date)
    {
        $months = [
            'January'   => 'Januari',
            'February'  => 'Februari',
            'March'     => 'Maret',
            'April'     => 'April',
            'May'       => 'Mei',
            'June'      => 'Juni',
            'July'      => 'Juli',
            'August'    => 'Agustus',
            'September' => 'September',
            'October'   => 'Oktober',
            'November'  => 'November',
            'December'  => 'Desember'
        ];

        $date = Carbon::parse($date)->format('d F Y'); // Format: "02 June 2025"
        $tanggal = strtr($date, $months); // Hasil: "02 Juni 2025"
        return $tanggal;
    }

    private function getCodeSurat($data, $templateSurat, $isRePrint)
    {
        return !$isRePrint ? $templateSurat->code_surat : $data->code_surat_printed;
    }

    private function getMonthArray()
    {
        return [
            '01' => 'I',
            '02' => 'II',
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
        ];
    }

    private function processCondition($condition, $bodySurat, $data)
    {
        $isTrueCondition = true;
        // dd($condition);
        // Retrieve condition details once
        $conditionDetails = KondisiSuratDetail::where("kondisi_surat_id", $condition->id)->get();
        foreach ($conditionDetails as $conditionDetail) {
            $getValueByTag = $this->getDetailSuratValueBySuratIdAndTagCode($data->id, $conditionDetail->tag_surat_detail);

            // Determine if condition matches based on logical operator
            $currentConditionResult = $this->checkCondition($getValueByTag, $conditionDetail->kondisi, $conditionDetail->value);
            // var_dump($condition->logical_operator);
            // dd($currentConditionResult);
            // Handle logical operators
            if ($condition->logical_operator == "AND" && !$currentConditionResult) {
                $isTrueCondition = false;
                break;
            }

            if ($condition->logical_operator == "OR" && $currentConditionResult) {
                $isTrueCondition = true;
                break;
            }
        }
        // dd($isTrueCondition);
        // If condition logic is based on AND, ensure it stays true throughout
        if ($condition->logical_operator == "AND" && !$isTrueCondition) {
            return $this->replaceWrappedSpanWithText($condition->code, "", $bodySurat); // Skip this condition if it fails for AND
        }
        // dd($this->replaceWrappedSpanWithText("[" . $condition->code . "]"));
        // dd($condition->code);
        // Replace the bodySurat based on the condition result
        return $isTrueCondition
            ? $this->replaceWrappedSpanWithText($condition->code, $condition->desc, $bodySurat)
            : $this->replaceWrappedSpanWithText($condition->code, "", $bodySurat);
    }

    function replaceWrappedSpanWithText(string $searchText, string $replacementText, string $source): string
    {
        $strReplace = str_replace("[" . $searchText . "]", $replacementText, $source);
        $strReplace = str_replace("[<span>" . $searchText . "</span>]", $replacementText, $strReplace);
        $strReplace = str_replace("[<span>" . $searchText . "</span><span>]</span>", $replacementText, $strReplace);

        // dd($strReplace);
        return $strReplace;
    }

    function cleanHtmlToText(string $html): string
    {
        // 1. Remove all HTML tags
        $text = strip_tags($html);

        // 2. Decode HTML entities (like &nbsp;, &lt;, etc.)
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // 3. Remove invisible control characters (non-printable ASCII)
        $text = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $text);

        // 4. Trim whitespace
        $text = trim($text);

        return $text;
    }

    private function processSuratDetails($data, $bodySurat, &$document)
    {
        foreach ($data->detail()->get() as $value) {
            // Handle different input types using a switch statement
            switch ($value->input_type) {
                case 'text':
                    $bodySurat = str_replace($this->cleanHtmlToText("[" . $value->tag . "]"), $value->value, $bodySurat);
                    break;

                case 'date':
                    $formattedDate = date("d F Y", strtotime($value->value));
                    $bodySurat = str_replace($this->cleanHtmlToText("[" . $value->tag . "]"), $formattedDate, $bodySurat);
                    break;

                case 'document':
                    $value->value = url('/document/archive/') . "/" . $value->value;
                    $document[] = $value; // Push the document value into the document array
                    break;

                default:
                    // For any other input type, replace the tag with the value
                    $bodySurat = str_replace($this->cleanHtmlToText("[" . $value->tag . "]"), $value->value, $bodySurat);
                    break;
            }
        }

        return $bodySurat;
    }


    private function generateCodeSurat($bodySurat, $data, $arrMonth, $codeSurat)
    {
        $year = date("Y-m-d");
        $month = $arrMonth[date("m")];
        $counterCode = DB::table('surat as s')
            ->join('template_surat as ts', 's.template_surat_id', '=', 'ts.id')
            ->whereYear('s.printed_at', $year)
            ->whereNotNull('s.code_surat_printed')
            ->where('ts.code_surat', $codeSurat)
            ->count();


        $codeSurat = str_replace('[TAHUN]', date('Y'), $codeSurat);
        $codeSurat = str_replace('[BULAN]', $month, $codeSurat);
        $codeSurat = str_replace('[URUTAN]', str_pad($counterCode + 1, 3, "0", STR_PAD_LEFT), $codeSurat);

        return $codeSurat;
    }

    public function getPathFolder()
    {
        $now = new DateTime();

        $year = (int) $now->format("Y");
        $month = (int) $now->format("n");
        $day = (int) $now->format("j");

        return $year . "/" . $month . "/" . $day;
    }

    public function store(Request $request)
    {

        $formatFolderDocument = $this->getPathFolder();

        $message = [
            'template_surat_id.required' => '*Tipe Surat Wajib Diisi',
        ];

        $arrValidate = [
            'template_surat_id' => 'required',
        ];
        if ($request->detail != null && count($request->detail) > 0) {
            foreach ($request->detail as $key => $value) {
                if ($value['input_type'] != 'dokumen') {
                    $message['detail.' . $key . '.value'] = '*' . $value['label'] . ' Wajib Diisi';
                    $arrValidate['detail.' . $key . '.value'] = 'required';
                }
            }
        }


        $this->validate($request, $arrValidate, $message);

        $templateSurat = TemplateSurat::find($request->template_surat_id);
        $reqSurat = [
            'template_surat_id' => $templateSurat->id,
            'body_surat' => $templateSurat->body_surat,
            'user_id' => Auth::id(),
        ];

        $respSurat = Surat::create($reqSurat);
        if ($request->detail != null && count($request->detail) > 0) {
            foreach ($request->detail as $key => $value) {
                $reqDetail = $value;
                $reqDetail['surat_id'] = $respSurat->id;
                if ($value['input_type'] == 'document' && $request->hasfile('detail.' . $key . '.value')) {
                    $originalFile = $request->file('detail.' . $key . '.value');
                    $file = $originalFile;
                    $fileName = $reqDetail['surat_id'] . '-' . $value['tag'] . $originalFile->getClientOriginalName();
                    // dd($fileName);
                    Storage::disk('document')->putFileAs('archive/' . $formatFolderDocument, $file, $fileName);
                    $reqDetail['value'] = $formatFolderDocument . "/" . $fileName;
                }

                $respSuratDetail = SuratDetail::create($reqDetail);
            }
        }

        return redirect('/surat/');
    }

    public function generateSuratPdf(Request $request)
    {
        $surat = Surat::find($request->id);
        $dataTemplate = TemplateSurat::findOrFail($surat->template_surat_id);
        $templateSuratAttr = TemplateSuratAttr::where('template_surat_id', $surat->template_surat_id)
            ->get();

        // $request->bodySurat = $this->removeParagraFromSurat($request->bodySurat);
        // dd($dataTemplate);
        $data = [
            'jenisSurat' => $request->jenisSurat,
            'codeSurat' => $request->codeSurat,
            'bodySurat' => $request->bodySurat,
            'templateSuratAttrs' => $templateSuratAttr,
            'paperSize' => $dataTemplate->letter_size
        ];

        $dataUpdate = [];
        $dataUpdate['id'] = $request->id;
        $dataUpdate['printed_at'] = Carbon::now()->addHours(7)->format('Y-m-d H:i:s'); // Also works

        $dataUpdate['last_admin_print'] = Auth::id();
        if ($surat->code_surat_printed == null) {
            $dataUpdate['code_surat_printed'] = $request->codeSurat;
            $dataUpdate['body_surat_printed'] = $request->bodySurat;
        }

        // dd($dataTemplate);
        $surat->update($dataUpdate);
        $templateHeaderType = $dataTemplate->type_header;

        // return view('surat/generatePDFTypeHeader' . $templateHeaderType, $data);

        $nameTemplate = "generatePDFTypeHeader" . $templateHeaderType;
        // dd($nameTemplate);
        $pdf = PDF::loadView('surat/' . $nameTemplate, $data);
        // dd($dataTemplate);
        $pdf->setPaper($dataTemplate->letter_size, "potrait");

        return $pdf->download(str_replace(" ", "", $request->codeSurat) . '-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $surat = Surat::find($id);
        $suratDetail = $surat->detail()->get();
        $listTemplateSurat = TemplateSurat::all();

        return view('surat/edit', compact('surat', 'suratDetail', 'listTemplateSurat'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->except('_token', 'submit', 'detail');
        $dataSuratDetail = $request->detail;

        $formatFolderDocument = $this->getPathFolder();


        foreach ($dataSuratDetail as $key => $value) {
            $reqDetail = $value;
            $reqDetail['surat_id'] = $request->id;

            if ($value['input_type'] == 'document' && $request->hasfile('detail.' . $key . '.value')) {
                $originalFile = $request->file('detail.' . $key . '.value');
                $file = $originalFile;
                $fileName = $reqDetail['surat_id'] . '-' . $value['tag'] . $originalFile->getClientOriginalName();
                Storage::disk('document')->putFileAs('archive/' . $formatFolderDocument, $file, $fileName);
                $reqDetail['value'] = $formatFolderDocument . "/" .  $fileName;
            }
            $suratDetail = SuratDetail::findOrFail($reqDetail['id']);
            $suratDetail->update($reqDetail);
        }

        return redirect('/surat/');
    }

    public function generateReportExcel(Request $request)
    {
        // dd($request);
        $conditionTemplateSurat = $request->template_surat_id != 'all' ? "and a.template_surat_id = " . $request->template_surat_id : "";
        $query = "SELECT a.id, b.type_surat, a.code_surat_printed, a.printed_at, usr.name AS pemohon, staff.name AS nama_staf_desa FROM surat a
        JOIN template_surat b ON a.template_surat_id = b.id
        JOIN users staff ON a.last_admin_print = staff.id
        JOIN users usr ON a.user_id = usr.id
        WHERE code_surat_printed IS NOT NULL AND DATE(a.printed_at) >= '" . $request->date_start . "' AND DATE(a.printed_at) <= '" . $request->date_end . "'
        " . $conditionTemplateSurat . "
        ORDER BY a.printed_at asc";
        $data = DB::select($query);
        return Excel::download(new SuratExport($data, "Laporan"), 'laporan.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function removeParagraFromSurat($bodySurat)
    {
        // Bersihkan tag <o:p>
        $bodySurat = str_replace(['<o:p>', '</o:p>'], '', $bodySurat);

        // Ganti <p> jadi <div> (opsional, jika ingin kontrol penuh via CSS)
        $bodySurat = str_replace(['<p>', '</p>'], ['<div>', '</div>'], $bodySurat);
        $bodySurat = str_replace(['<br><br>'], [''], $bodySurat);
        $bodySurat = str_replace(['<p', '/p>'], ['<div', '/div>'], $bodySurat);
        $bodySurat = str_replace(['<br><div class="MsoNoSpacing"'], ['<div class="MsoNoSpacing"'], $bodySurat);
        // dd($bodySurat);
        $bodySurat = str_replace(['&emsp;'], ['&nbsp;&nbsp;&nbsp;&nbsp;'], $bodySurat);

        // dd($bodySurat);
        return $bodySurat;
    }
}
