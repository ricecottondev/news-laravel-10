<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nama_belakang',
        'email',
        'password',
        'role_id',
        'phone',
        'negara',
        'provinsi',
        'kota',
        'kecamatan',
        'alamat',
        'kodepos',
        'image',
        'tempat_lahir',
        'tanggal_lahir'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

         /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function getRole($roleId)
    {
        // Cari peran berdasarkan ID
        return UserRole::find($roleId);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function socialAccounts()
{
  return $this->hasMany(SocialAccount::class);
}


}
