<?php

namespace App\Http\Controllers\Front\Landing;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Field;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubProduct;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function landing()
    {
        $title = 'Home';



        $today = date('Y-m-d');
        $banner = Banner::where('status', 'active')
            ->where('start', '<=', $today)
            ->where('end', '>=', $today)
            ->get();

        return view('front.landing', compact('title', 'banner'));
    }
}
