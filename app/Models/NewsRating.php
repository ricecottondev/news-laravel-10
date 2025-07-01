<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsRating extends Model
{
    protected $table = 'news_ratings';

    protected $fillable = [
        'news_id',
        'spiciness',
        'length',
        'funny',
        'topic',
        'ip_address',
        'user_agent',
    ];

    // Relasi ke tabel berita (jika dibutuhkan)
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
