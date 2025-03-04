<?php

namespace App\Http\Controllers\Member;

use id;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Merchant;
use App\Models\PromoProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoppingMemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        if (!$request->merchant) {
            $idMerchant = 3;
            $brands = Brand::where('id_merchant', 3)->pluck('brand');
            $searchDefault = $brands->first();
        } else {
            $idMerchant = Merchant::where('merchant_name', $request->merchant)->first()->id;
            $brands = Brand::where('id_merchant', $idMerchant)->pluck('brand');
            $searchDefault = $brands->first();
        }

        $brand = Brand::where('id_merchant', $idMerchant)->pluck('brand');
        $merchant = Merchant::pluck('merchant_name');
        $fullUrl = url('/');

        if ($search) {
            $product = Product::select('kategori', 'namaproduk', 'kemasan', 'harga', 'id_brand', 'url', 'id')
                ->selectRaw("CASE WHEN LENGTH(gambar) > 0 THEN CONCAT('$fullUrl', '/files/', gambar) ELSE NULL END AS gambar")
                ->where('product_status', '1')
                ->where('id_merchant', $idMerchant)
                ->where(function ($query) use ($search) {
                    $query->whereHas('brand', function ($brandQuery) use ($search) {
                        $brandQuery->where('brand', 'LIKE', "%$search%");
                    });
                })
                ->get()
                ->map(function ($product) use ($idMerchant, $fullUrl) {
                    // Logika perhitungan harga promo di sini, jika diperlukan
                    $promoProduct = PromoProduct::where('id_merchant', $idMerchant)
                        ->whereDate('start', '<=', now())
                        ->whereDate('end', '>=', now())
                        ->where('onepoint_produk_id', $product->id)
                        ->first();

                    if ($promoProduct && isset($promoProduct->value_diskon)) {
                        $diskon = $promoProduct->value_diskon;

                        if ($diskon > 100) {
                            $harga = $product->harga - $diskon;
                        } else {
                            $nilaiDiskon = $product->harga * ($diskon / 100);
                            $hargaSetelahDiskon = $product->harga - $nilaiDiskon;
                            $harga = $hargaSetelahDiskon;
                        }
                    } else {
                        $harga = $product->harga;
                    }

                    // Tambahkan atribut lain yang diperlukan ke dalam array produk
                    return array_merge(
                        $product->toArray(),
                        [
                            'harga' => $harga,
                            // ... (tambahkan atribut lain yang diperlukan)
                        ]
                    );
                })
                ->toArray();
        } else {
            $product = Product::select('kategori', 'namaproduk', 'kemasan', 'harga', 'id_brand', 'url', 'id')
                ->selectRaw("CASE WHEN LENGTH(gambar) > 0 THEN CONCAT('$fullUrl', '/files/', gambar) ELSE NULL END AS gambar")
                ->where('product_status', '1')
                ->where('id_merchant', $idMerchant)
                ->where(function ($query) use ($searchDefault) {
                    $query->whereHas('brand', function ($brandQuery) use ($searchDefault) {
                        $brandQuery->where('brand', 'LIKE', "%$searchDefault%");
                    });
                })
                ->get()
                ->map(function ($product) use ($idMerchant, $fullUrl) {
                    // Logika perhitungan harga promo di sini, jika diperlukan
                    $promoProduct = PromoProduct::where('id_merchant', $idMerchant)
                        ->whereDate('start', '<=', now())
                        ->whereDate('end', '>=', now())
                        ->where('onepoint_produk_id', $product->id)
                        ->first();

                    if ($promoProduct && isset($promoProduct->value_diskon)) {
                        $diskon = $promoProduct->value_diskon;

                        if ($diskon > 100) {
                            $harga = $product->harga - $diskon;
                        } else {
                            $nilaiDiskon = $product->harga * ($diskon / 100);
                            $hargaSetelahDiskon = $product->harga - $nilaiDiskon;
                            $harga = $hargaSetelahDiskon;
                        }
                    } else {
                        $harga = $product->harga;
                    }

                    // Tambahkan atribut lain yang diperlukan ke dalam array produk
                    return array_merge(
                        $product->toArray(),
                        [
                            'harga' => $harga,
                            // ... (tambahkan atribut lain yang diperlukan)
                        ]
                    );
                })
                ->toArray();
        }



        // dd($product);
        return view('page-sdamember.belanja', compact(
            'brand',
            'product',
            'merchant',
        ));
    }
}
