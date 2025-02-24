<?php

namespace App\Http\Controllers\Back\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Field;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {

        dd("inidashboard super admin");
        // Periksa apakah pengguna sudah login
        if (Auth::check()) {
            // Periksa peran pengguna
            $user = Auth::user();

            //dd($user);
            $role = $user->role->role; // Mendapatkan nama


            $userCount = User::count();



            // dump('dashboard');\
            if ($role === 'superuser') {
                return view('admin.layouts.index', compact('orders'));
            }

            if ($role === 'fat') {
                return view('back/dashboard', compact('user','userCount', 'brandCount', 'categoryCount', 'fieldCount', 'productCount', 'orderCount', 'orders'));
            }

            // Jika peran adalah 'user', arahkan ke halaman login
            if ($role === 'customer') {
                // return redirect()->route('login');
                // return view('backend.dashboard.user');
                return redirect()->intended('/dashboard-customer');
            }

            // Jika peran adalah 'user', arahkan ke halaman login
            if ($role === 'staff') {
                // return redirect()->route('login');
                return view('back/dashboard', compact('user','userCount', 'brandCount', 'categoryCount', 'fieldCount', 'productCount', 'orderCount', 'orders'));
            }

            // return view('back.order.index', compact('orders'));

            // Jika peran adalah 'super admin', 'admin', atau 'staff', tampilkan halaman dashboard
            // return view('backend.dashboard.superadmin',compact('userCount','coursesCount', 'courseCategoriesCount', 'courseRoadmapsCount', 'courseTechnologiesCount', 'OrderCount'));
            return view('back/dashboard', compact('user','userCount'));
        }

        // Jika pengguna belum login, arahkan ke halaman login
        return redirect()->route('login');


        // return view('back/dashboard');
    }
}
