<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsVisitMobile extends Model
{
    protected $table = 'news_visits_mobile';

    protected $fillable = [
        'page_name',
        'news_title',
        'country',
        'device_id',
        'session_duration',
        'platform',
        'visited_at',
    ];

    public $timestamps = false;

}
