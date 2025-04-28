<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContributorSignup;
use Illuminate\Http\Request;

class ContributorSignupController extends Controller
{
    public function store(Request $request)
    {

        //dd("test");
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|email',
        ]);

        // Honeypot anti-spam
        if ($request->filled('website')) {
            return response()->json([
                'success' => false,
                'message' => 'Spam detected.'
            ]);
        }

        // Cek apakah email sudah pernah submit
        $existing = ContributorSignup::where('email', $request->email)->first();

        if ($existing) {
            return response()->json([
                'success' => true,
                'message' => 'Email already exists.'
            ]);
        }

        // Simpan data baru
        ContributorSignup::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Signup successful!'
        ]);
    }
}
