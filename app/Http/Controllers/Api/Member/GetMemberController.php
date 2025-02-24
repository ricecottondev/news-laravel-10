<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GetMemberController extends Controller
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
        $response =  DB::select('select * from onepoint_member as m');
        for ($m = 0; $m < count($response); $m++) {
            $res = $response[$m];
            array_push($members, $res);
        }
        return $members;
    }
}

