<?php

namespace App\Http\Controllers\Auth;

use URL;
use App\Models\User;
use App\Models\Member;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use App\Models\Member_model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'password_confirmation' => ['required', 'same:password'], // Validasi konfirmasi kata sandi
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('member');
        if (!Member::where('email', $data['email'])->exists()) {
            Member::create([
                'password' => Hash::make($data['password']),
                'email' => $data['email'],
                'emailwithoutdot' => $data['email']
            ]);
        }

        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        Mail::send('front.email.emailVerificationEmail', ['token' => $token], function ($message) use ($data) {
            $message->to($data['email']);
            $message->subject('Email Verification');
        });

        Session::flash('success', 'Registrasi berhasil. Silakan cek email Anda untuk verifikasi.');
        return redirect('login');

        return $user;
    }


    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Create a new user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Assign the 'member' role to the user
        $user->assignRole('member');

        // Create a member record if it doesn't exist
        if (!Member::where('email', $data['email'])->exists()) {
            Member::create([
                'password' => Hash::make($data['password']),
                'email' => $data['email'],
                'emailwithoutdot' => $data['email']
            ]);
        }

        // Generate a random token for email verification
        $token = Str::random(64);

        // Create a UserVerify record with the user's ID and the generated token
        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        // Send an email with the verification token
        Mail::send('front.email.emailVerificationEmail', ['token' => $token], function ($message) use ($data) {
            $message->to($data['email']);
            $message->subject('Email Verification');
        });

        // Flash a success message to the session
        Session::flash('success', 'Registrasi berhasil. Silakan cek email Anda untuk verifikasi.');

        // Redirect the user to the login page
        return redirect('login');
    }
}
