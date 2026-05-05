<?php

namespace App\Http\Controllers;

use App\Models\TemplateSurat;
use App\Models\TemplateSuratDetail;
use App\Models\RefMaster;
use App\Models\RefMasterType;
use App\Models\KondisiSurat;
use App\Models\KondisiSuratDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RefMasterController;
use App\Models\TemplateSuratAttr;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\DatabaseManager;
use Exception;
use PDF;
use PhpOffice\PhpWord\IOFactory;


class TemplateSuratController extends Controller
{
    protected $db;

    public function __construct(DatabaseManager $db)
    {
        $this->middleware('auth');
        $this->db = $db;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TemplateSurat::query();

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }
        if ($request->filled('type_surat')) {
            $query->where('type_surat', 'like', '%' . $request->type_surat . '%');
        }
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $query->orderBy('created_at', 'desc');


        $list = $query->paginate(10);
        $count = $query->count();

        return view('templatesurat/index', compact('list', 'count'));
    }

    public function create()
    {
        // Fetching data for each type code in a loop
        $data = $this->getRefMasterOptions();

        $templateSurat = null; // or: new \App\Models\TemplateSurat;
        $templateSuratDetail = collect();
        $conditions = collect();
        $totalDetails = 0;
        $isNew = true;

        // Combining data into one array for passing to the view
        return view('templatesurat/create', array_merge(
            $data,
            compact('templateSurat', 'templateSuratDetail', 'conditions', 'totalDetails', 'isNew')
        ));
    }


    public function store(Request $request)
    {
        $message = [
            'type_surat.required' => '*Tipe Surat Wajib Diisi',
            'type_surat.unique'   => '*Tipe Surat sudah digunakan',
            'code_surat.required' => '*Code Surat Wajib Diisi',
        ];
        $this->validate($request, [
            'type_surat' => 'required|unique:template_surat,type_surat',
            'code_surat' => 'required',
        ], $message);
        // dd($request);
        $this->db->beginTransaction();
        // dd($request);
        try {
            $data = $request->except('_token', 'submit', 'TemplateSuratdetail', 'condition', 'model_seq', 'body_surat_tiny');
            $data['admin_id'] = Auth::id();
            $templateSuratDetail = $request->TemplateSuratdetail;
            $data['is_active'] = $request->has('is_active');
            // $data['body_surat'] = $this->removeParagraFromSurat($data['body_surat']);

            $paramData = TemplateSurat::create($data);

            if ($request->has('model_seq')) {
                $this->saveTemplateSuratAttr($paramData->id, $this->setDataTemplateSuratAttr($paramData->id, $request["model_seq"]));
            }
            // dd($templateSuratDetail);

            if ($templateSuratDetail != null && count($templateSuratDetail) > 0) {
                foreach ($templateSuratDetail as $detail) {
                    $detail["template_surat_id"] = $paramData->id;

                    TemplateSuratDetail::create($detail);
                }
            }

            if ($request->condition != null && count($request->condition) > 0) {
                foreach ($request->condition as $cond) {
                    // Create KondisiSurat
                    $kondisiSurat = KondisiSurat::create([
                        'template_surat_id' => $paramData->id, // If necessary
                        'code' => $cond['code'],
                        'logical_operator' => $cond['logical_operator'],
                        'name' => $cond['name'],
                        'desc' => $cond['desc'],
                    ]);
                    // Insert the list_condition data into KondisiSuratDetail
                    foreach ($cond['list_condition'] as $detail) {
                        KondisiSuratDetail::create([
                            'kondisi_surat_id' => $kondisiSurat->id, // Foreign key to the newly created KondisiSurat
                            'tag_surat_detail' => $detail['tag_template_surat'], // Assuming this is the foreign key
                            'kondisi' => $detail['kondisi'],
                            'value' => $detail['value'],
                        ]);
                    }
                }
            }

            $this->db->commit();
            return redirect('/templatesurat/');
            return response()->json([
                'status' => 'success',
                'message' => 'Template Surat berhasil disimpan',
                'redirect' => url('/templatesurat/') // optional redirect URL
            ]);
        } catch (Exception $e) {
            // If any exception occurs, roll back the transaction
            $this->db->rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal disimpan. Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function setDataTemplateSuratAttr($templateSuratId, $modelSeq)
    {
        $templateData = [
            "Model N1" => [
                [
                    'template_surat_id' => $templateSuratId,
                    'attr_code' => 'is_attachment',
                    'attr_value' => true,
                    'attr_desc' => 'Untuk menampilkan tulisan lampiran pada pojok kanan atas'
                ],
                [
                    'template_surat_id' => $templateSuratId,
                    'attr_code' => 'is_instance',
                    'attr_value' => true,
                    'attr_desc' => 'Menampilkan data Instansi'
                ],
                [
                    'template_surat_id' => $templateSuratId,
                    'attr_code' => 'model_code',
                    'attr_value' => 'Model N1',
                    'attr_desc' => 'Menampilkan Model N1'
                ],
            ],
            "Model N2" => [
                [
                    'template_surat_id' => $templateSuratId,
                    'attr_code' => 'is_attachment',
                    'attr_value' => true,
                    'attr_desc' => 'Untuk menampilkan tulisan lampiran pada pojok kanan atas'
                ],
                [
                    'template_surat_id' => $templateSuratId,
                    'attr_code' => 'model_code',
                    'attr_value' => 'Model N2',
                    'attr_desc' => 'Menampilkan Model N2'
                ],
            ],
            "Model N4" => [
                [
                    'template_surat_id' => $templateSuratId,
                    'attr_code' => 'is_attachment',
                    'attr_value' => true,
                    'attr_desc' => 'Untuk menampilkan tulisan lampiran pada pojok kanan atas'
                ],
                [
                    'template_surat_id' => $templateSuratId,
                    'attr_code' => 'model_code',
                    'attr_value' => 'Model N4',
                    'attr_desc' => 'Menampilkan Model N4'
                ],
            ],
            "Model N5" => [
                [
                    'template_surat_id' => $templateSuratId,
                    'attr_code' => 'is_attachment',
                    'attr_value' => true,
                    'attr_desc' => 'Untuk menampilkan tulisan lampiran pada pojok kanan atas'
                ],
                [
                    'template_surat_id' => $templateSuratId,
                    'attr_code' => 'model_code',
                    'attr_value' => 'Model N5',
                    'attr_desc' => 'Menampilkan Model N5'
                ],
            ],
            "Model N6" => [
                [
                    'template_surat_id' => $templateSuratId,
                    'attr_code' => 'is_attachment',
                    'attr_value' => true,
                    'attr_desc' => 'Untuk menampilkan tulisan lampiran pada pojok kanan atas'
                ],
                [
                    'template_surat_id' => $templateSuratId,
                    'attr_code' => 'is_instance',
                    'attr_value' => true,
                    'attr_desc' => 'Menampilkan data Instansi'
                ],
                [
                    'template_surat_id' => $templateSuratId,
                    'attr_code' => 'model_code',
                    'attr_value' => 'Model N6',
                    'attr_desc' => 'Menampilkan Model N6'
                ],
            ]
        ];

        // Return the attribute data for the given model sequence
        return isset($templateData[$modelSeq]) ? $templateData[$modelSeq] : [];
    }

    public function saveTemplateSuratAttr($templateSuratId, $attrDataArray)
    {
        // Hapus semua data dengan template_surat_id yang sama
        TemplateSuratAttr::where('template_surat_id', $templateSuratId)->delete();

        // Simpan data baru
        foreach ($attrDataArray as $attrData) {
            TemplateSuratAttr::create($attrData);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $templateSurat = TemplateSurat::findOrFail($id);
        $templateSuratDetail = $templateSurat->TemplateSuratDetails;

        $refMasterOptions = $this->getRefMasterOptions();

        $conditions = KondisiSurat::with('kondisiSuratDetails')
            ->where('template_surat_id', $id)
            ->get();

        $totalDetails = $conditions->sum(fn($condition) => $condition->kondisiSuratDetails->count());

        $templateSuratAttr = TemplateSuratAttr::where([
            ['template_surat_id', $id],
            ['attr_code', 'model_code']
        ])->first();

        // dd($id);
        $templateSurat->body_surat = $this->removeParagraFromSurat($templateSurat->body_surat);

        $isNew = false;

        return view('templatesurat/edit', array_merge($refMasterOptions, [
            'templateSurat' => $templateSurat,
            'templateSuratDetail' => $templateSuratDetail,
            'conditions' => $conditions,
            'totalDetails' => $totalDetails,
            'templateSuratAttr' => $templateSuratAttr,
            'isNew' => $isNew
        ]));
    }

    private function getRefMasterOptions()
    {
        $controller = new RefMasterController();

        return [
            'options'         => $controller->getInputTypeOption()->original,
            'conditionOptions' => $controller->getRefMasterByTypeCode('COMPARISON_OPERATORS')->original,
            'logicalOptions'  => $controller->getRefMasterByTypeCode('LOGICAL_OPERATORS')->original,
            'modelSeqOption'  => $controller->getRefMasterByTypeCode('MODEL_SEQ')->original,
            'tempHeaderType'  => $controller->getRefMasterByTypeCode('TEMPLATE_HEADER_TYPE')->original,
            'chartType'      => $controller->getRefMasterByTypeCode('CHART_TYPE')->original,
            'letterSize'      => $controller->getRefMasterByTypeCode('LETTER_SIZE')->original,
        ];
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
        $data = $request->except('_token', 'submit', 'TemplateSuratdetail', 'condition', 'model_seq', 'body_surat_tiny');
        $data['admin_id'] = Auth::id();
        $this->db->beginTransaction();
        $data['is_active'] = $request->has('is_active');
        // $data['body_surat'] = $this->removeParagraFromSurat($data['body_surat']);

        try {
            $TemplateSuratDetail = $request->TemplateSuratdetail;
            $dataUpdate = TemplateSurat::findOrFail($request->id);
            // dd($data);
            $dataUpdate->update($data);
            TemplateSuratDetail::where('template_surat_id', '=', $request->id)->delete();
            if ($TemplateSuratDetail != null && count($TemplateSuratDetail) > 0) {
                foreach ($TemplateSuratDetail as $detail) {
                    $detail["template_surat_id"] = $request->id;
                    TemplateSuratDetail::create($detail);
                }
            }

            if ($request->has('model_seq')) {
                $this->saveTemplateSuratAttr($request->id, $this->setDataTemplateSuratAttr($request->id, $request["model_seq"]));
            } else {
                TemplateSuratAttr::where('template_surat_id', $request->id)->delete();
            }

            $conditions = KondisiSurat::where("template_surat_id", "=", $request->id);
            foreach ($conditions as $condition) {
                KondisiSuratDetail::where("kondisi_surat_id", "=", $condition->id)->delete();
            }
            $conditions->delete();

            if ($request->condition != null && count($request->condition) > 0) {
                foreach ($request->condition as $cond) {
                    // Create KondisiSurat

                    $kondisiSurat = KondisiSurat::create([
                        'template_surat_id' => $request->id, // If necessary
                        'code' => $cond['code'],
                        'logical_operator' => $cond['logical_operator'],
                        'name' => $cond['name'],
                        'desc' => $cond['desc'],
                    ]);
                    // Insert the list_condition data into KondisiSuratDetail
                    foreach ($cond['list_condition'] as $detail) {
                        KondisiSuratDetail::create([
                            'kondisi_surat_id' => $kondisiSurat->id, // Foreign key to the newly created KondisiSurat
                            'tag_surat_detail' => $detail['tag_template_surat'], // Assuming this is the foreign key
                            'kondisi' => $detail['kondisi'],
                            'value' => $detail['value'],
                        ]);
                    }
                }
            }
            $this->db->commit();
            return redirect('/templatesurat/');
        } catch (Exception $e) {
            // If any exception occurs, roll back the transaction
            $this->db->rollBack();
            dd('excpt', $e);
            // Return a failure response
            return response()->json(['error' => 'Data insertion failed', 'message' => $e->getMessage()], 500);
        }

        return redirect('/templatesurat/');
    }
    public function generatePreviewSuratPdf(Request $request)
    {
        $paperSize = $request->input('letter_size') ?? "A4";
        $typeHeader = $request->input('type_header') ?? "1";
        $typeSurat = $request->input('type_surat') ?? "Test Preview Surat";
        $codeSurat = $request->input('code_surat') ?? "Test Preview Code Surat";
        $bodySurat = $request->input('body_surat') ?? "Test Breview Body Surat";
        $bodySurat = $this->removeParagraFromSurat($bodySurat);

        // dd($bodySurat);
        $templateSuratAttr = [];
        if ($request->has('model_seq')) {
            // Key exists and is not null
            $templateSuratAttr = $this->setDataTemplateSuratAttr(0, $request["model_seq"]);
        }


        $data = [
            'jenisSurat' => $typeSurat,
            'codeSurat' => $codeSurat,
            'bodySurat' => $bodySurat,
            'templateSuratAttrs' => $templateSuratAttr,
            'paperSize' => $paperSize
        ];
        $templateHeaderType = $typeHeader;
        // dd($templateHeaderType);
        $nameTemplate = "generatePDFTypeHeader" . $templateHeaderType;
        // dd($templateHeaderType);
        // return view('surat/' . $nameTemplate, $data);

        $pdf = PDF::loadView('surat/' . $nameTemplate, $data);
        // dd($paperSize);
        $pdf->setPaper($paperSize, "potrait");

        return $pdf->download(str_replace(" ", "", $request->codeSurat) . '-' . date('Y-m-d') . '.pdf');
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

    public function importWord(Request $request)
    {
        $request->validate([
            'word_file' => 'required|mimes:doc,docx',
        ]);

        $file = $request->file('word_file');
        $phpWord = IOFactory::load($file->getPathname());

        $html = '';
        foreach ($phpWord->getSections() as $section) {
            $elements = $section->getElements();
            foreach ($elements as $element) {
                if (method_exists($element, 'getText')) {
                    $html .= '<p>' . $element->getText() . '</p>';
                }
            }
        }

        return response()->json(['html' => $html]);
    }
}
