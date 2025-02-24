<?php

namespace App\Http\Controllers\Api\Promo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GetPromoController extends Controller
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
        $promo = [];
        $response =  DB::select('select * from onepoint_promo');
        for ($m = 0; $m < count($response); $m++) {
            $res = $response[$m];
            array_push($promo, $res);
        }
        return $promo;
    }

    public function getByFilter(Request $request)
    {

        $response =  DB::select('select * from merchandise_product_models');
        return $response;
    }
}