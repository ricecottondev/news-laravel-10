<?php

namespace App\Http\Controllers\Api\Merchant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GetMerchantController extends Controller
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
        $merchant = [];
        $response =  DB::select('select * from onepoint_merchant');
        for ($m = 0; $m < count($response); $m++) {
            $res = $response[$m];
            array_push($merchant, $res);
        }
        return $merchant;
    }

    public function indexMobile(Request $request)
    {
        $merchant = Merchant::select('merchant_name', 'url')->get();

        $transformedData = [];

        foreach ($merchant as $item) {
            $transformedData[$item->merchant_name] = $item->url;
        }

        $data = [
            'success' => true,
            'message' => 'Get Merchant',
        ];

        $merge =  array_merge($data, $transformedData);
        return $merge;
    }

    public function getByFilter(Request $request)
    {

        $response =  DB::select('select * from merchandise_product_models');
        return $response;
    }
}
