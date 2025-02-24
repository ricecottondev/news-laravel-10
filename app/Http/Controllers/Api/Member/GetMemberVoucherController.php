<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Member;
use App\Models\Voucher;
use App\Models\Claim_voucher;
use DateTime;
use App\Models\Member as MemberModel;


use Symfony\Component\HttpFoundation\Response;

class GetMemberVoucherController extends Controller
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
        $iduser = $request->iduser;
        $emailuser = $request->emailuser;
        $idmerchant = $request->idmerchant;

        // $users = DB::table('users')->where('email','=', $emailuser)->get();

        //dd($users);

        $merchant = [];


        $response =  DB::select('select * from onepoint_merchant as m');

        if (!empty($idmerchant)) {
            $response =  DB::select('select * from onepoint_merchant as m where id=' . $idmerchant);
        }

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
                    'onepoint_log_claim_voucher.*',
                    'onepoint_voucher.id as id_voucher',
                    'onepoint_log_claim_voucher.kode_voucher',
                    'onepoint_voucher.label',
                    'onepoint_voucher.short_desc',
                    'onepoint_voucher.desc',
                    'onepoint_voucher.date_start',
                    'onepoint_voucher.date_end',
                    'onepoint_voucher.pointneed',
                    'onepoint_voucher.qtyvoucher',
                    'onepoint_voucher.disctype',
                    'onepoint_voucher.discvalue',
                    'onepoint_voucher.minorder',
                    'onepoint_voucher.status',
                    'onepoint_voucher.deleted',
                )
                ->get();
            $res->vouchers = $voucherMember;
            array_push($merchant, $res);
        }

        //and ((NOW() >= m.date_start) AND ((NOW() - INTERVAL 1 DAY) <= m.date_end))



        return response()->json([
            'success' => true,
            'message' => 'Get Voucher Member',
            'data' => $merchant
        ], Response::HTTP_OK);
    }


    public function indexMobile(Request $request)
    {

        $user = JWTAuth::parseToken()->authenticate();
        $userEmail = $user->email;
        $memberId = MemberModel::where('email', $userEmail)->first();

        $iduser = $memberId->id;
        $emailuser = $memberId->email;
        $idmerchant = $request->idmerchant;

        $merchant = [];


        $response =  DB::select('select id, merchant_name from onepoint_merchant as m');

        if (!empty($idmerchant)) {
            $response =  DB::select('select id, merchant_name from onepoint_merchant as m where id=' . $idmerchant);
        }

        #get date minus one day
        $now = new DateTime(); // Create a DateTime object for the current date and time
        $now->modify('-1 day'); // Add one day to the current date and time
        $formattedDate = $now->format('Y-m-d H:i:s');
        $urlVoucher = url('/detail-voucher');

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

                    'onepoint_log_claim_voucher.id',
                    'onepoint_voucher.label',
                    'onepoint_log_claim_voucher.kode_voucher',
                    'onepoint_voucher.pointneed',
                    'onepoint_voucher.short_desc',
                    'onepoint_voucher.date_end',

                )
                // ->selectRaw("DATE_FORMAT(onepoint_voucher.date_end, '%e %M %Y') AS formatted_date")

                ->get();

            foreach ($voucherMember as $voucher) {
                $voucher->urlVoucher = $urlVoucher;
            }

            if (!$voucherMember->isEmpty()) {
                $res->vouchers = $voucherMember;
                $merchant[] = $res;
            }
            // $res->vouchers = $voucherMember;
            // array_push($merchant, $res);
        }

        //and ((NOW() >= m.date_start) AND ((NOW() - INTERVAL 1 DAY) <= m.date_end))



        return response()->json([
            'success' => true,
            'message' => 'Get Voucher Member',
            'data' => $merchant
        ], Response::HTTP_OK);
    }
}
