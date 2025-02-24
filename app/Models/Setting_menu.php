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

class Setting_menu extends Model
{
    use HasFactory;
    protected $table = "setting_menu";
    protected $fillable = [
        "menu_name",
        "menu_label",
        "menu_url",
        "menu_color",
        "menu_parent",
        "menu_icon",
        "type",
        "ord",
        "extensiontarget",
        "status",
        "deleted",
    ];
}
