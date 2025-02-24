<?php

namespace App\Http\Controllers\Api\MasterMerchant\Auth;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterMemberMerchantController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            // Check if the user already exists in the User table
            $existingUser = User::where('email', $request->email)->first();
            $passwordHas =    $request->password;


            if (!$existingUser) {
                // If the user and member do not exist, create a new user
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $passwordHas,
                    'email_verified_at' =>   Carbon::now(),
                ]);

                // Assign the 'member' role to the user
                $user->assignRole('member');
            }

            // Check if the user already exists in the Member table
            $existingMember = Member::where('email', $request->email)->first();

            if (!$existingMember) {
                // Create a member record if it does not exist
                $member = Member::firstOrCreate(
                    ['email' => $request->email],
                    ['password' => $passwordHas]
                );
            }





            return response()->json([
                'success' => true,
                'message' => 'User and Member created successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
