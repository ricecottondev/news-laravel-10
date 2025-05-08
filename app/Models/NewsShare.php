<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsShare extends Model
{
    use HasFactory;
    protected $fillable = [
        "news_id",
        "platform",
        "ip",
        "user_agent"
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
