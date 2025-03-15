<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class FirebaseHelper
{
    public static function sendNotification($deviceToken, $title, $message)
    {
        $serverKey = config('services.firebase.server_key');
        $url = 'https://fcm.googleapis.com/fcm/send';

        $response = Http::withHeaders([
            'Authorization' => 'key=' . $serverKey,
            'Content-Type' => 'application/json',
        ])->post($url, [
            'to' => $deviceToken,
            'notification' => [
                'title' => $title,
                'body' => $message,
            ],
            'data' => [
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            ],
        ]);

        return $response->json();
    }
}
