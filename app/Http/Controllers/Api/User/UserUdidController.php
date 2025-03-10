<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserUdid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use \Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserUdidController extends Controller
{
    public function postUDID(Request $request)
    {

        $request->validate([
            'udid' => 'required|string',
        ]);

        $existingUdid = UserUdid::where('udid', $request->udid)->first();

        if ($existingUdid) {
            $user = $existingUdid->user;
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'message' => 'UDID already registered',
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ], 200);
        } else {
            // Buat user baru tanpa email
            $user = User::create([
                'name' => 'Guest_' . Str::random(5),
                'email' => 'guest_' . Str::random(10) . '@example.com', // Placeholder email
                'password' => Hash::make(Str::random(16)), // Password acak
            ]);

            // Simpan UDID ke database
            UserUdid::create([
                'user_id' => $user->id,
                'udid' => $request->udid
            ]);
        }

        // Buat token autentikasi

        $token = JWTAuth::fromUser($user);



        return response()->json([
            'message' => 'UDID registered successfully',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email, // User bisa update email nanti
            ]
        ], 201);
    }
}
