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

    public function shownewsbycategory($category)
    {
       // Mengambil parameter dari request
       $countryName = "indonesia";
       $categoryName = $category;

       // Mengambil berita dengan relasi kategori
       $query = News::with('category');

       // Jika country_name diberikan, filter berdasarkan country
       if ($countryName) {
           $query->whereHas('countriesCategoriesNews', function ($q) use ($countryName) {
               $q->whereHas('country', function ($q) use ($countryName) {
                   $q->where('country_name', $countryName);
               });
           });
       }

       if ($categoryName) {
           $query->whereHas('countriesCategoriesNews', function ($q) use ($categoryName) {
               $q->whereHas('category', function ($q) use ($categoryName) {
                   $q->where('name', $categoryName);
               });
           });
       }

       // Order by DESC berdasarkan created_at (atau updated_at jika lebih sesuai)
       $news = $query->orderBy('created_at', 'desc')
           ->get();
        // dd($news);
        return view('front.news-by-category', compact("news","categoryName"));
    }


}
