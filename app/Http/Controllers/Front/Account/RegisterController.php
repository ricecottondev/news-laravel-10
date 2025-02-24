<?php

namespace App\Http\Controllers\Front\Account;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register() {
        $title = 'Register';
        return view('front.account.register', compact('title'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // dd( $request->has('subscribe'));
        // Simpan data pengguna ke database
        $user = new User();
        $user->name = $request->name;
        $user->nama_belakang = $request->nama_belakang;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role_id = 4;
        $user->password = Hash::make($request->password);
        $user->subscribe = $request->has('subscribe');
        $user->save();

        // Redirect atau lakukan sesuatu setelah berhasil register
        return redirect()->back()->with('success', 'Pendaftaran berhasil.');
}

}