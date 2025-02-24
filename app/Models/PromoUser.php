<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoUser extends Model
{
    use HasFactory;

    protected $table = 'onepoint_promo_users';

    protected $fillable = ['promo_notif_id', 'member_id', 'promo_status'];
}
