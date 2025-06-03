<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;
use App\Models\Member as MemberModel;
use Illuminate\Support\Facades\Session;
use App\Models\Country;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Carbon;

use GeoIP;

class FrontHomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $pathImage;

    public function __construct()
    {
        // $this->middleware('auth');
        $this->pathImage = 'assets/banner/';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        // dump("home");
        if ($request->get('is_bot')) {
            return response()->view('bot-detected'); // Bisa redirect atau tampilkan halaman khusus
        }

        $pathimg = $this->pathImage;
        $ip = $this->getIpAddress();
        // dump($ip);
        // if (!$this->isValidIpAddress($ip)) {
        //     abort(403, 'Invalid IP address');
        // }
        $geoLocationData = $this->getLocation($ip);
        // if (!$geoLocationData || !isset($geoLocationData['country'])) {
        //     abort(500, 'Failed to retrieve geolocation data');
        // }
        $country = $geoLocationData['country'];
        // dump($country);
        // switch ($country) {
        //     case 'Indonesia':
        //         header('Location: https://www.beta.sda.co.id');
        //         exit;
        //     case 'Singapore':
        //         header('Location: https://www.sda.co.id');
        //         exit;
        //     default:
        //         header('Location: https://www.sda.co.id');
        //         exit;
        // }


        $countryGroups = [
            'Asia' => [
                'Indonesia',
                'Brunei Darussalam',
                'Kamboja',
                'Filipina',
                'Singapura',
                'Thailand',
                'Timor Leste',
                'Laos',
                'Vietnam',
                'Malaysia',
                'Myanmar'
            ],
            'USA' => ['USA'],
            'China' => ['China'],
            'Australia' => ['Australia'],
            'Europe' => [
                'Albania',
                'Andorra',
                'Armenia',
                'Azerbaijan',
                'Austria',
                'Belanda',
                'Belarus',
                'Belgia',
                'Bosnia',
                'Herzegovina',
                'Bulgaria',
                'Kroasia',
                'Siprus',
                'Ceko',
                'Denmark',
                'Estonia',
                'Finlandia',
                'Prancis',
                'Georgia',
                'Jerman',
                'Yunani',
                'Hungaria',
                'Islandia',
                'Irlandia',
                'Italia',
                'Kazakhstan',
                'Latvia',
                'Liechtenstein',
                'Lituania',
                'Luksemburg',
                'Makedonia Utara',
                'Malta',
                'Moldova',
                'Monako',
                'Montenegro',
                'Norwegia',
                'Polandia',
                'Portugal',
                'Rumania',
                'Rusia',
                'San Marino',
                'Serbia',
                'Slowakia',
                'Slovenia',
                'Spanyol',
                'Swedia',
                'Swiss',
                'Turki',
                'Ukraina',
                'UK',
                'Vatikan'
            ]
        ];


        // $location = geoip()->getLocation(); // hasilnya biasanya seperti ['country' => 'Indonesia']
        // $detectedCountry = $location->country ?? '';

        $detectedCountry = $country; // Ganti dengan cara Anda mendeteksi negara
        $detectedCountry = 'Australia';
        // Cek apakah termasuk dalam kelompok
        $defaultCountry = 'Australia'; // default fallback
        foreach ($countryGroups as $group => $countries) {
            if (in_array($detectedCountry, $countries)) {
                $defaultCountry = $group;
                break;
            }
        }

        $defaultCountry = $this->getDefaultcountry();

        // dd( $defaultCountry);

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
            ->limit(8)->get();
        // $topnews = News::with(['category', 'countriesCategoriesNews'])
        //     ->where('status', 'published')
        //     ->whereDate('created_at', Carbon::today())
        //     ->orderBy('created_at', 'desc') // urutkan berdasarkan tanggal terbaru
        //     ->orderBy('id', 'asc')          // dalam tanggal yang sama, urut berdasarkan ID kecil ke besar
        //     ->get();

        $topnews = News::with(['category', 'countriesCategoriesNews'])
            ->where('status', 'published')

            ->whereHas('countriesCategoriesNews.country', function ($query) {
                $query->where('country_name', 'Australia');
            })
            ->orderByRaw('CASE WHEN `order` > 0 THEN 0 ELSE 1 END') // Prioritaskan order > 0
            ->orderBy('order', 'asc') // Prioritaskan dari 1 - 5
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')
            ->limit(60)
            ->get();

        $justinnews = News::with(['category', 'countriesCategoriesNews'])
            ->where('status', 'published')

            ->whereHas('countriesCategoriesNews.country', function ($query) {
                $query->where('country_name', 'Australia');
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')
            ->limit(10)
            ->get();

        $editorpicknews = News::with(['category', 'countriesCategoriesNews'])
            ->where('status', 'published')
            ->where('editor_choice', true) // Filter untuk berita pilihan editor
            ->whereHas('countriesCategoriesNews.country', function ($query) {
                $query->where('country_name', 'Australia');
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')
            ->limit(15)
            ->get();
        // dump($justinnews->toArray());
        // dd($editorpicknews->toArray());

        // dd($topnews->toArray());

        $news = News::where('status', 'published')->orderBy('id', 'desc')->limit(6)->get();


        $newsbycountry = News::with(['category', 'countriesCategoriesNews.country', 'countriesCategoriesNews.category'])
            ->whereHas('countriesCategoriesNews.country', function ($q) use ($defaultCountry) {
                $q->where('country_name', $defaultCountry);
            })
            ->orderBy('id', 'desc')
            ->where('status', 'published')
            ->get();



        // Kelompokkan berita berdasarkan kategori dengan breaking news
        // $groupedByCategory = $newsbycountry->groupBy(function ($item) {
        //     return optional($item->countriesCategoriesNews->first()?->category)->name ?? 'Uncategorized';
        // });
        // Kelompokkan berita berdasarkan kategori tanpa breaking news

        // $groupedByCategory = $newsbycountry
        //     ->filter(function ($item) {
        //         $categoryId = $item->countriesCategoriesNews->first()?->category_id;
        //         return $categoryId != 8;
        //     })
        //     ->groupBy(function ($item) {
        //         return optional($item->countriesCategoriesNews->first()?->category)->name ?? 'Uncategorized';
        //     });

        $preferredOrder = [
            'Breaking News',
            'Politics',
            'World',
            'Business',
            'Finance',
            'Sports',
            'Health',
            'Opinions',
            'Technology',
            'Travel & Lifestyle',
            'Entertainment'
        ];

        $mappedNews = collect();

        // Pisahkan kategori "Finance & Finance" menjadi 1 "Finance"
        $normalizedNews = $newsbycountry->map(function ($item) {
            $categoryName = $item->countriesCategoriesNews->first()?->category?->name ?? 'Uncategorized';
            if (strtolower($categoryName) === 'finance & finance') {
                $item->countriesCategoriesNews->first()->category->name = 'Finance';
            }
            return $item;
        });

        // Kelompokkan berdasarkan kategori
        $grouped = $normalizedNews->groupBy(function ($item) {
            return optional($item->countriesCategoriesNews->first()?->category)->name ?? 'Uncategorized';
        });

        // Buat array untuk kategori yang sudah sesuai urutan
        foreach ($preferredOrder as $categoryName) {
            if ($grouped->has($categoryName)) {
                $mappedNews->put($categoryName, $grouped->get($categoryName));
            }
        }

        // Tambahkan kategori lain ke MISC
        $miscItems = collect();
        foreach ($grouped as $key => $value) {
            if (!in_array($key, $preferredOrder)) {
                $miscItems = $miscItems->merge($value);
            }
        }
        if ($miscItems->isNotEmpty()) {
            $mappedNews->put('MISC', $miscItems);
        }

        $groupedByCategory = $mappedNews;

        Session::forget('default_country');

        Session::put('default_country', $defaultCountry);

        $banner_status = env('BANNER_STATUS', true);
        $now = date('Y-m-d');
        $banner = Banner::where('start', '<=', $now)
            ->where('end', '>=', $now)
            ->where('status', 'active')
            ->where(function ($query) {
                $query->where('deleted', false)
                    ->orWhere('deleted', 0);
            })
            ->get();



        return view('front.home', compact("breaking_news", "topnews", "justinnews", "editorpicknews", "news", "today_news", "not_today_news", "groupedByCategory", "defaultCountry", "banner", "pathimg", "banner_status"));

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

    public function getDefaultcountry()
    {
        $ip = $this->getIpAddress();
        // dump($ip);
        // if (!$this->isValidIpAddress($ip)) {
        //     abort(403, 'Invalid IP address');
        // }
        $geoLocationData = $this->getLocation($ip);
        // if (!$geoLocationData || !isset($geoLocationData['country'])) {
        //     abort(500, 'Failed to retrieve geolocation data');
        // }
        $country = $geoLocationData['country'];
        // dump($country);
        // switch ($country) {
        //     case 'Indonesia':
        //         header('Location: https://www.beta.sda.co.id');
        //         exit;
        //     case 'Singapore':
        //         header('Location: https://www.sda.co.id');
        //         exit;
        //     default:
        //         header('Location: https://www.sda.co.id');
        //         exit;
        // }


        $countryGroups = [
            'Asia' => [
                'Indonesia',
                'Brunei Darussalam',
                'Kamboja',
                'Filipina',
                'Singapura',
                'Thailand',
                'Timor Leste',
                'Laos',
                'Vietnam',
                'Malaysia',
                'Myanmar',
            ],
            'USA' => ['USA'],
            'China' => ['China'],
            'Australia' => ['Australia'],
            'Europe' => [
                'Albania',
                'Andorra',
                'Armenia',
                'Azerbaijan',
                'Austria',
                'Belanda',
                'Belarus',
                'Belgia',
                'Bosnia',
                'Herzegovina',
                'Bulgaria',
                'Kroasia',
                'Siprus',
                'Ceko',
                'Denmark',
                'Estonia',
                'Finlandia',
                'Prancis',
                'Georgia',
                'Jerman',
                'Yunani',
                'Hungaria',
                'Islandia',
                'Irlandia',
                'Italia',
                'Kazakhstan',
                'Latvia',
                'Liechtenstein',
                'Lituania',
                'Luksemburg',
                'Makedonia Utara',
                'Malta',
                'Moldova',
                'Monako',
                'Montenegro',
                'Norwegia',
                'Polandia',
                'Portugal',
                'Rumania',
                'Rusia',
                'San Marino',
                'Serbia',
                'Slowakia',
                'Slovenia',
                'Spanyol',
                'Swedia',
                'Swiss',
                'Turki',
                'Ukraina',
                'UK',
                'Vatikan'
            ]
        ];


        // $location = geoip()->getLocation(); // hasilnya biasanya seperti ['country' => 'Indonesia']
        // $detectedCountry = $location->country ?? '';

        $detectedCountry = $country; // Ganti dengan cara Anda mendeteksi negara
        $detectedCountry = 'Australia';
        // Cek apakah termasuk dalam kelompok
        $defaultCountry = 'Australia'; // default fallback
        foreach ($countryGroups as $group => $countries) {
            if (in_array($detectedCountry, $countries)) {
                $defaultCountry = $group;
                break;
            }
        }

        return $defaultCountry;
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

    public function subscribes()
    {
        return view('front.subscribes');
    }


    // ===============================================================================================

    public function getIpAddress()
    {
        $ipAddress = '';
        if (! empty($_SERVER['HTTP_CLIENT_IP']) && $this->isValidIpAddress($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($ipList as $ip) {
                if ($this->isValidIpAddress(trim($ip))) {
                    $ipAddress = trim($ip);
                    break;
                }
            }
        } elseif (! empty($_SERVER['HTTP_X_FORWARDED']) && $this->isValidIpAddress($_SERVER['HTTP_X_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && $this->isValidIpAddress($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        } elseif (! empty($_SERVER['HTTP_FORWARDED_FOR']) && $this->isValidIpAddress($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (! empty($_SERVER['HTTP_FORWARDED']) && $this->isValidIpAddress($_SERVER['HTTP_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (! empty($_SERVER['REMOTE_ADDR']) && $this->isValidIpAddress($_SERVER['REMOTE_ADDR'])) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }
        return $ipAddress;
    }

    public function isValidIpAddress($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false;
    }

    public function getLocation($ip)
    {
        $ch = curl_init('http://ipwhois.app/json/' . $ip);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);

        if ($json === false) {
            return null;
        }

        $response = json_decode($json, true);
        return $response ?? null;
    }
}
