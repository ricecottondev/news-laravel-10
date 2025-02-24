<?php

namespace App\Http\Controllers\Api\Mobile\Jne;

use App\Http\Controllers\Controller;
use App\Models\Jne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetSubDistrictController extends Controller
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
        $city = $request->city_name;
        $district = $request->district_name;

        $getJneSubDistrict = Jne::select('subdidstrict_name')->where('province_name', $province)->where('city_name', $city)->where('district_name', $district)->distinct()->pluck('subdidstrict_name')->toArray();
        $getJneZipCode = Jne::select('zip_code')->where('province_name', $province)->where('city_name', $city)->where('district_name', $district)->distinct()->pluck('zip_code')->toArray();

        $data = [
            'success' => true,
            'GetName' => $getJneSubDistrict,
            'GetZipCode' => $getJneZipCode,
        ];

        $zipCode = array_shift($data["GetZipCode"]);

        $data["GetZipCode"] = $zipCode;
        return $data;
    }
}
