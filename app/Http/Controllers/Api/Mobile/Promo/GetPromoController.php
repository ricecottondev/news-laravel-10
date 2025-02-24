<?php

namespace App\Http\Controllers\Api\Mobile\Promo;

use App\Models\PromoProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PromoCollection;

class GetPromoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $today = now()->format('Y-m-d');

        $promoProducts = PromoProduct::with('promoCollection', 'product')
            ->whereHas('promoCollection', function ($query) use ($today) {
                $query->where('start', '<=', $today)
                    ->where(function ($query) use ($today) {
                        $query->where('end', '>=', $today)
                            ->orWhereDate('end', '=', $today); // Tambahkan ini untuk memeriksa tanggal yang sama
                    });
            })
            ->get();

        $promoList = PromoCollection::where('start', '<=', $today)
            ->where('end', '>=', $today)
            ->pluck('name');



        $formattedData = $promoProducts->groupBy('promoCollection.name')->map(function ($promoProducts, $promoCollectionName) {
            $fullUrl = url('/');
            return [
                'promo' => $promoCollectionName,
                'promo_product' => $promoProducts->map(function ($promoProduct) use ($fullUrl) {

                    if (isset($promoProduct->value_diskon)) {

                        $diskon = $promoProduct->value_diskon;

                        if ($diskon > 100) {

                            $harga = $promoProduct->product->harga - $diskon;
                        } else {

                            $nilaiDiskon = $promoProduct->product->harga * ($diskon / 100);
                            $hargaSetelahDiskon = $promoProduct->product->harga - $nilaiDiskon;
                            $harga = $hargaSetelahDiskon;
                        }
                    } else {

                        $harga = $promoProduct->product->harga;
                    }

                    return [
                        'label_promo' => $promoProduct->name,
                        'name_product' => $promoProduct->product->namaproduk,
                        'kategori' => $promoProduct->product->kategori,
                        'kemasan' => $promoProduct->product->kemasan,
                        'harga' => $harga,
                        'gambar' => $fullUrl . '/files/' . $promoProduct->product->gambar,
                        'url' => $promoProduct->product->url,
                    ];
                }),
            ];
        })->values();

        return response()->json([
            'success' => true,
            'message' => 'Get Menu Promo All',
            'promo' => $promoList,
            'data' => $formattedData,
        ]);
    }
}
