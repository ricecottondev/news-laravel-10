<?php

namespace App\Http\Controllers\Front\Member;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pages = $request->page;
        $page = (isset($pages)) ? $pages : 1;
        $limit = 8;
        $limit_start = ($page - 1) * $limit;
        // $no = $limit_start + 1;
        $idd = $request->iduser;

        // data riwayat transaksi
        $res_produk = Order::with(['orderDetails','orderDetails.subProduct'])->where('user_id', $idd)
            ->orderByDesc('tanggalorder')
            ->orderByDesc('jamorder')
            ->offset($limit_start)
            ->limit($limit)
            ->get();

        $query = Order::with('orderDetails')->where('user_id', $idd)->count();
        $data_masterproduk = [];

        for ($d = 0; $d < count($res_produk); $d++) {
            $data = $res_produk[$d];
            $data->test = [];
            array_push($data_masterproduk, $data);
        }

        $response_data = [];
        $response_data['pagination'] = $this->GetPagination($page, $query);
        $response_data['product'] = $data_masterproduk;

        return response()->json($response_data);
    }

    /**
     * Display a geting of the pagination.
     */
    public function GetPagination($pages, $querys)
    {
        // $page = 2;
        $page = (isset($pages)) ? $pages : 1;
        $limit = 8;

        // $res_total_records = DB::select('select count(*) as jumlah from masterproduk');
        $total_records = $querys;

        // $total_records = $res_total_records;
        // $total_records = $res_total_records[0]->jumlah;

        $jumlah_page = ceil($total_records / $limit);
        $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
        $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
        $end_number = ($page < $jumlah_page) ? $page + $jumlah_number : $jumlah_page;

        $pagination = "";

        if ($page == 1) {
            $pagination = $pagination . '<li class="page-item disabled"><button class="page-link">First</button></li>';
            $pagination = $pagination . '<li class="page-item disabled"><button class="page-link"><span aria-hidden="true">&laquo;</span></button></li>';
        } else {
            $link_prev = ($page > 1) ? $page - 1 : 1;
            $show_first = "listorder(1)";
            $show_first_product = "listorder($link_prev)";

            $pagination = $pagination . '<li class="page-item halaman" id="1"><button class="page-link" onclick="' . $show_first . '">First</button></li>';
            $pagination = $pagination . '<li class="page-item halaman" id="' . $link_prev . '"><button class="page-link" onclick="' . $show_first_product . '"><span aria-hidden="true">&laquo;</span></button></li>';
        }

        for ($i = $start_number; $i <= $end_number; $i++) {
            $link_active = ($page == $i) ? ' active' : '';
            $show_product = "listorder($i)";
            $pagination = $pagination . '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><button class="page-link" onclick="' . $show_product . '">' . $i . '</button></li>';
        }

        if ($page == $jumlah_page) {
            $pagination = $pagination . '<li class="page-item disabled"><button class="page-link"><span aria-hidden="true">&raquo;</span></button></li>';
            $pagination = $pagination . '<li class="page-item disabled"><button class="page-link">Last</button></li>';
        } else {
            $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
            $show_last = "listorder($link_next)";
            $show_last_product = "listorder($jumlah_page)";

            $pagination = $pagination . '<li class="page-item halaman" id="' . $link_next . '"><button class="page-link" onclick="' . $show_last . '""><span aria-hidden="true">&raquo;</span></button></li>';
            $pagination = $pagination . '<li class="page-item halaman" id="' . $jumlah_page . '"><button class="page-link" onclick="' . $show_last_product . '">Last</button></li>';
        }

        return $pagination;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Lacak($id)
    {
        $dataOrderById = Order::find($id);
        // $waybill = $dataOrderById["nomor_resi"];
        // $waybill = "0334712300022495";
        $waybill = "0334712400000318";
        // $waybill = "004351351950";
        // $waybill = "";

		$body = "username=ASIATERRA&api_key=82f6b11eba4b7d92c5f48567d3e55149";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://apiv2.jne.co.id:10101/tracing/api/list/v1/cnote/".$waybill);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$resultTrack = json_decode($output, true);
		curl_close($ch);

        // dd($resultTrack);

        return response()->json(['data' => $resultTrack]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
