<?php

namespace App\Http\Controllers\Api\Offering;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ItemOffering;
use Illuminate\Support\Facades\Validator;

class UpdateOfferingController extends Controller
{
    public function index(Request $request)
    {
        try {
            $input = $request->all();
            $validator = Validator::make($input, [
                'id_member' => 'required',
                'id_produk' => 'required',
                'recom_start_date' => 'required',
                'recom_end_date' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                ], 200);
            }

            $editProduct = ItemOffering::findOrFail($request->id);
            $editProduct->id_member = $request->id_member;
            $editProduct->id_produk = $request->id_produk;
            $editProduct->recom_start_date = $request->recom_start_date;
            $editProduct->recom_end_date = $request->recom_end_date;
            $editProduct->status = $request->status;


            $editProduct->save();

            $data = [
                'success' => true,
                'message' => 'Update  Offering Success',
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
