<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsComment extends Model
{
    use HasFactory;

    protected $table = 'news_comments';

    protected $fillable = ['user_id', 'news_id', 'comment', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(NewsComment::class, 'parent_id');
    }

    // Relasi ke balasan komentar
    public function replies()
    {
        return $this->hasMany(NewsComment::class, 'parent_id');
    }

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
