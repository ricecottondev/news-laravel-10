<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Member;
use App\Models\Voucher;
use App\Models\Claim_voucher;


use Symfony\Component\HttpFoundation\Response;

class GetApiMemberVoucherController extends Controller
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

        $merchant = [];
        $response = DB::table('onepoint_merchant as m')->select('merchant_name', 'id')
            ->get();

        foreach ($response as $res) {
            $voucherMember = DB::table('onepoint_log_claim_voucher')
                ->join('onepoint_member', 'onepoint_log_claim_voucher.id_member', '=', 'onepoint_member.id')
                ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
                ->where('onepoint_log_claim_voucher.id_member', '=', $iduser)
                ->where('onepoint_voucher.id_merchant', '=', $res->id)
                ->select('onepoint_log_claim_voucher.kode_voucher', 'onepoint_voucher.label', 'onepoint_voucher.short_desc', 'onepoint_voucher.date_start', 'onepoint_voucher.date_end', 'onepoint_voucher.disctype', 'onepoint_voucher.discvalue', 'onepoint_voucher.status')
                ->get();

            if (!$voucherMember->isEmpty()) {
                $res->vouchers = $voucherMember;
                $merchant[] = $res;
            }
        }





        return response()->json([
            'success' => true,
            'message' => 'Get Voucher Member',
            'data' => $merchant
        ], Response::HTTP_OK);
    }
}
