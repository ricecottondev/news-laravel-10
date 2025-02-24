<?php

namespace App\Http\Controllers\Api\Brand;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;

class PostBrandController extends Controller
{
    public function index(Request $request)
    {
        try {
            $input = $request->all();
            $validator = Validator::make($input, [
                'brand' => 'required',
                'status' => 'required',

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                ], 200);
            }



            $Product = Brand::create($input);
            return response()->json([
                'success' => true,
                'message' => 'Brand created successfully.',
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
