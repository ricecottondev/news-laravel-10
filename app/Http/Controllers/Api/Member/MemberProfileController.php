<?php

namespace App\Http\Controllers\Api\Member;


use JWTAuth;
use App\Models\User;
use App\Models\PromoUser;
use App\Models\ItemOffering;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Claim_voucher;
use App\Models\Claim_uniquecode;
use App\Models\ItemRecommendation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;
use DateTime;

class MemberProfileController extends Controller
{
    public function index(Request $request)
    {
        $getUserModel =  User::where('email', $request->email)->first();
        $user = $getUserModel;
        $userEmail = $user->email;
        // dd($user->image);
        if ($user->image) {
            $url = url('/') . '/images/users/' . $user->image;
        } else {
            $url = url('/') . '/images/users/user.png';
        }


        $userImageProfile =  $url;
        // dd($userEmail);
        $memberId = MemberModel::where('email', $userEmail)->first()->id;

        $voucherCount = Claim_voucher::where('id_member', $memberId)
        ->where('onepoint_log_claim_voucher.status', 'active')
        ->where('onepoint_log_claim_voucher.flag_used', 'false')
        ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
        ->count();

        $notifikasi = Notification::where('member_id', $memberId)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        $jumlahUnread = $notifikasi->where('notification_status', 'Unread')->count();
        $promo = PromoUser::where('member_id', $memberId)->count();
        $totalNotif = $jumlahUnread + $promo;



        $today = now();
        $fullUrl = url('/');
        $voucher = $this->VoucherMember($getUserModel);
        $Recomended = ItemRecommendation::where(function ($query) use ($memberId) {
            $query->where('id_member', $memberId)
                ->orWhereNull('id_member');
            // ->orWhere('id_member', '') kode ini untuk rekomendasi jika di isi kosong
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
            ->get();
        $transformedRecomended = $Recomended->pluck('produk')->flatten()->all();
        $notifList = Notification::select('notification_title as title', 'notification_content as content', 'created_at as date', 'notification_status as status')->where('member_id', $memberId)
            ->orderBy('created_at', 'desc')->take(20)->get();

        $Offering = ItemOffering::where(function ($query) use ($memberId) {
            $query->where('id_member', $memberId)
                ->orWhereNull('id_member');
            // ->orWhere('id_member', '') kode ini untuk rekomendasi jika di isi kosong
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
            ->get();
        $promoList = PromoUser::select('promo_name as title', 'promo_desc  as content')->join('onepoint_promo_notif', 'onepoint_promo_users.promo_notif_id', '=', 'onepoint_promo_notif.id')
            ->where('onepoint_promo_users.member_id', $memberId)->get();
        $transformedOffering = $Offering->pluck('produk')->flatten()->all();


        $point = Claim_uniquecode::where('id_member', $memberId)->sum('point');
        $pointUseds = Claim_voucher::where('id_member', $memberId)
            ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
            ->sum('onepoint_voucher.pointneed');




        $totalPoint = $point - $pointUseds;

        return response()->json([
            'success' => true,
            'message' => 'Get Profile Member',
            'totalPoints' => $totalPoint,
            'userImageProfile' => $userImageProfile,
            'voucherCount' => $voucherCount,
            'VoucherListMember' => $voucher,
            'Recomended' => $transformedRecomended,
            'Offering' => $transformedOffering,
            'totalNotif' => $totalNotif,
            'notif' =>  $jumlahUnread,
            'notifList' =>  $notifList,
            'promo' => $promo,
            'promoList' => $promoList,
        ], 200);
    }


    public function VoucherMember($getUserModel)
    {

        $user = $getUserModel;
        $userEmail = $user->email;
        $memberId = MemberModel::where('email', $userEmail)->first();

        $iduser = $memberId->id;
        $emailuser = $memberId->email;
        // $idmerchant = $request->idmerchant;

        $merchant = [];


        $response =  DB::select('select id, merchant_name from onepoint_merchant as m');

        // if (!empty($idmerchant)) {
        //     $response =  DB::select('select id, merchant_name from onepoint_merchant as m where id=' . $idmerchant);
        // }

        #get date minus one day
        $now = new DateTime(); // Create a DateTime object for the current date and time
        $now->modify('-1 day'); // Add one day to the current date and time
        $formattedDate = $now->format('Y-m-d H:i:s');


        for ($m = 0; $m < count($response); $m++) {

            $res = $response[$m];
            // $responsevouchers =  DB::select('select * from onepoint_voucher as m where m.id_merchant = '.$res->id);
            $voucherMember = DB::table('onepoint_log_claim_voucher')
                ->join('onepoint_member', 'onepoint_log_claim_voucher.id_member', '=', 'onepoint_member.id')
                ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
                ->where('onepoint_voucher.id_merchant', '=', $res->id)
                ->where('onepoint_voucher.date_start', '<=', date('Y-m-d H:i:s'))
                ->where('onepoint_voucher.date_end', '>=', $formattedDate)
                ->where('onepoint_log_claim_voucher.flag_used', '=', 'false')
                // ->where('(NOW() - INTERVAL 1 DAY)', '<=', 'onepoint_voucher.date_end')
                ->where(
                    function ($query) use ($iduser, $emailuser) {
                        $query->where('onepoint_member.email', '=', $emailuser);
                        $query->orWhere('onepoint_member.id', '=', $iduser);
                    }

                )
                ->select(

                    'onepoint_voucher.label',

                    'onepoint_voucher.pointneed',
                    'onepoint_voucher.short_desc',
                    'onepoint_voucher.date_end',

                )
                // ->selectRaw("DATE_FORMAT(onepoint_voucher.date_end, '%e %M %Y') AS formatted_date")

                ->get();

            if (!$voucherMember->isEmpty()) {
                $res->vouchers = $voucherMember;
                $merchant[] = $res;
            }
            // $res->vouchers = $voucherMember;
            // array_push($merchant, $res);
        }

        //and ((NOW() >= m.date_start) AND ((NOW() - INTERVAL 1 DAY) <= m.date_end))



        return $merchant;
    }
}
