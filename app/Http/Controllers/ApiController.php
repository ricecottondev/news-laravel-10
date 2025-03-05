<?php

namespace App\Http\Controllers;

use \Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Member;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
dd("test");
        //Request is valid, create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
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

        // $GetMember =  Member::where('email', $request->email)->first();

        // if($GetMember->status == 'inactive'){
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Akun Sudah Non Aktif.',
        //     ], 200);

        // }

        //Request is validated
        //Crean token
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
