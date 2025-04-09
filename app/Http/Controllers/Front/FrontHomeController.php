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

use GeoIP;

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


        $ip = $this->getIpAddress();
dump($ip);
        // if (!$this->isValidIpAddress($ip)) {
        //     abort(403, 'Invalid IP address');
        // }

        $geoLocationData = $this->getLocation($ip);

        // if (!$geoLocationData || !isset($geoLocationData['country'])) {
        //     abort(500, 'Failed to retrieve geolocation data');
        // }

        $country = $geoLocationData['country'];
dump($country);
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


        $location = geoip()->getLocation(); // hasilnya biasanya seperti ['country' => 'Indonesia']
        $detectedCountry = $location->country ?? '';

        // Cek apakah termasuk dalam kelompok
        $defaultCountry = 'Australia'; // default fallback
        foreach ($countryGroups as $group => $countries) {
            if (in_array($detectedCountry, $countries)) {
                $defaultCountry = $group;
                break;
            }
        }

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
            ->limit(6)->get();
        $topnews = News::where('status', 'published')->orderBy('id', 'desc')->limit(9)->get();
        $news = News::where('status', 'published')->orderBy('id', 'desc')->limit(6)->get();


        $newsbycountry = News::with(['category', 'countriesCategoriesNews.country', 'countriesCategoriesNews.category'])
            ->whereHas('countriesCategoriesNews.country', function ($q) use ($defaultCountry) {
                $q->where('country_name', $defaultCountry);
            })
            ->orderBy('id', 'desc')
            ->where('status', 'published')
            ->get();

        // Kelompokkan berita berdasarkan kategori
        $groupedByCategory = $newsbycountry->groupBy(function ($item) {
            return optional($item->countriesCategoriesNews->first()?->category)->name ?? 'Uncategorized';
        });

        return view('front.home', compact("breaking_news", "topnews", "news", "today_news", "not_today_news", "groupedByCategory"));

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
