<?php

namespace App\Http\Controllers\Api\Offering;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ItemOffering;

class GetOfferingController extends Controller
{
    public function index(Request $request)
    {
        $data = ItemOffering::all();

        return response()->json([
            'success' => true,
            'message' => 'Get Offering All',
            'data' => $data,
        ], 200);
    }
}
