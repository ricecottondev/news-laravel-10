<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'role', // Anda dapat menambahkan kolom lain di sini jika diperlukan
    ];

    // Secara default, Eloquent akan mengasumsikan nama tabel dari model tersebut adalah bentuk jamak dari nama kelas. 
    // Jadi, jika Anda ingin menggunakan nama tabel yang berbeda, Anda dapat mendefinisikannya secara eksplisit:
    protected $table = 'user_roles';
}
