<?php

namespace App\Http\Controllers\Front\Dashboard;

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RajaOngkirServices;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    protected $rajaOngkirServices;

    public function __construct(RajaOngkirServices $rajaOngkirServices)
    {
        $this->rajaOngkirServices = $rajaOngkirServices;
    }

    public function index()
    {
        $title = 'Dashboard';

        // open tab with tenari operation
        if (isset($_GET['pageactive'])) {
            $pageactive = $_GET['pageactive'];
        } else {
            $pageactive = 'informasi';
        }

        // get data user
        $user = User::where('id', auth()->user()->id)
            ->first();

        // get data alamat
        $address = Address::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();

        // get data provinsi by rajaongkir
        $provinceData = Cache::rememberForever('province_data', function () {
            return $this->rajaOngkirServices->getProvince()['rajaongkir']['results'];
        });

        // get data city by rajaongkir
        $cityData = Cache::rememberForever('city_data', function () {
            return $this->rajaOngkirServices->getCity('')['rajaongkir']['results'];
        });

        // get data order by status
        $konfirmasisorder = Order::where('user_id', auth()->user()->id)
            ->where('status', ['menunggu pembayaran'])
            ->get();

        // get all data order / order history by id user
        $orderhistory = Order::where('user_id', auth()->user()->id)
            ->get();

        // get all wishlists by id user
        $wishlists = Wishlist::with('subProducts', 'subProducts.product', 'subProducts.kartuStock')
            ->where('id_user', auth()->user()->id)
            ->where('deleted', 'false')
            ->get();

        // dd($user);

        return view('front.member.dashboard.index', compact('title', 'pageactive', 'user', 'address', 'provinceData', 'cityData', 'konfirmasisorder', 'orderhistory', 'wishlists'));
    }
}
