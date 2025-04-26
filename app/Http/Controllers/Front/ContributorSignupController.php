<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContributorSignup;
use Illuminate\Http\Request;

class ContributorSignupController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:contributor_signups,email',
        ]);

        ContributorSignup::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'Signup successful!']);
    }
}
