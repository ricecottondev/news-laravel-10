<?php

namespace App\Http\Controllers\Api\Merchant;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Merchant;
use Illuminate\Support\Facades\Validator;

class UpdateMerchantController extends Controller
{
    public function index(Request $request)
    {
        try {
            $input = $request->all();
            $validator = Validator::make($input, [
                'merchant_name' => 'required',
                'url' => 'required',
                'id' => 'required',

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                ], 200);
            }

            $editMerchant = Merchant::findOrFail($request->id);
            $editMerchant->merchant_name = $request->merchant_name;
            $editMerchant->url = $request->url;


            $editMerchant->save();

            $data = [
                'success' => true,
                'message' => 'Update  Merchant Success',
                'data' => $editMerchant

            ];


            return $data;
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
