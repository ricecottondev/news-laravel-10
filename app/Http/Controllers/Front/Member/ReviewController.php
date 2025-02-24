<?php

namespace App\Http\Controllers\Front\Member;

use App\Models\Order;
use App\Models\UserReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderHistory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $orderupdate = Order::findOrFail($request->idorder);
        $orderupdate->update(['beri_nilai' => 'sudah']);

        date_default_timezone_set('Asia/Jakarta');
        $tglhariini = date('Y-m-d');
        $jamhis = date('H:i:s');

        for ($i = 0; $i <= $request->jml - 1; $i++) {
            $review = new UserReview([
                'user_id' => $request->iduser,
                'order_id' => $request->idorder,
                'produk_id' => $request->idproduk[$i],
                // 'namaproduk' => $request->namaproduk[$i],
                'nilainya' => $request->nilai[$i],
                'comment' => $request->comment[$i],
                'tanggal_review' => $tglhariini . " " . $jamhis,
            ]);

            $review->save();
        }

        // return back();
        return back()->with([
            'success' => 'Terimakasih atas reviewnya, Semoga puas dengan pelayanan kami',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::where('id', $id)->with(['orderDetails', 'orderDetails.subProduct'])->first();

        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function showDetail(string $id)
    {
        $title = 'Detail Order';
        $order = Order::where('id', $id)->with(['orderDetails', 'orderDetails.subProduct'])->first();

        return view('front.member.dashboard.history.detail_order', compact('title', 'order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function pesananditerima(Request $request, string $id)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            // Check if the order exists
            $getOrder = Order::findOrFail($id);
            // Update the order status
            $setstatusselesai = $getOrder->update([
                'status' => $request->pesananditerima,
                'tgl_terima_barang' => date('Y-m-d H:i:s'),
            ]);

            if ($setstatusselesai) {
                $orderHistories = [
                    'order_id' => $getOrder->id,
                    'status' => 'selesai',
                    'keterangan' => 'Pesanan Selesai',
                ];

                OrderHistory::create($orderHistories);
                // if (intval($request->poinval) > 0) {
                //     Transaksi_poin::create([
                //         'iduser' => $getOrder->iduser,
                //         'email' => $getOrder->email,
                //         'status' => 'masuk',
                //         'keterangan' => 'mendapatkan poin dari transaksi ' . $getOrder->nomerorder,
                //         'jumlahpoin' => $request->poinval,
                //         'tanggal' => date('Y-m-d'),
                //         'jam' => date('H:i:s'),
                //     ]);
                //     $this->sendpoin($getOrder->email, $request->poinval);
                // }

                // Redirect to the correct route with the order ID
                return redirect('/orderdetails' . '/' . $id);
            } else {
                // dump($setstatusselesai);
                return back()->with('error', 'Failed to update order status.');
            }
        } catch (ModelNotFoundException $exception) {
            // dump($exception);
            return back()->with('error', 'Order not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
