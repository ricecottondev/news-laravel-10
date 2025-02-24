<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTransaction extends Model
{
    use HasFactory;

    protected $table = "log_pos_transaction";
    protected $guarded = ['id'];
}
