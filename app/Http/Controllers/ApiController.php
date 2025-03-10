<?php

namespace App\Http\Controllers;

use \Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class ApiController extends Controller
{
    // public function register(Request $request)
    // {
    //     //Validate data
    //     $data = $request->only('name', 'email', 'password');
    //     $validator = Validator::make($data, [
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|string|min:6|max:50'
    //     ]);

    //     //Send failed response if request is not valid
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->messages()], 200);
    //     }

    //     //Request is valid, create new user
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password)
    //     ]);

    //     //User created, return success response
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'User created successfully',
    //         'data' => $user
    //     ], Response::HTTP_OK);
    // }

    public function register(Request $request)
    {
        // Pastikan user sudah login (memiliki token)
        try {
            // Coba ambil user berdasarkan token JWT
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token has expired, please login again'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token, please provide a valid token'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token not provided or is incorrect'
            ], Response::HTTP_UNAUTHORIZED);
        }

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token or user not authenticated'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Validasi data input
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|string|min:6|max:50'
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        // Update user Guest menjadi user dengan email dan password yang valid
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([ 'success' => false,'message' => $validator->messages()], 200);
        }


        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'email atau password salah.',
                ], 200);
            }
        } catch (JWTException $e) {
            return $credentials;
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
            ], 500);
        }

        // Check if user is verified
        $user = auth()->user();

        if (!$user->email_verified_at) {
            // User is not verified
            return response()->json([
                'success' => false,
                'message' => 'Silahkan verifikasi email anda terlebih dahulu.',
            ], 200);
        }

        // Token created, return with success response and JWT token
        return response()->json([
            'success' => true,
            'token' => $token,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function logout(Request $request)
    {
        //Request is validated, do logout
        try {
            $validator = Validator::make($request->only('token'), [
                'token' => 'required'
            ]);

            $user = JWTAuth::parseToken()->authenticate();
            if ($user) {

                $user->update(['token_firebase' => null]);
            }

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }



            $token = new \Tymon\JWTAuth\Token($request->token);
            \Tymon\JWTAuth\Facades\JWTAuth::manager()->invalidate($token, $forever = true);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], 200);
        }
    }

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }
}
