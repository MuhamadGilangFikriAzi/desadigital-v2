<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    protected $table = 'news_images';

    protected $fillable = [
        'news_id',
        'desc',
        'tag',
        'img'
    ];

    // Relasi ke News
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
