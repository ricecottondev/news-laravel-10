<?php

namespace App\Http\Controllers\Api\Mobile\Jne;

use App\Http\Controllers\Controller;
use App\Models\Jne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetDistrictController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $province = $request->province_name;
        $city = $request->city_name;

        $getJneDistrict = Jne::select('district_name')->where('province_name', $province)->where('city_name', $city)->distinct()->pluck('district_name')->toArray();

        return response()->json(
            [
                'success' => true,
                'message' => 'Get ALL District',
                'data' => $getJneDistrict
            ],
            200
        );
    }
}
