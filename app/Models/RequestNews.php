<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestNews extends Model
{
    use HasFactory;
     protected $fillable = ['name', 'email', 'request', 'status', 'notes'];
}
