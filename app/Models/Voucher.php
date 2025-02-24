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

class Voucher extends Model
{
    use HasFactory;
    protected $table = "onepoint_voucher";
    protected $fillable = [
        "kode_voucher",
        "id_merchant",
        "label",
        "short_desc",
        "desc",
        "date_start",
        "date_end",
        "pointneed",
        "qtyvoucher",
        "disctype",
        "discvalue",
        "minorder",
        "status",
        "deleted",
        "type_flag"
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'id_merchant');
    }
}
