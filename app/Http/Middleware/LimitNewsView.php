<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LimitNewsView
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            // Jika user sudah login, cek apakah sudah berlangganan
            if ($user->subscribes()->where('status', 'active')->exists()) {
                return $next($request); // Jika berlangganan, lanjutkan akses
            }

            // Jika belum berlangganan, cek jumlah tampilan
            if ($user->view_count >= 3) {
                return redirect()->route('subscribe')->with('error', 'Anda sudah mencapai batas tampilan gratis. Silakan berlangganan.');
            }

            // Tambah view count pengguna
            $user->increment('view_count');
        } else {
            // Jika user adalah guest (belum login)
            $guestViewCount = session()->get('guest_view_count', 0);

            if ($guestViewCount >= 5) {
                return redirect()->route('subscribe')->with('error', 'Anda sudah mencapai batas tampilan gratis sebagai guest. Silakan login atau berlangganan.');
            }

            // Tambah view count untuk guest di session
            session()->put('guest_view_count', $guestViewCount + 1);
        }

        return $next($request);
    }
}
