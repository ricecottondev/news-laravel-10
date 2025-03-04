<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\Claim_voucher;
use App\Models\Claim_uniquecode;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Member as MemberModel;

class MemberProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // $memberId = MemberModel::where('email', $user->email)->first()->id;
        // $point = Claim_uniquecode::where('id_member', $memberId)->sum('point');
        // $pointUseds = Claim_voucher::where('id_member', $memberId)
        //     ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
        //     ->sum('onepoint_voucher.pointneed');


        // $totalPoint = $point - $pointUseds;
        // $voucherCount = Claim_voucher::where('id_member', $memberId)
        //     ->where('onepoint_log_claim_voucher.status', 'active')
        //     ->where('onepoint_log_claim_voucher.flag_used', 'false')
        //     ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
        //     ->count();

        if ($user->image) {
            $url = url('/') . '/images/users/' . $user->image;
        } else {
            $url = url('/') . '/images/users/user.png';
        }


        $userImageProfile =  $url;



        // $logPoint = Claim_uniquecode::select('onepoint_uniquecode.kode as id_uniquecode', 'onepoint_log_claim_uniquecode.point')
        //     ->selectRaw("DATE_FORMAT(onepoint_log_claim_uniquecode.created_at, '%Y-%m-%d %H:%i:%s') AS formatted_datetime")
        //     ->join('onepoint_uniquecode', 'onepoint_log_claim_uniquecode.id_uniquecode', '=', 'onepoint_uniquecode.id')
        //     ->where('onepoint_log_claim_uniquecode.id_member', $memberId)
        //     ->groupBy('onepoint_log_claim_uniquecode.id_uniquecode')
        //     ->get();

        //  dd($logPoint);

        // $logPoint = Claim_uniquecode::select(
        //     'onepoint_uniquecode.kode as id_uniquecode',
        //     DB::raw("MAX(onepoint_log_claim_uniquecode.point) as point"),
        //     DB::raw("DATE_FORMAT(MAX(onepoint_log_claim_uniquecode.created_at), '%Y-%m-%d %H:%i:%s') AS formatted_datetime")
        // )
        // ->join('onepoint_uniquecode', 'onepoint_log_claim_uniquecode.id_uniquecode', '=', 'onepoint_uniquecode.id')
        // ->where('onepoint_log_claim_uniquecode.id_member', $memberId)
        // ->groupBy('onepoint_uniquecode.kode', 'onepoint_log_claim_uniquecode.id_uniquecode') // Include kode in GROUP BY
        // ->get();

        //dd($logPoint);

        return view('page-sdamember.profil'
        , compact(
            // 'totalPoint',
            // 'voucherCount',
            'userImageProfile',
            //  'logPoint',
            // 'memberId'
        )
    );
    }
}
