<?php

namespace App\Http\Controllers\Api\Beranda;


use JWTAuth;
use App\Models\PromoUser;
use App\Models\ItemOffering;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Claim_voucher;
use Illuminate\Support\Carbon;
use App\Models\Claim_uniquecode;
use App\Models\ItemRecommendation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;

class GetBerandaController extends Controller
{
    public function index(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $userEmail = $user->email;
       
        $createdDate = Carbon::parse($user->created_at)->format('d F Y');
        // dd();
        if ($user->image) {
            $url = url('/') . '/images/users/' . $user->image;
        } else {
            $url = url('/') . '/images/users/user.png';
        }

    //     $results = DB::table('log_pos_transaction')
    // ->join('onepoint_member', 'log_pos_transaction.uniquecode', '=', 'onepoint_member.uniquecode')
    // ->select('log_pos_transaction.*', 'onepoint_member.*')
    // ->get()->toArray();
    //     dd($results);


        $userImageProfile =  $url;
        $memberId = MemberModel::where('email', $userEmail)->first()->id;

        // $voucherCount = Claim_voucher::where('id_member', $memberId)
        //         ->where('onepoint_log_claim_voucher.status', 'active')
        //         ->where('onepoint_log_claim_voucher.flag_used', 'false')
        //         ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
        //         ->count();
        $now = Carbon::now();
        $voucherCount = Claim_voucher::where('id_member', $memberId)
                    ->where('onepoint_log_claim_voucher.status', 'active')
                    ->where('onepoint_log_claim_voucher.flag_used', 'false')
                    ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
                    ->where('onepoint_voucher.deleted', 'false')
                    ->where(function ($query) use ($now) {
                        $query->where('onepoint_voucher.date_start', '<=', $now)
                            ->where('onepoint_voucher.date_end', '>=', $now->subDay());
                    })
                    ->count();

        $notifikasi = Notification::where('member_id', $memberId)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        $jumlahUnread = $notifikasi->where('notification_status', 'Unread')->count();

        $promoUser = PromoUser::where('member_id', $memberId)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        $jumlahUnreadPromo = $promoUser->where('promo_status', 'Unread')->count();

        $totalNotif = $jumlahUnread + $jumlahUnreadPromo;



        $today = now();
        $fullUrl = url('/');
        $Recomended = ItemRecommendation::where(function ($query) use ($memberId) {
            $query->where('id_member', $memberId)
                ->orWhereNull('id_member')
            ->orWhere('id_member', '');
        })
            ->with(['produk' => function ($query) use ($fullUrl) {
                $query->select('kategori', 'namaproduk', 'kemasan', 'harga', 'id', 'url')
                    ->selectRaw("CASE WHEN LENGTH(gambar) > 0 THEN CONCAT('$fullUrl', '/files/', gambar) ELSE NULL END AS gambar");
                // ->selectRaw("CASE WHEN LENGTH(gambar1) > 0 THEN CONCAT('$fullUrl', '/files/', gambar1) ELSE NULL END AS gambar1")
                // ->selectRaw("CASE WHEN LENGTH(gambar2) > 0 THEN CONCAT('$fullUrl', '/files/', gambar2) ELSE NULL END AS gambar2")
                // ->selectRaw("CASE WHEN LENGTH(gambar3) > 0 THEN CONCAT('$fullUrl', '/files/', gambar3) ELSE NULL END AS gambar3");
            }])
            ->where(function ($query) use ($today) {
                $query->where('recom_start_date', '<=', $today)
                    ->where('recom_end_date', '>=', $today);
            })
            ->where('status', 'active')
            ->whereNull('deleted')
            ->get();
        $transformedRecomended = $Recomended->pluck('produk')->flatten()->all();


        $Offering = ItemOffering::where(function ($query) use ($memberId) {
            $query->where('id_member', $memberId)
                ->orWhereNull('id_member')
            ->orWhere('id_member', '');
        })
            ->with(['produk' => function ($query) use ($fullUrl) {
                $query->select('kategori', 'namaproduk', 'kemasan', 'harga', 'id', 'url')
                    ->selectRaw("CASE WHEN LENGTH(gambar) > 0 THEN CONCAT('$fullUrl', '/files/', gambar) ELSE NULL END AS gambar");
                // ->selectRaw("CASE WHEN LENGTH(gambar1) > 0 THEN CONCAT('$fullUrl', '/files/', gambar1) ELSE NULL END AS gambar1")
                // ->selectRaw("CASE WHEN LENGTH(gambar2) > 0 THEN CONCAT('$fullUrl', '/files/', gambar2) ELSE NULL END AS gambar2")
                // ->selectRaw("CASE WHEN LENGTH(gambar3) > 0 THEN CONCAT('$fullUrl', '/files/', gambar3) ELSE NULL END AS gambar3");
            }])
            ->where(function ($query) use ($today) {
                $query->where('recom_start_date', '<=', $today)
                    ->where('recom_end_date', '>=', $today);
            })
            ->where('status', 'active')
            ->whereNull('deleted')
            ->get();
        $transformedOffering = $Offering->pluck('produk')->flatten()->all();


        // $totalPoints = Claim_uniquecode::where('id_member', $memberId)->sum('point');
        // $response1 =  DB::select('select sum(point) as point from onepoint_log_claim_uniquecode as m where id_member = "' . $memberId . '"');
        //bantu saya rubah kode ini dengan eloquent laravel 
        // $findpointused = DB::select('select sum(v.pointneed) as pointused from onepoint_log_claim_voucher as c
        // inner join onepoint_voucher as v on v.kode_voucher = c.kode_voucher
        // where c.id_member = "' . $memberId . '"');
        // $point = $response;
        // $pointused = $findpointused[0]->pointused;
        // dd($pointused);

        $point = Claim_uniquecode::where('id_member', $memberId)->sum('point');
        $pointUseds = Claim_voucher::where('id_member', $memberId)
            ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
            ->sum('onepoint_voucher.pointneed');




        $totalPoint = $point - $pointUseds;

        $GetMember = MemberModel::where('email', $userEmail)->first();

        return response()->json([
            'success' => true,
            'message' => 'Get Beranda',
            'totalPoints' => $totalPoint,
            'userImageProfile' => $userImageProfile,
            'voucherCount' => $voucherCount,
            'Recomended' => $transformedRecomended,
            'Offering' => $transformedOffering,
            'totalNotif' => $totalNotif,
            'notif' =>  $jumlahUnread,
            'promo' => $jumlahUnreadPromo,
            'uniquecode' => $GetMember->uniquecode,
            'barcode' => url('barcode') . '/' .  $GetMember->barcode,
            'qrcode' => url('qrcode') . '/' .  $GetMember->qrcode,
            'memberSince' => $createdDate
        ], 200);
    }
}
