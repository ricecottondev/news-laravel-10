<?php

namespace App\Http\Controllers\Front\Member;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTraits;
use App\Http\Controllers\Controller;
use App\Models\OrderHistory;
use Illuminate\Support\Facades\Validator;

class ConfrimPaymentController extends Controller
{
    use ImageUploadTraits;
    protected $pathImage;

    public function __construct()
    {
        $this->pathImage = 'images/buktiPembayaran/';
    }

    public function orderbyid($id)
    {

        $konfirmasisorder = Order::find($id);

        if ($konfirmasisorder) {
            return response()->json([
                "success" => true,
                "message" => "Order found successfully",
                "data" => $konfirmasisorder
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Order not found",
            ], 404); // 404 indicates a "Not Found" status code
        }
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Atur validasi sesuai kebutuhan
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator)
                ->with([
                    'errorconfirmpayment' => 'Konfirmasi Pembayaran Gagal, Silahkan coba lagi',
                ]);
        }

        if ($request->hasFile('file')) {
            $imagePath = $this->uploadImageConfirmPayment($request, 'file', $this->pathImage);
            $filesname = $this->pathImage . $imagePath['imagename'] . '.' . $imagePath['ext'];
        }
        // if ($request->hasFile('file')) {
        //     $imagePath = $this->uploadImageAsset($request, 'file', $this->pathImage);
        //     $filesname = $this->pathImage . $imagePath['imagename'] . '.' . $imagePath['ext'];
        // }

        // Update kolom files pengguna dengan URL foto yang baru
        $users = Order::findOrFail($request->selectnomor);
        $users->update([
            'status' => 'menunggu konfirmasi',
            'tanggal_lunas' => now('Asia/Jakarta'),
            'bukti_transfer' => $filesname
        ]);

        if ($users) {

            $dataHistory = [
                'order_id' => $request->selectnomor,
                'status' => 'menunggu konfirmasi',
                'keterangan' => 'Menunggu Konfirmasi Pembayaran Dari Admin',
            ];
            OrderHistory::create($dataHistory);

            return back()->with([
                'success' => 'Konfirmasi Pembayaran Berhasil, Pesanan Anda sedang diproses',
            ]);
        } else {
            return back()
                ->withInput()
                ->withErrors($validator)
                ->with([
                    'errorconfirmpayment' => 'Konfirmasi Pembayaran Gagal, Silahkan coba lagi',
                ]);
        }
    }
}
