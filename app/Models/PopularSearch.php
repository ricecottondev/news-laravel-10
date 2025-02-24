<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularSearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'search_count',
        'query',
        'status',
        'deleted'
    ];
}
