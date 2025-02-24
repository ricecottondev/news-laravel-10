<?php

namespace App\Http\Controllers\Api\Seacrh;

use JWTAuth;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\HistorySearch;
use App\Models\PopularSearch;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;

class PostSeacrhController extends Controller
{
    public function index(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $userEmail = $user->email;
        $memberId = MemberModel::where('email', $userEmail)->first()->id;

        $keyword = $request->input('keyword');


        $popularSearch = PopularSearch::where('query', 'LIKE', "%$keyword%")->first();

        $history = HistorySearch::firstOrCreate([
            'id_member' => $memberId,
            'query' => $keyword,
        ]);

        if ($popularSearch) {

            $popularSearch->increment('search_count');
        } else {

            PopularSearch::create([
                'query' => $keyword,
                'search_count' => 1,
            ]);
        }

        $fullUrl = url('/');
        $data = Product::select('kategori', 'namaproduk', 'kemasan', 'harga', 'id_brand', 'id', 'url')->selectRaw("CASE WHEN LENGTH(gambar) > 0 THEN CONCAT('$fullUrl', '/files/', gambar) ELSE NULL END AS gambar")
            ->where('product_status', '1')
            ->where('deleted', 'false')
            ->where(function ($query) use ($keyword) {
                $query->whereHas('brand', function ($brandQuery) use ($keyword) {
                    $brandQuery->where('brand', 'LIKE', "%$keyword%");
                })
                    ->orWhere('namaproduk', 'LIKE', "%$keyword%")
                    ->orWhere('slug', 'LIKE', "%$keyword%");
            })
            ->get()->toArray();

        return response()->json([
            'success' => true,
            'seacrh' => $data,
        ], 200);
    }
}
