<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'ip', 'browser', 'platform', 'user_agent', 'duration', 'visited_at'];
    public $timestamps = false;
}
