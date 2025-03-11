<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Member as MemberModel;
use Illuminate\Support\Facades\Session;
use App\Models\Country;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Carbon;

class FrontHomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $breaking_news = News::where('status', 'published')
            ->where("is_breaking_news", 1)
            ->orderBy('id', 'desc')->limit(3)->get();

        $today_news = News::where('status', 'published')
            ->whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->limit(6)->get();

        $not_today_news = News::where('status', 'published')
            ->whereDate('created_at', '<', Carbon::today())
            ->orderBy('id', 'desc')
            ->limit(6)->get();
        $topnews = News::where('status', 'published')->orderBy('id', 'desc')->limit(5)->get();
        $news = News::where('status', 'published')->orderBy('id', 'desc')->limit(6)->get();
        return view('front.home', compact("breaking_news", "topnews", "news","today_news","not_today_news"));

        dd("ini home");
        #Get Data Auth user
        $user = Auth::user();

        #tampung semua data user pada variable
        if ($user->hasRole('Member')) {




            $today = now();
            $fullUrl = url('/');


            return view(
                'page-sdamember.beranda'

            );
        } else if ($user->hasRole('Admin')) {
            return redirect('dashboard');
        } else if ($user->hasRole('Manager')) {
            return redirect('add_member');
        }



        return abort(404);
    }

    public function login()
    {
        return view('auth.landing');
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
