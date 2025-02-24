<?php

namespace App\Http\Controllers\Api\Offering;


use App\Models\ItemOffering;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DeleteOfferingController extends Controller
{
    public function index(Request $request)
    {
        try {
            $offering = ItemOffering::findOrFail($request->id);
            $offering->update(['deleted' => Carbon::now()]);
            return response()->json([
                'success' => true,
                'message' => 'Success Delete records Offering.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
