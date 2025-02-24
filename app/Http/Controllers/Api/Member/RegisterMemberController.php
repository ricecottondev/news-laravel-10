<?php

namespace App\Http\Controllers\Api\Member;


use App\Models\User;
use App\Models\Member;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use \Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterMemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                // 'username' => 'required|string|unique:onepoint_member',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ]);
            $validator->setCustomMessages([
                'email.unique' => 'Alamat email sudah terdaftar. Silakan gunakan email lain.',
            ]);
            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 200);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->assignRole('member');
            $member = Member::firstOrCreate(
                ['email' => $request->email],
                ['password' => bcrypt($request->password)]
            );

            $credentials = $request->only('email', 'password');


            $token = Str::random(64);

            UserVerify::create([
                'user_id' => $user->id,
                'token' => $token
            ]);

            Mail::send('front.email.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Email Verification');
            });



            // if (!$token = JWTAuth::attempt($credentials)) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Login  invalid.',
            //     ], 200);
            // }

            return response()->json([
                'success' => true,
                'message' => 'Kami sudah mengirim email verifikasi, silahkan verifikasi email anda',
                // 'token' => $token,
                // 'name' => $user->name,
                // 'email' => $user->email,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
