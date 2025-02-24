<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('back.users.index', compact('users'));
    }

    public function create()
    {
        return view('back.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer',
            'nim' => 'nullable|string|max:255',
            'kampus' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'negara' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'kodepos' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('back.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('back.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('back.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8',
            'role_id' => 'required|integer',
            'nim' => 'nullable|string|max:255',
            'kampus' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'negara' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'kodepos' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $user->fill($request->all());
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('back.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('back.users.index')->with('success', 'User deleted successfully.');
    }

    public function loginById(Request $request)
    {
        $id = $request->id;
        Auth::logout();

        Auth::loginUsingId($id);
        return redirect('admin/dashboard');
       
    }
}
