<?php

namespace App\Http\Controllers\Api\Merchant;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merchant;

class DeleteMerchantController extends Controller
{
    public function index(Request $request)
    {
        try {
            Merchant::findOrFail($request->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Success Delete records Merchant.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
