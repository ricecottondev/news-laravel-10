<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlidersModel extends Model
{
    use HasFactory;
    protected $table = 'sliders';
    protected $fillable = [
        'custom_script',
        'shop_url',
        'title',
        'below_title',
        'desc',
        'type',
        'flag',
        'active_date',
        'created_who',
        'updated_who',
        'desktop_img',
        'mobile_img',
        'text_color',
        'json_text_form'
    ];
}
