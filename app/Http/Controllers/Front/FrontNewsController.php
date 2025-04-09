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
    public function __construct() {}

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


        $news = News::where('slug', $slug)->firstOrFail();
        // Ambil kata-kata dari judul (tanpa stopword atau kata umum)
        $keywords = explode(' ', $news->title);

        // Ambil berita terkait berdasarkan kesamaan kata di judul
        $suggestedNews = News::where('id', '!=', $news->id) // Hindari berita yang sedang dibaca
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $word) {
                    $query->orWhere('title', 'LIKE', "%{$word}%");
                }
            })
            ->limit(5) // Ambil maksimal 5 berita
            ->get();

        // Cek apakah user login
        // $this->cek_subs();
        // if (auth()->check()) {
        //     $user = auth()->user();

        //     // Ambil semua subscribe user yang masih aktif
        //     $today = now()->toDateString();
        //     $isSubscribed = $user->subscribes()
        //         ->where('status', 'active')
        //         ->whereDate('start_date', '<=', $today)
        //         ->whereDate('end_date', '>=', $today)
        //         ->exists(); // Cek apakah ada setidaknya satu subscribe yang masih berlaku

        //     if (!$isSubscribed) {
        //         // Batas 5 berita untuk user yang belum subscribe
        //         $viewCountKey = "user_{$user->id}_view_count";
        //         $viewCount = session()->get($viewCountKey, 0);

        //         if ($viewCount >= 5) {
        //             return redirect()->route('subscribe')
        //                 ->with('error', 'Anda telah mencapai batas membaca berita hari ini. Silakan berlangganan untuk akses tak terbatas.');
        //         }

        //         // Tambahkan jumlah berita yang dibaca
        //         session()->put($viewCountKey, $viewCount + 1);
        //     }
        // } else {
            // Jika user belum login, batasi hanya 3 berita per hari
            $viewCountKey = "guest_view_count";
            $viewCount = session()->get($viewCountKey, 0);

            // if ($viewCount >= 3) {
                // return redirect()->route('login')
                //     ->with('error', 'Anda telah mencapai batas membaca berita hari ini. Silakan login untuk membaca lebih banyak.');
            // }

            // Tambahkan jumlah berita yang dibaca
            session()->put($viewCountKey, $viewCount + 1);
        // }

        // Tambahkan view count ke berita
        $news->increment('views');

        return view('front.news-detail', compact("news", 'suggestedNews'));
    }

    public function cek_subs()
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Ambil semua subscribe user yang masih aktif
            $today = now()->toDateString();
            $isSubscribed = $user->subscribes()
                ->where('status', 'active')
                ->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today)
                ->exists(); // Cek apakah ada setidaknya satu subscribe yang masih berlaku

            if (!$isSubscribed) {
                // Batas 5 berita untuk user yang belum subscribe
                $viewCountKey = "user_{$user->id}_view_count";
                $viewCount = session()->get($viewCountKey, 0);

                if ($viewCount >= 5) {
                    return redirect()->route('subscribe')
                        ->with('error', 'Anda telah mencapai batas membaca berita hari ini. Silakan berlangganan untuk akses tak terbatas.');
                }

                // Tambahkan jumlah berita yang dibaca
                session()->put($viewCountKey, $viewCount + 1);
            }
        } else {
            // Jika user belum login, batasi hanya 3 berita per hari
            $viewCountKey = "guest_view_count";
            $viewCount = session()->get($viewCountKey, 0);

            if ($viewCount >= 3) {
                return redirect()->route('login')
                    ->with('error', 'Anda telah mencapai batas membaca berita hari ini. Silakan login untuk membaca lebih banyak.');
            }

            // Tambahkan jumlah berita yang dibaca
            session()->put($viewCountKey, $viewCount + 1);
        }
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
        return view('front.news-by-category', compact("news", "categoryName"));
    }

    public function shownewsbycategoryandCountry($country,$category)
    {
        // Mengambil parameter dari request
        $countryName = $country;
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
        return view('front.news-by-category', compact("news", "categoryName"));
    }

    public function shownewsbyCountry($country)
    {
        // Mengambil parameter dari request
        $countryName = $country;


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



        // Order by DESC berdasarkan created_at (atau updated_at jika lebih sesuai)
        $news = $query->orderBy('created_at', 'desc')
            ->get();
        // dd($news);
        return view('front.news-by-country', compact("news"));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        // Cari berita berdasarkan judul atau konten
        $news = News::where('title', 'LIKE', "%$query%")
            ->orWhere('content', 'LIKE', "%$query%")
            ->paginate(10);

        return view('front.news-search', compact('news', 'query'));
    }
}
