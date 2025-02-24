<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jne extends Model
{
    use HasFactory;

    protected $table = 'jne_api';

    protected $guarded = ['id'];
}
