<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefMaster;
use App\Models\RefMasterType;

class RefMasterController extends Controller
{
    public function getInputTypeOption()
    {
        $refMasterRecords = RefMaster::where('ref_master_type_code', 'INPUT_TYPE_OPTIONS')->pluck('ref_master_value', 'ref_master_name');
        $refMasterTypes = RefMasterType::where('ref_master_type_code', '!=', 'INPUT_TYPE_OPTIONS')
                                ->where('is_option', true)
                                ->pluck('ref_master_type_code', 'ref_master_type_name');
        $combined = array_merge($refMasterRecords->toArray(), $refMasterTypes->toArray());

        // Return the data as a JSON response
        return response()->json($combined);
    }

    public function getRefMasterByTypeCode($refMasterTypeCode)
    {
        // Fetch RefMaster records by ref_master_type_code
        $refMasters = RefMaster::where('ref_master_type_code', $refMasterTypeCode)->pluck('ref_master_value', 'ref_master_name');

        // Return the data as a JSON response
        return response()->json($refMasters);
    }

    public function getRefMasterByTypeCodeReturnJson(Request $refMasterTypeCode)
    {
        // Fetch RefMaster records by ref_master_type_code
        $refMasters = RefMaster::where('ref_master_type_code', $refMasterTypeCode->typeCode)->pluck('ref_master_value', 'ref_master_name');
        $refMasterTypeCode = RefMasterType::where('ref_master_type_code', $refMasterTypeCode->typeCode)->first();
        // Return the data as a JSON response
        $data = [
            'label' => $refMasterTypeCode->ref_master_type_name,
            'options' => $refMasters
        ];

        return response()->json($data);
    }

}