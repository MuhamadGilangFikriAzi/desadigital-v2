<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aparatur extends Model
{
    protected $table = 'aparatur';

    protected $fillable = ['name', 'photo', 'position', 'is_active'];
}
