<?php

namespace App\Http\Controllers\Api\Seacrh;

use JWTAuth;
use App\Models\HistorySearch;
use App\Models\PopularSearch;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;
use App\Models\Promo;

class GetSeacrhController extends Controller
{
    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $userEmail = $user->email;
        $memberId = MemberModel::where('email', $userEmail)->first()->id;

        $latestSearchHistory = HistorySearch::where('id_member', $memberId)
            ->latest()
            ->limit(5)
            ->pluck('query');

        $popularSearches = PopularSearch::orderBy('search_count', 'desc')
            ->take(10)
            ->whereNull('deleted')
            ->where('status', 'active')
            ->pluck('query');

        $promoSeacrh =  Promo::pluck('promo');

        return response()->json([
            'success' => true,
            'History' => $latestSearchHistory,
            'Popular' => $popularSearches,
            'Promo' => $promoSeacrh,
        ], 200);
    }
}
