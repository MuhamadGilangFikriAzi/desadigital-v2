<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KondisiSurat extends Model
{
    // Table name
    protected $table = 'kondisi_surat';
    protected $guarded = [];

    // Relationship to KondisiSuratDetail
    public function kondisiSuratDetails()
    {
        return $this->hasMany(KondisiSuratDetail::class, 'kondisi_surat_id');
    }
}