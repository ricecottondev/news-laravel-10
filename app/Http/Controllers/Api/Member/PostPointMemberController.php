<?php

namespace App\Http\Controllers\Api\Member;

use JWTAuth;
use App\Models\PromoUser;
use App\Models\Notification;
use App\Services\FCMService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Claim_uniquecode;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;

class PostPointMemberController extends Controller
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

        if (isset($request->kode)) {
            $user = JWTAuth::parseToken()->authenticate();
            $userEmail = $user->email;
            $memberId = MemberModel::where('email', $userEmail)->first();

            $kode = $request->kode;
            $iduser = $memberId->id;

            // Check if member has filled in all required fields
            //  if (empty($memberId->telp) || empty($memberId->ktp) || empty($memberId->address) || empty($memberId->gender) || empty($memberId->birth_date)) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Silahkan lengkapi data diri anda terlebih dahulu.'
            //     ], 200);
            // }
            $response = DB::select('select * from onepoint_uniquecode where kode="' . $kode . '"');

            if (empty($response)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode invalid.'
                ], 200);
            }

            $expiredDate = Carbon::parse($response[0]->expired_date)->endOfDay();

            if ($expiredDate < now()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode Telah Expired.'
                ], 200);
            }

            // dd('lolos');

            $StatusUniquecode = $response[0]->status;
            $PointUniquecode = $response[0]->point;
            $PointUniquecodeId = $response[0]->id;


            if (empty($StatusUniquecode)||($StatusUniquecode=="unused")) {
                DB::update('UPDATE onepoint_uniquecode SET status = "used" WHERE kode="' . $kode . '"');

                ##insert perulangan untuk claim uniquecode dengan metode kupon 1 point
                // for ($p=0; $p < $PointUniquecode; $p++) {
                //     $Onepoint_voucher = Claim_uniquecode::create(['id_member' => $iduser, 'id_uniquecode' => $kode, 'point' => 1]);
                // }

                ##insert untuk claim uniquecode dengan metode value point sesuai dengan point kupon
                $Onepoint_voucher = Claim_uniquecode::create(['id_member' => $iduser, 'id_uniquecode' => $PointUniquecodeId, 'point' => $PointUniquecode]);

                $pointMember =  DB::select('select sum(point) as point from onepoint_log_claim_uniquecode as m where id_member = "' . $iduser . '"');

                $findpointused = DB::select('select sum(v.pointneed) as pointused from onepoint_log_claim_voucher as c
                inner join onepoint_voucher as v on v.id = c.id_onepoint_voucher
                where c.id_member = "' . $iduser . '"');

                $point = $pointMember[0]->point;
                $pointused = $findpointused[0]->pointused;

                $totalPoint = $point - $pointused;
                //   $user = JWTAuth::parseToken()->authenticate();
                //  dd();
                $titleNotif = 'Klaim Poin';
                $bodyNotif = 'Selamat, anda berhasil mendapatkan ' . $PointUniquecode . ' Poin';

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
                        'body' => $bodyNotif,
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

                // return $data;

                return response()->json([
                    'success' => true,
                    // 'id' => $response[0]->id,
                    'kode' => $response[0]->kode,
                    'point' => $totalPoint,
                    'notif' => $jumlahUnread,
                    'totalNotif' => $totalNotif,
                    'message' =>  $bodyNotif
                    // 'status' => $response[0]->status,
                    // 'deleted' => $response[0]->deleted,
                    // 'created_at' => $response[0]->created_at,
                    // 'updated_at' => $response[0]->updated_at,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    // 'kode' => $response[0]->kode,
                    // 'status' => $StatusUniquecode,
                    'message' => 'Kode Sudah Terpakai.'
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kode Invalid.'
            ], 200);
        };

        // $uniquecode = [];

        // for ($m = 0; $m < count($response); $m++) {
        //     $res = $response[$m];
        //     array_push($uniquecode, $res);
        // }
        // return $uniquecode;
    }
}
