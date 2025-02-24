<?php

namespace App\Http\Controllers\Api\Mobile\Member\Voucher;

use JWTAuth;
use DateTime;
use App\Models\PromoUser;
use App\Models\Notification;
use App\Services\FCMService;
use Illuminate\Http\Request;
use App\Models\Claim_voucher;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;

class ActivateVoucherController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $userEmail = $user->email;
        $memberId = MemberModel::where('email', $userEmail)->first();
        $flag_used = 'true';


           #get date minus one day
           date_default_timezone_set('Asia/Jakarta');
           $now = new DateTime(); // Create a DateTime object for the current date and time
           $now->modify('-1 day'); // Add one day to the current date and time
           $formattedDate = $now->format('Y-m-d H:i:s');
      
           #update flag used menjadi true setalah voucher terpakai
           $input['flag_used'] = $flag_used;
           
           if($flag_used=='false')
           {
               $input['used_at'] =  null;
           }
           else
           {
               $input['used_at'] =  date("Y-m-d H:i:s");
   
           }
           
           $ClaimVoucher = Claim_voucher::find($request->id);

           $titleNotif = 'Aktivasi Voucher';
           $bodyNotif = 'Selamat, Voucher ' . $ClaimVoucher->kode_voucher . ' Berhasil Digunakan';

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
           
         
          
           $ClaimVoucher->update($input);

           $voucherCount = Claim_voucher::where('id_member', $memberId->id)
           ->where('onepoint_log_claim_voucher.status', 'active')
           ->where('onepoint_log_claim_voucher.flag_used', 'false')
           ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
           ->count();
           return response()->json([
            'success' => true,
            'message' => 'Voucher Berhasil Digunakan.',
            'notif' => $jumlahUnread,
            'totalNotif' => $totalNotif,
            'voucherCount' => $voucherCount,
        ], 200);
    }
}
