<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

use App\Models\Table_users;

class MigrationMemberController extends Controller
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
        $email = $request->email;

        $queryusers = DB::select("select * from users where email = '" . $email . "'");

        $message = "";
        if (count($queryusers) >= 1) {
            $message = "users already exist";
        } else {
            $name = $request->name;
            $email_verified_at = $request->email_verified_at;
            $address = $request->address;
            $phone = $request->phone;
            $password = $request->password;
            $image = $request->image;
            $remember_token = $request->remember_token;

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);

            $user->assignRole('member');

            $message = "users already migration";
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}
