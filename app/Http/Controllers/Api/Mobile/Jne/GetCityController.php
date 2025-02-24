<?php

namespace App\Http\Controllers\Api\Mobile\Jne;

use App\Http\Controllers\Controller;
use App\Models\Jne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetCityController extends Controller
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

        $province = $request->province_name;
        $getJneCity = Jne::select('city_name')->where('province_name', $province)->distinct()->pluck('city_name')->toArray();


        return response()->json([
            'success' => true,
            'message' => 'Get ALL City',
            'data' => $getJneCity
        ], 200);
    }
}
