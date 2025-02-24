<?php

namespace App\Http\Controllers\Api\Mobile\Auth;


use JWTAuth;
use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SocialAccount;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Picqer\Barcode\BarcodeGeneratorSVG;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LoginGoogleController extends Controller
{
    public function index(Request $request)
    {
        $provider = 'google';

        $socialAccount = SocialAccount::where('provider_id', $request->id)
            ->where('provider_name', $provider)
            ->first();
        if ($socialAccount) {

            if ($socialAccount->user == null) {
                return response()->json([
                    'success' => false,
                    'token' => 'Data User Tidak Ada',
                ], 200);
            }
            $token = JWTAuth::fromUser($socialAccount->user);
            return response()->json([
                'success' => true,
                'token' => $token,
                'name' => $socialAccount->user->name,
                'email' => $socialAccount->user->email,
            ]);
        } else {

            $user = User::where('email', $request->email)->first();
            $member = Member::where('email', $request->email)->first();


            if (!$user) {

                $user = User::create([
                    'name'  => $request->name,
                    'email' => $request->email,
                    'email_verified_at' =>   Carbon::now(),
                    'password' => Hash::make(Str::random(16))
                ]);
                $user->assignRole('Member');
            }
            if (!$member) {
                $member = Member::create([
                    'emailwithoutdot' => $request->email,
                    'email' => $request->email,
                    'password' => $user->password
                ]);

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
            }

            $user->socialAccounts()->create([
                'provider_id'   => $request->id,
                'provider_name' => $provider
            ]);

            $token = JWTAuth::fromUser($user);
            return response()->json([
                'success' => true,
                'token' => $token,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        }
    }
}
