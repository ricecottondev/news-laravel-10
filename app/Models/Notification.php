<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'onepoint_notifications';

    protected $fillable = ['member_id', 'notification_date', 'notification_title', 'notification_content', 'notification_status'];
}
