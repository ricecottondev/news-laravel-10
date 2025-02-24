<?php

namespace App\Http\Controllers;

use App\Models\PromoUser;

use App\Models\ItemOffering;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Claim_voucher;
use Illuminate\Support\Carbon;

use App\Models\Claim_uniquecode;
use App\Models\ItemRecommendation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Member as MemberModel;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        #Get Data Auth user
        $user = Auth::user();
        // dd();
        #tampung semua data user pada variable
        if ($user->hasRole('Member')) {
            $memberId = MemberModel::where('email', $user->email)->first()->id;

            $now = Carbon::now();

           

                $voucherCount = Claim_voucher::where('id_member', $memberId)
                    ->where('onepoint_log_claim_voucher.status', 'active')
                    ->where('onepoint_log_claim_voucher.flag_used', 'false')
                    ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
                    ->where('onepoint_voucher.deleted', 'false')
                    ->where(function ($query) use ($now) {
                        $query->where('onepoint_voucher.date_start', '<=', $now)
                            ->where('onepoint_voucher.date_end', '>=', $now->subDay());
                    })
                    ->count();

            $notifikasi = Notification::where('member_id', $memberId)
                ->orderBy('created_at', 'desc')
                ->take(20)
                ->get();

            $jumlahUnread = $notifikasi->where('notification_status', 'Unread')->count();
            $promoUser = PromoUser::where('member_id', $memberId)
                ->orderBy('created_at', 'desc')
                ->take(20)
                ->get();
            $jumlahUnreadPromo = $promoUser->where('promo_status', 'Unread')->count();


            $totalNotif = $jumlahUnread + $jumlahUnreadPromo;



            $today = now();
            $fullUrl = url('/');
            $Recomended = ItemRecommendation::where(function ($query) use ($memberId) {
                $query->where('id_member', $memberId)
                    ->orWhereNull('id_member')
                    ->orWhere('id_member', '');
            })
                ->with(['produk' => function ($query) use ($fullUrl) {
                    $query->select('kategori', 'namaproduk', 'kemasan', 'harga', 'id', 'url')
                        ->selectRaw("CASE WHEN LENGTH(gambar) > 0 THEN CONCAT('$fullUrl', '/files/', gambar) ELSE NULL END AS gambar");
                    // ->selectRaw("CASE WHEN LENGTH(gambar1) > 0 THEN CONCAT('$fullUrl', '/files/', gambar1) ELSE NULL END AS gambar1")
                    // ->selectRaw("CASE WHEN LENGTH(gambar2) > 0 THEN CONCAT('$fullUrl', '/files/', gambar2) ELSE NULL END AS gambar2")
                    // ->selectRaw("CASE WHEN LENGTH(gambar3) > 0 THEN CONCAT('$fullUrl', '/files/', gambar3) ELSE NULL END AS gambar3");
                }])
                ->where(function ($query) use ($today) {
                    $query->where('recom_start_date', '<=', $today)
                        ->where('recom_end_date', '>=', $today);
                })
                ->where('status', 'active')
                ->get()
                ->take(4);
            $transformedRecomended = $Recomended->pluck('produk')->flatten()->all();


            $Offering = ItemOffering::where(function ($query) use ($memberId) {
                $query->where('id_member', $memberId)
                    ->orWhereNull('id_member')
                    ->orWhere('id_member', '');
            })
                ->with(['produk' => function ($query) use ($fullUrl) {
                    $query->select('kategori', 'namaproduk', 'kemasan', 'harga', 'id', 'url')
                        ->selectRaw("CASE WHEN LENGTH(gambar) > 0 THEN CONCAT('$fullUrl', '/files/', gambar) ELSE NULL END AS gambar");
                    // ->selectRaw("CASE WHEN LENGTH(gambar1) > 0 THEN CONCAT('$fullUrl', '/files/', gambar1) ELSE NULL END AS gambar1")
                    // ->selectRaw("CASE WHEN LENGTH(gambar2) > 0 THEN CONCAT('$fullUrl', '/files/', gambar2) ELSE NULL END AS gambar2")
                    // ->selectRaw("CASE WHEN LENGTH(gambar3) > 0 THEN CONCAT('$fullUrl', '/files/', gambar3) ELSE NULL END AS gambar3");
                }])
                ->where(function ($query) use ($today) {
                    $query->where('recom_start_date', '<=', $today)
                        ->where('recom_end_date', '>=', $today);
                })
                ->where('status', 'active')
                ->get()
                ->take(4);
            $transformedOffering = $Offering->pluck('produk')->flatten()->all();


            // $totalPoints = Claim_uniquecode::where('id_member', $memberId)->sum('point');
            // $response1 =  DB::select('select sum(point) as point from onepoint_log_claim_uniquecode as m where id_member = "' . $memberId . '"');
            //bantu saya rubah kode ini dengan eloquent laravel
            // $findpointused = DB::select('select sum(v.pointneed) as pointused from onepoint_log_claim_voucher as c
            // inner join onepoint_voucher as v on v.kode_voucher = c.kode_voucher
            // where c.id_member = "' . $memberId . '"');
            // $point = $response;
            // $pointused = $findpointused[0]->pointused;
            // dd($pointused);

            $point = Claim_uniquecode::where('id_member', $memberId)->sum('point');
            $pointUseds = Claim_voucher::where('id_member', $memberId)
                ->join('onepoint_voucher', 'onepoint_log_claim_voucher.id_onepoint_voucher', '=', 'onepoint_voucher.id')
                ->sum('onepoint_voucher.pointneed');




            $totalPoint = $point - $pointUseds;

            return view('page-sdamember.beranda', compact(
                'totalPoint',
                'transformedRecomended',
                'transformedOffering',
                'voucherCount',
            ));
        } else if ($user->hasRole('Admin')) {
            return redirect('dashboard');
        } else if ($user->hasRole('Manager')) {
            return redirect('add_member');
        }



        return abort(404);
    }

    public function root()
    {
        return view('index');
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function FormSubmit(Request $request)
    {
        return view('form-repeater');
    }

    public function loadslider()
    {
        return 'Load Slider';
    }
}
