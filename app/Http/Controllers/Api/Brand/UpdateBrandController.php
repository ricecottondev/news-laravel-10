<?php

namespace App\Http\Controllers\Api\Brand;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;

class UpdateBrandController extends Controller
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

            $editProduct = Brand::findOrFail($request->id);
            $editProduct->brand = $request->brand;
            $editProduct->status = $request->status;


            $editProduct->save();

            $data = [
                'success' => true,
                'message' => 'Update  Brand Success',
                'data' => $editProduct

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
