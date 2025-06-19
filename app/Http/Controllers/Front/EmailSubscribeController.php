<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailSubscribe;

class EmailSubscribeController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:email_subscribes,email',
        ]);

        EmailSubscribe::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }
}
