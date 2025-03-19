<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role; // Import model Role

use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input pengguna
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role,
            'phone' => $request->phone,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nim' => $request->nim,
            'kampus' => $request->kampus,
        ]);

        return redirect()->route('landing')->with('success', 'User registered successfully.');
    }

    public function showLoginForm()
    {
        $auth = Auth::user();
        if ($auth !== null) {
            return redirect()->route('dashboard');
        }
        $title = 'SignIn';
        return view('auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        // Validasi input pengguna
        $credentials = $request->only('email', 'password');

        // Authentikasi pengguna
        if (Auth::attempt($credentials)) {

            if (Auth::user()->role->role == 'superadmin')
            {
                return redirect()->route('dashboard');
            }
            else if (Auth::user()->role->role == 'admin')
            {
                return redirect()->route('dashboard');
            }
            else if (Auth::user()->role->role == 'staff')
            {
                return redirect()->route('dashboard');
            }
            else if (Auth::user()->role->role == 'supervisor')
            {
                return redirect()->route('dashboard');
            }
            else if (Auth::user()->role->role == 'manager')
            {
                return redirect()->route('dashboard');
            }
            else if (Auth::user()->role->role == 'direktur')
            {
                return redirect()->route('dashboard');
            }
            // Jika berhasil, redirect ke halaman yang diinginkan
            return redirect()->route('dashboard');
        } else {
            // Jika gagal, redirect kembali dengan pesan error
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function loginas(Request $request)
    {

        $id = $request->id;
        // dd($id);
        Auth::logout();
        $user = User::find($id);

        if ($user) {
            Auth::login($user);
            return redirect()->route('back/dashboard');
        } else {
            return back()->withErrors([
                'id' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        // Redirect ke halaman login atau halaman lainnya
        return redirect()->route('home');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        // Validasi input pengguna
        $this->validate($request, ['email' => 'required|email']);

        // Kirim email reset password
        $status = Password::sendResetLink($request->only('email'));

        // Redireksi atau respons sesuai kebutuhan Anda
    }
}
