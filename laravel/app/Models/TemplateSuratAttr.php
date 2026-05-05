<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateSuratAttr extends Model
{
    protected $table = "template_surat_attr";
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function TemplateSurat()
    {
        return $this->belongsTo(TemplateSurat::class);
    }
}
