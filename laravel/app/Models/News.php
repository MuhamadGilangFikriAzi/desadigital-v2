<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'content', 'author', 'image', 'is_active'];

    public function comments()
    {
        return $this->hasMany(Comment::class, "news_id");
    }
}
