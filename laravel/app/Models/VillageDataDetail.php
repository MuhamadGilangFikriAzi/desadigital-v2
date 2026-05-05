<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// VillageDataDetail.php
class VillageDataDetail extends Model
{

    protected $table = "village_data_detail";
    public $timestamps = true;
    protected $fillable = ['village_data_id', 'label', 'value', 'color'];

    public function villageData()
    {
        return $this->belongsTo(VillageData::class);
    }
}
