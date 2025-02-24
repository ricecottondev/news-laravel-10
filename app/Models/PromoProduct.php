<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoProduct extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product() {
        return $this->belongsTo(Product::class, 'onepoint_produk_id');
    }
    public function promoCollection() {
        return $this->belongsTo(PromoCollection::class, 'promo_collection_id');
    }
}
