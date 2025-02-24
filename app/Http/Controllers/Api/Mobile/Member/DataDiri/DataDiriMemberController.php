<?php

namespace App\Http\Controllers\Api\Mobile\Member\DataDiri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member as MemberModel;
use JWTAuth;

class DataDiriMemberController extends Controller
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
        $userEmail = $user->email;
        $memberId = MemberModel::where('email', $userEmail)
            ->select('nama_ktp', 'telp', 'address', 'gender', 'kecamatan', 'birth_date', 'city', 'provinsi', 'desa', 'kodepos')
            ->first();


        if (empty($memberId->telp) || empty($memberId->provinsi) || empty($memberId->address) || empty($memberId->gender) || empty($memberId->birth_date)) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan lengkapi data diri anda terlebih dahulu.'
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Data diri anda sudah lengkap.',
                'data' => $memberId,
            ], 200);
        }
    }
}
