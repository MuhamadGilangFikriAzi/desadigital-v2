<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefMasterType extends Model
{
    protected $table = 'ref_master_type'; // Optional if the table name is pluralized

    protected $fillable = [
        'ref_master_type_code',
        'ref_master_type_name',
        'is_option',
        'is_active',
    ];

    // Define the relationship with RefMaster
    public function refMasters()
    {
        return $this->hasMany(RefMaster::class, 'ref_master_type_code', 'ref_master_type_code');
    }
}