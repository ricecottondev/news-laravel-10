<?php

namespace App\Http\Controllers\Front\Account;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function signin()
    {
        $authuser = Auth::user();
        if ($authuser !== null) {
            if ($authuser->role_id == 4) {
                return redirect()->intended('/dashboard-customer');
            }
        }
        $title = 'SignIn';
        return view('front.account.signin', compact('title'));
    }


    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $userIp = $request->ip(); // IP address sebagai user sementara sebelum login
            $userId = Auth::id();     // ID pengguna setelah login

            // Ambil semua item di cart dengan user_id menggunakan IP address
            $cartItems = Cart::where('user_id', $userIp)
                ->where('deleted', "false")
                ->get();

            foreach ($cartItems as $item) {
                // Periksa apakah ada item dengan product_id dan user_id yang sama
                $existingCartItem = Cart::where('user_id', $userId)
                    ->where('sub_product_id', $item->sub_product_id)
                    ->where('deleted', "false")
                    ->first();

                if ($existingCartItem) {
                    // Jika item dengan product_id yang sama ada, tambahkan qty
                    $existingCartItem->increment('qty', $item->qty);
                    $item->delete(); // Hapus item yang terdaftar dengan user IP
                } else {
                    // Jika tidak ada, ubah user_id menjadi ID pengguna
                    $item->update(['user_id' => $userId]);
                }
            }

            // Redirect berdasarkan role
            if (Auth::user()->role_id == 4) {
                return redirect()->intended('/dashboard-customer');
            } else {
                return back()->withErrors([
                    'role' => 'Role Anda Bukan Customer',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
