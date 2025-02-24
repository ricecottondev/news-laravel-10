<?php

/**
 * author : Suryo Atmojo <suryoatm@gmail.com>
 * project : supresso Laravel
 * Start-date : 19-09-2022
 */
/**
             “Barangsiapa yang memberi kemudharatan kepada seorang muslim, 
            maka Allah akan memberi kemudharatan kepadanya, 
            barangsiapa yang merepotkan (menyusahkan) seorang muslim 
            maka Allah akan menyusahkan dia.”
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim_voucher extends Model
{
    use HasFactory;
    protected $table = "onepoint_log_claim_voucher";
    protected $fillable = [
        "id_member",
        "kode_voucher",
        "status",
        "deleted",
        "flag_used",
        "used_at",
        'id_onepoint_voucher'
    ];

    public function member()
    {
        return $this->hasMany(Member::class, 'id', 'id_member');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'id_onepoint_voucher', 'id');
    }
}
