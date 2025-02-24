<?php

namespace App\Http\Controllers\Api\Merchant;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Support\Facades\Validator;

class PostMerchantController extends Controller
{
    public function index(Request $request)
    {
        try {
            $input = $request->all();
            $validator = Validator::make($input, [
                'merchant_name' => 'required',
                'url' => 'required',

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                ], 200);
            }



            $Product = Merchant::create($input);
            return response()->json([
                'success' => true,
                'message' => 'Merchant created successfully.',
                'data' =>   $Product
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
