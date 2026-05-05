<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'name',
        'nik',
        'password',
        'ktp',
        'no_wa'
    ];
    public $timestamps = true;
    protected $guarded = [];
}
