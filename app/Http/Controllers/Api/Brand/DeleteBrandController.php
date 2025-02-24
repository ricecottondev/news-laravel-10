<?php

namespace App\Http\Controllers\Api\Brand;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;


class DeleteBrandController extends Controller
{
    public function index(Request $request)
    {
        try {
            Brand::findOrFail($request->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Success Delete records Product.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
