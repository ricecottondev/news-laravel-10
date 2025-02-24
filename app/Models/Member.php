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
            
            class Member extends Model
            {
                use HasFactory;
                protected $table = "onepoint_member";
                protected $fillable = [
                    "username",
                    "password",
                    "email",
                    "emailwithoutdot",
                    "telp",
                    "firstname",
                    "midname",
                    "lastname",
                    "nickname",
                    "website",
                    "company",
                    "image",
                    "address",
                    "kecamatan",
                    "city",
                    "provinsi",
                    "negara",
                    "kodenegara",
                    "kodepos",
                    "flag_news",
                    "status",
                    "deleted",
                    'ktp',
                    'birth_date',
                    'nama_ktp',
                    'desa',
                    'uniquecode',
                    'barcode',
                    'qrcode',

  
                ];
                public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
            }
            ?>