<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FirebaseHelper;

use GuzzleHttp\Client;

class NotificationController extends Controller
{
    public function send()
    {
        $client = new Client();
        $url = 'https://fcm.googleapis.com/v1/projects/factabot-5af4a/messages:send';

        $headers = [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ya29.a0AeXRPp7y3BFbil5DNNxS9yR_9gXP05r8kSNgVPC2fzMLy06eP6W8xaJlC78ZAQ9EfVbSyjsnNWs-Ls_8I9_EPb_v_RyLVtaAQi7VglR2vSARvX7AumuTOkArgRrM_kInr7fzvqvsLKmm2qzgEMB8ekUleWhRM_M6aEz2cSJtaCgYKAX4SARMSFQHGX2Mii3xpKpVRDwyo7b1tzvDhQA0175'
        ];

        $body = [
            'message' => [
                'token' => 'cBfrxbH4Te64W6eWQT3QX7:APA91bFyPbyG0yG-NZsk3nwPP08PvG2B8sQHUVVOfdS2NECjkbpOQr8OoX6jY1MY7qeL-CBDg0tuElaV2NEjEE9D360bEIDej-WhD-QDifz8JEivHtAxVnM',
                'notification' => [
                    'title' => 'Notifikasi dari Firebase',
                    'body'  => 'Ini adalah pesan laravel!'
                ],
                'data' => [
                    'customData' => 'Ini adalah data tambahan'
                ]
            ]
        ];

        try {
            $response = $client->post($url, [
                'headers' => $headers,
                'json'    => $body,
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Notifikasi berhasil dikirim!',
                'response' => json_decode($response->getBody()->getContents(), true),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal mengirim notifikasi!',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
