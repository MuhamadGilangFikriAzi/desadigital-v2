<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KondisiSuratDetail extends Model
{
    // Table name
    protected $table = 'kondisi_surat_detail';

    // The primary key of the table (optional if it's the default 'id')
    protected $primaryKey = 'id';

    // Automatically maintain created_at and updated_at timestamps
    public $timestamps = true;

    // Mass assignable attributes
    protected $fillable = [
        'kondisi_surat_id', 'tag_surat_detail', 'kondisi', 'value'
    ];

    // Define relationships if needed
    public function kondisiSurat()
    {
        return $this->belongsTo(KondisiSurat::class, 'kondisi_surat_id');
    }

    public function tagSuratDetail()
    {
        return $this->belongsTo(TagSuratDetail::class, 'tag_surat_detail');
    }
}