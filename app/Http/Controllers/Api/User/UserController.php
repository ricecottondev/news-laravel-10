<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Category;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Subscribe;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function getProfile(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            // Ambil subscription aktif
            $subscription = Subscribe::where('user_id', $user->id)
                ->where('status', 'active')
                ->where('end_date', '>=', now())
                ->orderBy('end_date', 'desc')
                ->first();

            return response()->json([
                'user' => $user,
                'subscription_status' => $subscription ? 'true' : 'false',
                'plan' => $subscription ? $subscription->plan : null,
                'start_date' => $subscription ? $subscription->start_date : null,
                'end_date' => $subscription ? $subscription->end_date : null,
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token not provided or is incorrect'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function postEditProfile(Request $request)
    {
        // Ambil user yang sedang login

        // $validator = Validator::make($request->only('token'), [
        //     'token' => 'required'
        // ]);

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token has expired, please login again'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token, please provide a valid token'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token not provided or is incorrect'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // $user = JWTAuth::parseToken()->authenticate();
        // if ($user) {
        //     $user->update(['token_firebase' => null]);
        // }

        //Send failed response if request is not valid
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->messages()], 200);
        // }


        // $user = Auth::user();
        // $validator = Validator::make($request->only('token'), [
        //     'token' => 'required'
        // ]);

        // $user = JWTAuth::parseToken()->authenticate();


        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'google_id' => 'nullable|string|unique:users,google_id,' . $user->id,
            'apple_id' => 'nullable|string|unique:users,apple_id,' . $user->id,
            'token_firebase' => 'nullable|string',
            'uuid' => 'nullable|string|unique:users,uuid,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => true,
                'success' => false,
                'message' => "validation error, The email has already been taken.",
            ], 200);
        }

        // Update user data
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        if ($request->has('google_id')) {
            $user->google_id = $request->google_id;
        }
        if ($request->has('apple_id')) {
            $user->apple_id = $request->apple_id;
        }
        if ($request->has('token_firebase')) {
            $user->token_firebase = $request->token_firebase;
        }
        if ($request->has('uuid')) {
            $user->uuid = $request->uuid;
        }

        $user->save();

        return response()->json([
            'status' => true,
            'success' => true,
            'message' => 'Profile updated successfully',
            'user' => $user,
        ], 200);
    }

    public function postUUID(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $validator = Validator::make($request->all(), [
            'uuid' => 'required||unique:users,uuid,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => true,
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 200);
        }

        $user->uuid = $request->uuid;
        $user->save();

        return response()->json([
            'status' => true,
            'success' => true,
            'message' => 'UUID updated successfully',
            'uuid' => $user->uuid,
        ], 200);
    }

    // API untuk memperbarui Token Firebase pengguna
    public function postFirebase(Request $request)
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token has expired, please login again'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token, please provide a valid token'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token not provided or is incorrect'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $validator = Validator::make($request->all(), [
            'token_firebase' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => true,
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 200);
        }

        $user->token_firebase = $request->token_firebase;
        $user->save();

        return response()->json([
            'status' => true,
            'success' => true,
            'message' => 'Firebase Token updated successfully',
            'token_firebase' => $user->token_firebase,
        ], 200);
    }




    public function postUserSelectionCategory(Request $request)
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token has expired, please login again'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token, please provide a valid token'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token not provided or is incorrect'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $validator = Validator::make($request->all(), [
            'category' => 'required|array',
            'category.*' => 'string|exists:categories,name',
        ]);

        // Jika validasi gagal, kembalikan response JSON dengan error
        if ($validator->fails()) {
            return response()->json([
                'status' => true,
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 200);
        }
        // Mendapatkan user dari token
        // $user = Auth::user();
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 200);
        }

        // Ambil ID kategori berdasarkan nama
        $categoryIds = Category::whereIn('name', $request->category)->pluck('id');

        // Simpan kategori yang dipilih user
        $user->selectedCategories()->sync($categoryIds);

        return response()->json([
            'status' => true,
            'success' => true,
            'message' => 'Categories selected successfully',
            'selected_categories' => $user->selectedCategories()->pluck('name'),
        ], 200);
    }

    public function resetlimit(Request $request)
    {

        $userid = $request->user_id;

        // if (!$user) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        $viewCountKey = "user_{$userid}_view_count";

        Cache::forget($viewCountKey); // Reset limit

        return response()->json([
            'message' => 'User limit has been reset successfully!',
            'status' => true
        ]);
    }
}
