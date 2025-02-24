<?php

namespace App\Http\Controllers\Front\Member;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::findOrFail(auth()->user()->id);

        $usersValidator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed', // Ensure there's a 'password_confirmation' field
        ]);

        if ($usersValidator->fails()) {
            return back()->withErrors($usersValidator)->withInput();
        } else {
            // Update the password for $users (if it exists)
            if ($users) {
                $users->update(['password' => Hash::make($request->password)]);
                return redirect()->back()->with('success', 'Password berhasil diubah.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
