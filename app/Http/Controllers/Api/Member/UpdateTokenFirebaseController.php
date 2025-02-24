<?php

namespace App\Http\Controllers\Api\Member;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateTokenFirebaseController extends Controller
{
    public function index(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();


        $userToken = User::find($user->id);
        $newToken = $request->token_firebase;
        // dd($userToken);
        if ($userToken) {


            $userToken->update(['token_firebase' => $newToken]);


            return response()->json(['success' => true, 'message' => 'Token Firebase berhasil diperbarui'], 200);
        } else {

            return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 200);
        }
    }
}
