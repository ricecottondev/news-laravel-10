<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ItemRecommendation;
use App\Models\Member as MemberModel;

class RecomendMemberController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $fullUrl = url('/');
        $today = now();
        $memberId = MemberModel::where('email', $user->email)->first()->id;
        $Recomended = ItemRecommendation::where(function ($query) use ($memberId) {
            $query->where('id_member', $memberId)
                ->orWhereNull('id_member')
                ->orWhere('id_member', '');
        })
            ->with(['produk' => function ($query) use ($fullUrl) {
                $query->select('kategori', 'namaproduk', 'kemasan', 'harga', 'id', 'url')
                    ->selectRaw("CASE WHEN LENGTH(gambar) > 0 THEN CONCAT('$fullUrl', '/files/', gambar) ELSE NULL END AS gambar");
            }])
            ->where(function ($query) use ($today) {
                $query->where('recom_start_date', '<=', $today)
                    ->where('recom_end_date', '>=', $today);
            })
            ->where('status', 'active')
            ->get();
        $transformedRecomended = $Recomended->pluck('produk')->flatten()->all();

        // dd($transformedRecomended);
        return  view('front.members.recomendation', compact('transformedRecomended'));
    }
}
