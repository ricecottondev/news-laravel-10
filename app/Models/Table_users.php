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
            
            class Table_users extends Model
            {
                use HasFactory;
                protected $table = "users";
                protected $fillable = [
                    "name",
                    "email",
                    "email_verified_at",
                    "address",
                    "phone",
                    "password",
                    "image",
                    "remember_token"
                ];
            }
            ?>