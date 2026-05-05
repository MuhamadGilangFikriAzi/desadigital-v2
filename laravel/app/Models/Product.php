<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'store_id',
        'img_product',
        'name_product',
        'price',
        'desc'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
