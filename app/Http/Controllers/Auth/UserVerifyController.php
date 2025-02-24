<?php

namespace App\Http\Controllers\Auth;

use App\Models\Member;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Picqer\Barcode\BarcodeGeneratorSVG;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserVerifyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $verifyUser = UserVerify::where('token', $request->token)->first();

        $message = 'Maaf, email Anda tidak dapat diidentifikasi.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;
            $member = Member::where('email', $user->email)->first();
            if (!$user->email_verified_at) {
                $verifyUser->user->email_verified_at = now();
                $verifyUser->user->save();

                $userName = $user->name ?? 'DF'; 
                $formatName = strtoupper(substr($userName, 0, 2));
                $randomNumber = str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT);
                $uniqueCode =  $formatName . $randomNumber;

                // Generate QR Code
                $qrcode = QrCode::size(400)->generate($uniqueCode);
                $qrcodePath = 'qrcode-' . $uniqueCode . '.svg';
                $qrcodeFullPath = public_path('qrcode/' . $qrcodePath);
                file_put_contents($qrcodeFullPath, $qrcode);

                // Generate Barcode
                $generatorSVG = new BarcodeGeneratorSVG();
                $barcodeSVG = $generatorSVG->getBarcode($uniqueCode, $generatorSVG::TYPE_CODE_128);
                $barcodePath = 'barcode-' . $uniqueCode . '.svg';
                $barcodeFullPath = public_path('barcode/' . $barcodePath);
                file_put_contents($barcodeFullPath, $barcodeSVG);

                // Simpan informasi pada member
                $member->barcode = $barcodePath;
                $member->qrcode = $qrcodePath;
                $member->uniquecode = $uniqueCode;
                $member->save();
                $message = "Email anda berhasil diverifikasi. Silahkan login di aplikasi.";
            } else {
                $message = "Email Anda sudah diverifikasi. Silahkan login di aplikasi.";
            }
        }

        return view('page-sdamember.successverify')->with('success', $message);
    }
}
