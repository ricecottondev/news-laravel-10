<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FCMService
{
    public static function send($token, $notification)
    {
        $data = [
    'key1' => 'Nilai1',
    'key2' => 'Nilai2',
     'image' => 'https://point.indraco.com/indracostorepoint-template/img/png/logo_isp.png'
    // Tambahkan data lainnya sesuai kebutuhan Anda.
];
        Http::acceptJson()->withToken(config('fcm.token'))->post(
            'https://fcm.googleapis.com/fcm/send',
            [
                'to' => $token,
                'notification' => $notification,
                // 'data' => $data,
                // 'priority' => 'high',
                // "icon" => "icon.png",
                // "click_action" => "https://ekobudi.my.id"

            ]
        );
    }
}
