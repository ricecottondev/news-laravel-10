<?php

namespace App\Http\Controllers\Api\Mobile\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Support\Facades\DB;

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
        $fullUrl = url('/merchant') . '/';
        // $merchant = Merchant::select('merchant_name as name', 'label', 'url',  'image')->get();
        $merchant = Merchant::select('merchant_name as name', 'label', 'url',  DB::raw("CONCAT('$fullUrl', image) as image"))->get();

        // $transformedData = [];

        // foreach ($merchant as $item) {
        //     $transformedData[$item->merchant_name] = $item->url;
        // }

        $data = [
            'success' => true,
            'message' => 'Get Merchant',
            'merchant' => $merchant,
        ];

        // $merge =  array_merge($data, $transformedData);
        return $data;
    }
}
