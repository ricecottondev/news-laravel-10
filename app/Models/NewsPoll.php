<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsPoll extends Model
{
    protected $table = 'news_polls';

    protected $fillable = [
        'news_id',
        'poll_result',
        'ip_address',
        'user_agent',
    ];

    // Relasi ke tabel news (optional)
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
