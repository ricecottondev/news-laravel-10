<?php

namespace App\Http\Controllers\Api\Member;

use JWTAuth;
use App\Models\Voucher;
use App\Models\PromoUser;
use App\Models\Notification;
use App\Services\FCMService;
use Illuminate\Http\Request;
use App\Models\Claim_voucher;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\Vouchers\PostVouchersController;

class ClaimVoucherMemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $idvoucher = $request->idvoucher;
        $kodevoucher = $request->kodevoucher;
        $iduser = $request->iduser;
        //$result = (new PostVouchersController)->index();

        $input['id_member'] = $iduser;
        $input['kode_voucher'] = $kodevoucher;
        $addClaimVoucher = Claim_voucher::create($input);

        // $input['id_customer'] = $id_customer;
        // $input['jabatan'] = 'Pemilik';
        // $input['ar'] = $userId;
        // $input['created_by'] = $userId;
        // $input['created_date'] = $createdDate;

        // $generalCreate = Claim_voucher::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Voucher ' . $kodevoucher . ' Claimed',
            'iduser' => $iduser,
        ]);
    }
    //
    public function indexMobile(Request $request)
    {

        // dd($bodyNotif);

        $user = JWTAuth::parseToken()->authenticate();
        $userEmail = $user->email;
        $memberId = MemberModel::where('email', $userEmail)->first();

    
      


        $response =  DB::select('select sum(point) as point from onepoint_log_claim_uniquecode as m where id_member = "' . $memberId->id . '"');
        $findpointused = DB::select('select sum(v.pointneed) as pointused from onepoint_log_claim_voucher as c
        inner join onepoint_voucher as v on v.id = c.id_onepoint_voucher
        where c.id_member = "' . $memberId->id . '"');

        $point = $response[0]->point;
        $pointused = $findpointused[0]->pointused;

        $totalUserPoint = $point - $pointused;

        $voucherPoint = Voucher::findOrFail($request->id);
        $id = $request->id;
        $data =
            DB::select('SELECT *, (SELECT COUNT(*) FROM onepoint_log_claim_voucher 
                WHERE onepoint_log_claim_voucher.id_onepoint_voucher = m.id) as claimed 
                FROM onepoint_voucher as m WHERE deleted = "false"AND m.id = ?
                AND ((NOW() >= m.date_start)AND ((NOW() - INTERVAL 1 DAY) <= m.date_end))', [$id]);

        // dd($voucherPoint->qtyvoucher . '  -   ' . $data[0]->claimed);
        $claim = $data[0]->claimed;
        $CheckQtyVoucher = $voucherPoint->qtyvoucher - $claim;
        // dd($totalUserPoint);
        if ($CheckQtyVoucher < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher Habis'
            ], 200);
        }

        // dd($totalUserPoint);
        if ($totalUserPoint >= $voucherPoint->pointneed) {

            $input['id_member'] = $memberId->id;
            $randomNumber = str_pad(random_int(1000, 9999), 4, '0', STR_PAD_LEFT);


            $input['kode_voucher'] = $voucherPoint->kode_voucher . '-' . $randomNumber;
            $input['id_onepoint_voucher'] = $voucherPoint->id;
            $input['flag_used'] = 'false';
            $addClaimVoucher = Claim_voucher::create($input);

            //point total for mobile

            $responseMobile =  DB::select('select sum(point) as point from onepoint_log_claim_uniquecode as m where id_member = "' . $memberId->id . '"');
            $findpointusedMobile = DB::select('select sum(v.pointneed) as pointused from onepoint_log_claim_voucher as c
            inner join onepoint_voucher as v on v.id = c.id_onepoint_voucher
            where c.id_member = "' . $memberId->id . '"');


            $pointMobile = $responseMobile[0]->point;
            $pointusedMobile = $findpointusedMobile[0]->pointused;

            $totalUserPointMobile = $pointMobile - $pointusedMobile;
            $voucherCount = Claim_voucher::where('id_member', $memberId->id)
            ->where('onepoint_log_claim_voucher.status', 'active')
            ->where('onepoint_log_claim_voucher.flag_used', 'false')
            ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
            ->count();
            $getVoucherJoin = Voucher::with('merchant')->where('onepoint_voucher.id', $request->id)->get()->toArray();


            $bodyNotif = 'Klaim Voucher ' .  $getVoucherJoin[0]['merchant']['merchant_name'] .  ' ' . $getVoucherJoin[0]['label'] . ' Berhasil';
            $titleNotif = 'Klaim Voucher';
            $notificationData = [
                'member_id' => $memberId->id,
                'notification_date' => Carbon::now(),
                'notification_title' => $titleNotif,
                'notification_content' => $bodyNotif,
                'notification_status' => 'Unread',
            ];

            $notification = Notification::create($notificationData);
            $data =  FCMService::send(
                $user->token_firebase,
                [
                    'title' => $titleNotif,
                    'body' =>  $bodyNotif,
                ]
            );

            $notifikasi = Notification::where('member_id', $memberId->id)
                ->orderBy('created_at', 'desc')
                ->take(20)
                ->get();

            $jumlahUnread = $notifikasi->where('notification_status', 'Unread')->count();
           
            $promoUser = PromoUser::where('member_id', $memberId->id)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
            $jumlahUnreadPromo = $promoUser->where('promo_status', 'Unread')->count();

            $totalNotif = $jumlahUnread + $jumlahUnreadPromo;

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Voucher Success Claim',
                    'voucherCount' => $voucherCount,
                    'point' => $totalUserPointMobile,
                    'notif' => $jumlahUnread,
                    'totalNotif' => $totalNotif,
                ],
                200
            );
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Poin tidak mencukupi'
            ], 200);
        }
    }
}
