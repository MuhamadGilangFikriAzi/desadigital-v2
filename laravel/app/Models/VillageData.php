<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillageData extends Model
{

    protected $table = "village_data";
    public $timestamps = true;
    protected $fillable = ['type_chart', 'title', 'is_active'];
    public function details()
    {
        return $this->hasMany(VillageDataDetail::class);
    }
}
