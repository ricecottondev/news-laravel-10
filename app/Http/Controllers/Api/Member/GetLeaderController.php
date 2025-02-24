<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class GetLeaderController extends Controller
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
        $members = [];
        $month = $request->month;
        $year = $request->year;

        $stringfilter = '';

        if(isset($request->month))
        {
            $month = $request->month;        
            $stringfilter = $stringfilter.' and MONTH(cu.created_at)='.$month;
        }

        if(isset($request->year))
        {
            $year = $request->year;
            $stringfilter = $stringfilter.' and YEAR(cu.created_at)='.$year;
        }

       


        $response =  DB::select('select u.id,u.email,
        (select sum(cu.point) from onepoint_log_claim_uniquecode as cu where cu.id_member = u.id'.$stringfilter.') as total_point,
        (select sum(v.pointneed) from onepoint_log_claim_voucher as cv INNER JOIN onepoint_voucher as v on cv.id_onepoint_voucher = v.id where cv.id_member = u.id) as point_used,
        ((select sum(cu.point) from onepoint_log_claim_uniquecode as cu where cu.id_member = u.id) -  (select sum(v.pointneed) from onepoint_log_claim_voucher as cv INNER JOIN onepoint_voucher as v on cv.kode_voucher = v.kode_voucher where cv.id_member = u.id)) as actual_point
         from users as u order by actual_point desc limit 5');
        for ($m = 0; $m < count($response); $m++) {
            $res = $response[$m];
            array_push($members, $res);
        }
        // return $members;

        return response()->json([
            'success' => true,
            'message' => 'Get Leader Member',
            'leaders' => $members
        ], Response::HTTP_OK);
    }
}

