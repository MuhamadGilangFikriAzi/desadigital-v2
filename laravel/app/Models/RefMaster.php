<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefMaster extends Model
{
    protected $table = 'ref_master'; // Optional if the table name is pluralized

    protected $fillable = [
        'ref_master_code',
        'ref_master_name',
        'ref_master_value',
        'ref_master_type_code',
    ];

    // Define the relationship with RefMasterType
    public function refMasterType()
    {
        return $this->belongsTo(RefMasterType::class, 'ref_master_type_code', 'ref_master_type_code');
    }

    public static function getOptionsByType($type)
    {
        return self::where('ref_master_type_code', $type)
            ->pluck('ref_master_value', 'ref_master_name') // label sebagai key, value sebagai option value
            ->toArray();
    }
}
