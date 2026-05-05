<?php

namespace App\Http\Controllers;

use App\Models\VillageData;
use App\Models\VillageDataDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VillageDataController extends Controller
{
    public function index(Request $request)
    {
        $query = VillageData::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('type_chart')) {
            $query->where('type_chart', $request->type_chart);
        }

        if ($request->has('is_active') && $request->is_active !== '') {
            $query->where('is_active', $request->is_active);
        }

        $refMasterOptions = $this->getRefMasterOptions();


        $data = $query->paginate(10)->appends($request->all());

        return view('villagedata.index', array_merge($refMasterOptions, ['data' => $data]));
    }

    public function create()
    {
        $refMasterOptions = $this->getRefMasterOptions();

        return view('villagedata.create', array_merge($refMasterOptions, ['data' => null])); // penting!
    }

    public function edit($id)
    {
        $refMasterOptions = $this->getRefMasterOptions();
        $data = VillageData::with('details')->findOrFail($id);
        $refMasterOptions = $this->getRefMasterOptions();
        // dd($data->type_chart ?? "");
        // dd($refMasterOptions);

        return view('villagedata.edit', array_merge($refMasterOptions, ['data' => $data]));
    }

    private function getRefMasterOptions()
    {
        $controller = new RefMasterController();

        return [
            'chartType'      => $controller->getRefMasterByTypeCode('CHART_TYPE')->original
        ];
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'villagedata.type_chart' => 'required|string',
            'villagedata.title' => 'required|string',
            'villagedata.is_active' => 'required|boolean',
            'villagedata.villageDetail' => 'required|array',
            'villagedata.villageDetail.*.label' => 'required|string',
            'villagedata.villageDetail.*.value' => 'required|integer',
            'villagedata.villageDetail.*.color' => 'required|string',
        ], [
            'villagedata.type_chart.required' => 'Tipe chart wajib diisi.',
            'villagedata.title.required' => 'Judul wajib diisi.',
            'villagedata.is_active.boolean' => 'Status aktif harus bernilai true atau false.',
            'villagedata.villageDetail.required' => 'Detail desa harus diisi minimal satu.',
            'villagedata.villageDetail.*.label.required' => 'Label detail desa wajib diisi.',
            'villagedata.villageDetail.*.value.required' => 'Nilai detail desa wajib diisi.',
            'villagedata.villageDetail.*.value.integer' => 'Nilai detail desa harus berupa angka.',
            'villagedata.villageDetail.*.color.required' => 'Warna detail desa wajib diisi.',
        ]);

        DB::beginTransaction();

        try {
            // Simpan data utama
            $villageData = VillageData::create([
                'type_chart' => $validated['villagedata']['type_chart'],
                'title' => $validated['villagedata']['title'],
                'is_active' => $validated['villagedata']['is_active'],
            ]);

            // Simpan detail data
            foreach ($validated['villagedata']['villageDetail'] as $detail) {
                VillageDataDetail::create([
                    'village_data_id' => $villageData->id,
                    'label' => $detail['label'],
                    'value' => $detail['value'],
                    'color' => $detail['color'],
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Village data saved successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to save village data.', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'villagedata.type_chart' => 'required|string',
            'villagedata.title' => 'required|string',
            'villagedata.is_active' => 'required|boolean',
            'villagedata.villageDetail' => 'required|array',
            'villagedata.villageDetail.*.label' => 'required|string',
            'villagedata.villageDetail.*.value' => 'required|integer',
            'villagedata.villageDetail.*.color' => 'required|string',
        ], [
            'villagedata.type_chart.required' => 'Tipe chart wajib diisi.',
            'villagedata.title.required' => 'Judul wajib diisi.',
            'villagedata.is_active.boolean' => 'Status aktif harus bernilai true atau false.',
            'villagedata.villageDetail.required' => 'Detail desa harus diisi minimal satu.',
            'villagedata.villageDetail.*.label.required' => 'Label detail desa wajib diisi.',
            'villagedata.villageDetail.*.value.required' => 'Nilai detail desa wajib diisi.',
            'villagedata.villageDetail.*.value.integer' => 'Nilai detail desa harus berupa angka.',
            'villagedata.villageDetail.*.color.required' => 'Warna detail desa wajib diisi.',
        ]);


        DB::beginTransaction();

        try {
            // Temukan data utama
            $villageData = VillageData::findOrFail($id);

            // Update data utama
            $villageData->update([
                'type_chart' => $validated['villagedata']['type_chart'],
                'title' => $validated['villagedata']['title'],
                'is_active' => $validated['villagedata']['is_active'],
            ]);

            // Hapus detail lama
            VillageDataDetail::where('village_data_id', $villageData->id)->delete();

            // Tambahkan detail baru
            foreach ($validated['villagedata']['villageDetail'] as $detail) {
                VillageDataDetail::create([
                    'village_data_id' => $villageData->id,
                    'label' => $detail['label'],
                    'value' => $detail['value'],
                    'color' => $detail['color'],
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Village data updated successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update village data.', 'error' => $e->getMessage()], 500);
        }
    }
}
