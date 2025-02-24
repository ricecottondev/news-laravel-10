<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'onepoint_brand';
    protected $fillable = [
        'brand',
        'status',
        'id_merchant',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id_brand');
    }
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'id_merchant', 'id');
    }
}
