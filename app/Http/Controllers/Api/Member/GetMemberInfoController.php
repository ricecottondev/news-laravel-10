<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GetMemberInfoController extends Controller
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

        $findpointused = DB::select('select sum(v.pointneed) as pointused from onepoint_log_claim_voucher as c inner join onepoint_voucher as v on v.id = c.id_onepoint_voucher
        where c.id_member = "'.$idmember.'"');

        $query_count_login_this_day = DB::select('SELECT count(*) as count_login FROM onepoint_log_login WHERE type = "login" and created_at >= CURRENT_DATE()');
        $query_count_logout_this_day = DB::select('SELECT count(*) as count_logout FROM onepoint_log_login WHERE type = "logout" and created_at >= CURRENT_DATE()');

        $count_login_this_day =  $query_count_login_this_day[0]->count_login;
        $count_logout_this_day = $query_count_logout_this_day[0]->count_logout;

        //dd($response);
        $point = $response[0]->point;
        $pointused = $findpointused[0]-> pointused;
        return response()->json([
            'success' => true,
            'message' => 'Get Info Member',
            'count_login_thisday' => $count_login_this_day,
            'count_logout_thisday' => $count_logout_this_day,
            'point' => $point-$pointused,
        ]);
    }
}

