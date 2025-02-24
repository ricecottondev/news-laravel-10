<?php

namespace App\Http\Controllers\Api\Mobile\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function submitForgetPasswordForm(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->messages()
                ], 200);
            }

            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);


            Mail::send('front.email.forgetPassword', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            // Email dikirim berhasil
            return response()->json([
                'success' => true,
                'message' => 'Reset Password Success'
            ]);
        } catch (\Exception $e) {
            // Email gagal dikirim, berikan respons JSON dengan pesan kesalahan
            return response()->json(['success' => false, 'message' => 'Gagal mengirim email.'], 500);
        }
    }
}
