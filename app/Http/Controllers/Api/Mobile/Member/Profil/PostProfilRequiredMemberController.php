<?php

namespace App\Http\Controllers\Api\Mobile\Member\Profil;

use JWTAuth;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostProfilRequiredMemberController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $validator = Validator::make($request->all(), [
            'telp' => 'required',
            'birth_date' => 'required',
            'nama_ktp' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kodepos' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }

        $user = User::find($user->id);

        // $user->name = $request->nama_lengkap;
        // $user->save();

        $member = $user->member;
        $member->telp = $request->telp;
        $member->birth_date = $request->birth_date;
        $member->nama_ktp = $request->nama_ktp;
        $member->gender = $request->gender;
        $member->address = $request->address;
        $member->provinsi = $request->provinsi;
        $member->city = $request->kota;
        $member->kecamatan = $request->kecamatan;
        $member->desa = $request->kelurahan;
        $member->kodepos = $request->kodepos;
        $member->save();

        return response()->json([
            'success' => true,
            'name' => $user->name,
            'message' => 'Profile updated successfully',
        ]);
    }
}
