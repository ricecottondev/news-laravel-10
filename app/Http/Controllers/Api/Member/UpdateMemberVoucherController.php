<?php

namespace App\Http\Controllers\Api\Member;

use DateTime;
use App\Models\User;
use App\Models\Member;
use App\Models\Voucher;
use App\Models\Notification;
use App\Services\FCMService;
use Illuminate\Http\Request;
use App\Models\Claim_voucher;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UpdateMemberVoucherController extends Controller
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

        $idclaimvoucher = $request->idclaimvoucher;
        $idmerchant = $request->idmerchant;
        $flag_used = $request->flag_used;


        #get date minus one day
        date_default_timezone_set('Asia/Jakarta');
        $now = new DateTime(); // Create a DateTime object for the current date and time
        $now->modify('-1 day'); // Add one day to the current date and time
        $formattedDate = $now->format('Y-m-d H:i:s');

        //dd($formattedDate);

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

    
        
        
        $ClaimVoucher = Claim_voucher::find($idclaimvoucher);
        $memberEmail = Member::find($ClaimVoucher->id_member)->email;
        $TokenFirebase = User::where('email', $memberEmail)->first();

        if($flag_used=='true'){
            $titleNotif = 'Aktivasi Voucher';
            $bodyNotif = 'Selamat, Voucher ' . $ClaimVoucher->kode_voucher . ' Berhasil Digunakan Di Merchant';
         
            $notificationData = [
                'member_id' => $ClaimVoucher->id_member,
                'notification_date' => Carbon::now(),
                'notification_title' => $titleNotif,
                'notification_content' => $bodyNotif,
                'notification_status' => 'Unread',
            ];
 
            $notification = Notification::create($notificationData);
 
            $data =  FCMService::send(
                $TokenFirebase->token_firebase,
                [
                    'title' => $titleNotif,
                    'body' => $bodyNotif,
                ]
            );
        }

        $ClaimVoucher->update($input);
       

        return response()->json([
            'success' => true,
            'message' => 'Voucher Member already updated',
        ], Response::HTTP_OK);
    }
}

