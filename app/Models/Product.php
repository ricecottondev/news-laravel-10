<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'onepoint_produk';
    protected $fillable = [
        'id_brand',
        'id_merchant',
        'namaproduk',
        'shortdescription',
        'merek',
        'packing',
        'kemasan',
        'kategori',
        'subkategori',
        'harga',
        'specification',
        'description',
        'gambar',
        'gambar1',
        'gambar2',
        'gambar3',
        'hargadiskon',
        'sku',
        'jumlahstock',
        'berat',
        'panjang',
        'lebar',
        'tinggi',
        'kind',
        'produkunggulan',
        'product_status',
        'beratbersih',
        'beratkotor',
        'keywords',
        'promo',
        'deleted',
        'status',
        'created_at',
        'updated_at',
        'slug',
        'url'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand');
    }
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'id_merchant');
    }
}
