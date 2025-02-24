<?php

namespace App\Http\Controllers\Api\Brand;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;


class GetBrandController extends Controller
{
    public function index(Request $request)
    {
        $data = Brand::pluck('brand');

        return response()->json([
            'success' => true,
            'message' => 'Get Product All',
            'data' => $data,
        ], 200);
    }
}
