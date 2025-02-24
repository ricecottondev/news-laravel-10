<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Arr;

    

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->get();
        $roles = Role::pluck('name','name')->all();
        return view('back.users.index',compact('data','roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('back.users.create',compact('roles'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
        ->with('success','User created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::find($id);
        return view('back.users.show',compact('user'));
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('back.users.edit',compact('user','roles','userRole'));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'name' => 'required',
            // 'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            // 'roles' => 'required'
            'file' => 'max:2048',
        ]);

        if ($request->hasfile('avatar')) {
            $fileName = time() . rand(1, 100) . '.' . $request->file('avatar')->extension();
            $file = $request->file('avatar');
            $file->move(public_path('images/users'), $fileName);
            dump("images");
        }

        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        if(!empty($fileName)){ 
            $input['image'] = $fileName;
        }else{
            $input['image'] = "";
        }
        
        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
        ->with('success','User updated successfully');

    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        dd("hapus");
        User::find($id)->delete();
        return redirect()->route('back.users.index')
        ->with('success','User deleted successfully');

    }

    public function loginas(Request $request)
    {
        $id = $request->id;
        $email = $request->email;
        Auth::logout();
        Auth::loginUsingId($id);
        $user = User::find($id);
        if ($user->hasRole('Admin')) {
            return redirect('/dashboard');
        } else  if ($user->hasRole('Member')) {
            return redirect('/home');
        }

       
    }

}
