<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountDeletionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountDeletionController extends Controller {
    public function requestDeletion(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'reason' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        dump($user);
        dump($user->email);
        dump($request->password);
        dump($user->password);

        if (!$user || $user->email !== $request->email || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid credentials.');
        }

        AccountDeletionRequest::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Your account deletion request has been submitted.');
    }
}
