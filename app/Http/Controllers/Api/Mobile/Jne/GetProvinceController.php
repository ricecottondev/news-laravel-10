<?php

namespace App\Http\Controllers\Api\Mobile\Jne;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GetProvinceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $provinces = [];
        $response =  DB::select('select province_name from jne_api group by province_name order by province_name');
        for ($m = 0; $m < count($response); $m++) {
            $res = $response[$m];
            array_push($provinces, $res->province_name);
        }

        // get data general all data
        return response()->json([
            'success' => true,
            'message' => 'Get All Province ',
            'data' => $provinces
        ], 200);
    }
}
