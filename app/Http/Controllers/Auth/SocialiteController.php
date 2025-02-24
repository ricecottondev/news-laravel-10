<?php

namespace App\Http\Controllers\Auth;

use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SocialAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function handleProvideCallback($provider)
    {
        try {

            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return redirect()->back();
        }
        // find or create user and send params user get from socialite and provider
        $authUser = $this->findOrCreateUser($user, $provider);

        // login user
        // dd(Auth()->login($authUser, true));
        Auth()->login($authUser, true);

        // setelah login redirect ke dashboard
        return redirect('index');
    }

    public function findOrCreateUser($socialUser, $provider)
    {
        // dd($socialUser->user);

        // Get Social Account
        $socialAccount = SocialAccount::where('provider_id', $socialUser->getId())
            ->where('provider_name', $provider)
            ->first();

        // Jika sudah ada
        if ($socialAccount) {
            // return user
            return $socialAccount->user;

            // Jika belum ada
        } else {

            // User berdasarkan email 
            $user = User::where('email', $socialUser->getEmail())->first();

            $member = Member::where('email', $socialUser->getEmail())->first();

            // Jika Tidak ada user
            if (!$user) {
                // Create user baru
                $user = User::create([
                    'name'  => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(Str::random(16))
                ]);
                $user->assignRole('Member');
            }
            if (!$member) {
                $member = Member::create([
                    'emailwithoutdot' => $socialUser->getEmail(),
                    'email' => $socialUser->getEmail(),
                    'password' => $user->password
                ]);
            }

            // Buat Social Account baru
            $user->socialAccounts()->create([
                'provider_id'   => $socialUser->getId(),
                'provider_name' => $provider
            ]);

            // return user
            return $user;
        }
    }
}
