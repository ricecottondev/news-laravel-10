<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOffering extends Model
{
    use HasFactory;
    protected $table = 'onepoint_offering';
    protected $fillable = [
        'id_member',
        'id_produk',
        'recom_start_date',
        'recom_end_date',
        'status',
        'deleted',
    ];

    public function produk()
    {
        return $this->hasMany(Product::class, 'id', 'id_produk');
    }

    public function member()
    {
        return $this->hasMany(Member::class, 'id', 'id_member');
    }
}
