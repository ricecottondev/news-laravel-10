<?php

namespace App\Http\Controllers\Api\Offering;




use App\Models\ItemOffering;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OfferingRequest;
use Illuminate\Support\Facades\Validator;

class PostOfferingController extends Controller
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


            $Product = ItemOffering::create($input);
            return response()->json([
                'success' => true,
                'message' => 'Offering created successfully.',
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
