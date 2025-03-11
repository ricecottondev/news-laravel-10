<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Member as MemberModel;
use Illuminate\Support\Facades\Session;
use App\Models\News;

class FrontNewsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        return view('front.news');
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->first();
        return view('front.news-detail', compact("news"));
    }


}
