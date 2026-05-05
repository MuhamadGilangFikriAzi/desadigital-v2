<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    protected $fillable = [
        'img_store',
        'name',
        'whatsapp_no',
        'desc'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
