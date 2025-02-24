<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = [
        'title',
        'short_desc',
        'url',
        'author',
        'slug',
        'status',
        'category_id',
    ];
}
