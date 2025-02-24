<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GetPointMemberController extends Controller
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
        $idmember = $request->iduser;
        $response =  DB::select('select sum(point) as point from onepoint_log_claim_uniquecode as m where id_member = "'.$idmember.'"');

        $findpointused = DB::select('select sum(v.pointneed) as pointused from onepoint_log_claim_voucher as c
        inner join onepoint_voucher as v on v.id = c.id_onepoint_voucher
        where c.id_member = "'.$idmember.'"');

        //dd($response);
        $point = $response[0]->point;
        $pointused = $findpointused[0]-> pointused;
        return response()->json([
            'success' => true,
            'message' => 'Get Point Member',
            'point' => $point-$pointused,
        ]);
    }
}

