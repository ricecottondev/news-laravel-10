<?php

namespace App\Http\Controllers\Front\Member;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
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
        $request->validate([
            'id_user' => 'required',
            'id_sub_product' => 'required',
        ]);

        // $users = Masterpelanggan::where('ver_code', auth()->user()->ver_code)->where('email', auth()->user()->email)->first();
        $cekfavorit = Wishlist::where('id_user', $request->id_user)->where('id_sub_product', $request->id_sub_product)->first();
        // dd($cekfavorit);

        if ($cekfavorit) {
            $status = $cekfavorit->deleted == "false" ? "true" : "false";
            // $userwishlist = 'update :' . $status;
            $userwishlist = $cekfavorit->update(['deleted' => $status]);
            $setfavorit = $status;
        } else {
            $userwishlist = Wishlist::create([
                'id_user' => $request->id_user,
                'id_sub_product' => $request->id_sub_product,
                'deleted' => "false",
            ]);
            $setfavorit = "null";
        }

        return response()->json(['data' => compact('setfavorit', 'userwishlist')]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cekfavorit = Wishlist::where('id', $id)->first();
        $favoritData = $cekfavorit->update(['deleted' => 'true']);
        if ($favoritData) {
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Data gagal dihapus.');
        }
    }
}
