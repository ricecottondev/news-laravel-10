<?php

namespace App\Http\Controllers\Api\MasterMerchant\Point;


use App\Models\User;
use App\Models\Merchant;
use App\Models\Uniquecode;
use App\Models\Notification;
use App\Services\FCMService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Claim_uniquecode;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;

class PostPointBonusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $email = $request->email;
        $point = $request->point;
        $merchant = $request->id_merchant;
        $label = 'Bonus Indraco Store';
        $expired = Carbon::now();


        $code = $this->generateCode();
        $entry = [
            'kode' => $code,
            'point' => $point,
            'label' => $label,
            'status' => 'used',
            'expired_date' => $expired,
        ];



        $codeGenerate = Uniquecode::create($entry);

        $memberId = MemberModel::where('email', $email)->first()->id;
        $Onepoint_voucher = Claim_uniquecode::create(['id_member' => $memberId, 'id_uniquecode' => $codeGenerate->id, 'point' => $point]);

        $merchantName = Merchant::find($merchant);


        $TokenFirebase = User::where('email', $email)->first();

        $titleNotif = 'Bonus Poin';
        $bodyNotif = 'Selamat, Anda  Mendapatkan  ' . $point . ' Poin Dari Merchant ' . $merchantName->merchant_name;

        $notificationData = [
            'member_id' => $memberId,
            'notification_date' => Carbon::now(),
            'notification_title' => $titleNotif,
            'notification_content' => $bodyNotif,
            'notification_status' => 'Unread',
        ];

        $notification = Notification::create($notificationData);

        $data =  FCMService::send(
            $TokenFirebase->token_firebase,
            [
                'title' => $titleNotif,
                'body' => $bodyNotif,
            ]
        );


        return response()->json([
            'success' => true,
            'message' => 'Point Berhasil di tambahkan',
        ]);
    }


    private function generateCode()
    {
        // Generate a string of 16 characters with a dash every 4 characters
        $code = '';
        for ($i = 0; $i < 16; $i++) {
            // Add a dash every 4 characters
            if ($i > 0 && $i % 4 === 0) {
                $code .= '-';
            }

            // Ensure the first character of each block is a letter
            if ($i % 5 === 0) {
                $code .= $this->generateRandomChar(true); // Pass true to generate letters
            } else {
                $code .= $this->generateRandomChar();
            }
        }

        return $code;
    }

    private function generateRandomChar($letters = false)
    {
        // Generate a random character (letter or number)
        $characters = $letters ? 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' : '0123456789';
        $randomChar = $characters[rand(0, strlen($characters) - 1)];

        return $randomChar;
    }
}
