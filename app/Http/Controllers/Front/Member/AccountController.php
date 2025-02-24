<?php

namespace App\Http\Controllers\Front\Member;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    use ImageUploadTraits;
    protected $pathImage;

    public function __construct()
    {
        $this->pathImage = 'images/users/';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::findOrFail(auth()->user()->id);

        if ($request->typeupdate === 'infoakun') {
            $usersValidator = Validator::make($request->all(), [
                'email' => 'required',
                'name' => 'required',
                'nama_belakang' => 'required',
                'phone' => 'required',
            ]);

            if ($usersValidator->fails()) {
                return back()->withErrors($usersValidator)->withInput();
            } else {
                // update users
                $users->update([
                    'email' => $request->email,
                    'name' => $request->name,
                    'nama_belakang' => $request->nama_belakang,
                    'phone' => $request->phone,
                ]);
            }

            return redirect()->back()->with('success', 'Data diri berhasil diubah.');
        } elseif ($request->typeupdate === 'infofoto') {
            // Validasi input
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Atur validasi sesuai kebutuhan
            ]);

            if ($request->hasFile('file')) {
                // Upload file dan dapatkan path beserta nama file
                $imagePath = $this->uploadImageAsset($request, 'file', $this->pathImage);
            
                // Ambil nama file asli tanpa modifikasi
                $filename = $imagePath['imagename'] . '.' . $imagePath['ext'];
            
                // Simpan nama file di folder yang diinginkan
                $filesname = $this->pathImage . $filename;
            
                // Jika user memiliki gambar sebelumnya, hapus gambar tersebut
                if ($users->image) {
                    // Gunakan fungsi explode untuk memecah berdasarkan simbol "/"
                    $parts = explode("/", $users->image);
                    // Hapus file lama
                    unlink("images/users/" . $parts[2]);
                }
            
                // Update kolom 'image' di database dengan nama file baru
                $users->update(['image' => $filesname]);
            }
            

            // Update kolom files pengguna dengan URL foto yang baru
            $users->update(['image' => $filesname]);

            return redirect()->back()->with('success', 'Foto profil berhasil diubah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
