<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAdvertisement extends Model
{
    use HasFactory;

    protected $table = 'log_advertisement';

    public $timestamps = false; // <- Nonaktifkan auto timestamps

    protected $fillable = ['advertisement', 'created_at'];
}
