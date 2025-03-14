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


class UserController extends Controller
{
    public function getProfile(Request $request)
    {
        // Mengambil parameter country_name dari request
        $user = User::find($request->id);
        // Mengembalikan response JSON dengan format yang diinginkan
        return response()->json($user);
    }

    public function postEditProfile(Request $request)
    {
        // Ambil user yang sedang login

        // $validator = Validator::make($request->only('token'), [
        //     'token' => 'required'
        // ]);

        $user = JWTAuth::parseToken()->authenticate();
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
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
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
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->uuid = $request->uuid;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'UUID updated successfully',
            'uuid' => $user->uuid,
        ], 200);
    }

    // API untuk memperbarui Token Firebase pengguna
    public function postFirebase(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $validator = Validator::make($request->all(), [
            'token_firebase' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->token_firebase = $request->token_firebase;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Firebase Token updated successfully',
            'token_firebase' => $user->token_firebase,
        ], 200);
    }




    public function postUserSelectionCategory(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category' => 'required|array',
            'category.*' => 'string|exists:categories,name',
        ]);

        // Jika validasi gagal, kembalikan response JSON dengan error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        // Mendapatkan user dari token
        // $user = Auth::user();
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Ambil ID kategori berdasarkan nama
        $categoryIds = Category::whereIn('name', $request->category)->pluck('id');

        // Simpan kategori yang dipilih user
        $user->selectedCategories()->sync($categoryIds);

        return response()->json([
            'message' => 'Categories selected successfully',
            'selected_categories' => $user->selectedCategories()->pluck('name'),
        ], 201);
    }
}
