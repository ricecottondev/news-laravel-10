<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Arr;

class UpdatePasswordMemberController extends Controller
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
        $id = $request->iduser;
        $password = $request->password;
       
    //    $this->validate($request, [
    //     'password' => 'same:confirm-password',
    // ]);


    $input = $request->all();
    if(!empty($input['password'])){ 
        $input['password'] = Hash::make($password);
    }else{
        $input = Arr::except($input,array('password'));    
    }
     //dd('success');
    try
    {
    $user = User::find($id);
    $user->update($input);

   
    return response()->json([
        'success' => true,
        'message' => 'Update Password Member Success',
    ]);
    }
    catch(Exception $e) 
    {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ]);        
    }
   
 
    }
}

