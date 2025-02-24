<?php

namespace App\Http\Controllers\Api\Member;

use JWTAuth;
use Illuminate\Http\Request;
use App\Models\Claim_uniquecode;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;

class GetLogPointMemberController extends Controller
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
        $user = JWTAuth::parseToken()->authenticate();
        $userEmail = $user->email;
        $memberId = MemberModel::where('email', $userEmail)->first()->id;


        // $logPoint = Claim_uniquecode::select('onepoint_uniquecode.kode as id_uniquecode', 'onepoint_log_claim_uniquecode.point')
        //     ->selectRaw("DATE_FORMAT(onepoint_log_claim_uniquecode.created_at, '%Y-%m-%d %H:%i:%s') AS formatted_datetime")
        //     ->join('onepoint_uniquecode', 'onepoint_log_claim_uniquecode.id_uniquecode', '=', 'onepoint_uniquecode.id')
        //     ->where('onepoint_log_claim_uniquecode.id_member', $memberId)
        //     ->groupBy('onepoint_log_claim_uniquecode.id_uniquecode')
        //     ->get();

            $logPoint = Claim_uniquecode::select(
                'onepoint_uniquecode.kode as id_uniquecode',
                DB::raw("MAX(onepoint_log_claim_uniquecode.point) as point"),
                DB::raw("DATE_FORMAT(MAX(onepoint_log_claim_uniquecode.created_at), '%Y-%m-%d %H:%i:%s') AS formatted_datetime")
            )
            ->join('onepoint_uniquecode', 'onepoint_log_claim_uniquecode.id_uniquecode', '=', 'onepoint_uniquecode.id')
            ->where('onepoint_log_claim_uniquecode.id_member', $memberId)
            ->groupBy('onepoint_uniquecode.kode', 'onepoint_log_claim_uniquecode.id_uniquecode') // Include kode in GROUP BY
            ->get();


        return response()->json(
            [
                'success' => true,
                'message' => 'Get Log Point Member',
                'data' => $logPoint,
            ],
            200
        );
    }
}
