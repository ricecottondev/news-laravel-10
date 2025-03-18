<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Models\Log_login;
use App\Models\Member;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
    //  * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
    //  * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    protected function attemptLogin(Request $request)
    {
        $explode = explode("@", $request->email);
        $explode[0] = str_replace(".", "", $explode[0]);
        $email = implode("@", $explode);


        // $GetMember =  Member::where('email', $request->email)->first();
        // if($GetMember != null && $GetMember->status == 'inactive'){
        //   session()->flash('error', 'Akun Sudah Non Aktif.');
        //   return false;
        // }


        if (auth()->attempt(['email' => $email, 'password' => $request->password])) {

            // dd($explode);

            $user = auth()->user();
            // if (!$user->email_verified_at) {
            //     auth()->logout();
            //     session()->flash('error', 'Silakan verifikasi email Anda terlebih dahulu.');
            //     return false;
            // }
            return true;
        }

        session()->flash('error', 'Login failed. Please check your credentials.');

        return false;
    }

    protected function authenticated(Request $request, $user)
    {


        if ($user->hasRole('Admin') || $user->hasRole('Staff')) {
            return redirect('/dashboard');
        } else  if ($user->hasRole('Manager')) {
            return redirect('/add_member');
        }else  if ($user->hasRole('Member')) {

            #set history user login
            $this->setlog_login($request, auth()->user()->id, "login");
            return redirect('/home');
        }
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {

        $title = "Sign In";
        $pages = "signin";
        return view('front.login', compact('title', 'pages'));
    }

    public function logout(Request $request)
    {
        #set history user logout
        // $this->setlog_login($request, auth()->user()->id, "logout");
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }


    public function setlog_login($request, $iduser, $type)
    {

        #get Ip
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else {
            $ipaddress = 'UNKNOWN';
        }


        $input = $request->all();
        $input["iduser"] = $iduser;
        $input["type"] = $type;

        $input["note"] = $type . " by member id: " . $iduser . " | Ip Address : " . $ipaddress;
        $input["status"] = "success";
        $input["deleted"] = 0;

        $log_login = Log_login::create($input);
    }
}
