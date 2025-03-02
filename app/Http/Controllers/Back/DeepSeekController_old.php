<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DeepSeekChatController_old extends Controller
{
    protected $client;

    public function __construct()
    {
        // Inisialisasi Guzzle HTTP Client
        $this->client = new Client([
            'base_uri' => 'https://api.deepseek.com/v1/', // Ganti dengan base URL API DeepSeek
            'headers' => [
                'Authorization' => 'Bearer ' . env('DEEPSEEK_API_KEY'),
                'Accept' => 'application/json',
            ],
        ]);
    }



    // Menampilkan form input prompt
    public function showForm()
    {
        return view('back.deepseekchat.form');
    }

    // Mengirim prompt ke API DeepSeek dan menampilkan respons
    public function sendPrompt(Request $request)
    {
        // Validasi input
        $request->validate([
            'prompt' => 'required|string|max:1000',
        ]);

        // Ambil prompt dari input user
        $prompt = $request->input('prompt');

        // Kirim request ke API DeepSeek
        try {
            $response = $this->client->post('chat', [
                'json' => [
                    'prompt' => $prompt,
                    'max_tokens' => 200, // Sesuaikan dengan kebutuhan
                ],
            ]);

            // Decode respons JSON
            $data = json_decode($response->getBody(), true);

            // Tampilkan respons ke view
            return view('back.deepseekchat.result', [
                'prompt' => $prompt,
                'response' => $data['choices'][0]['text'] ?? 'Tidak ada respons',
            ]);
        } catch (\Exception $e) {
            // Tangani error
            return view('back.deepseekchat.result', [
                'prompt' => $prompt,
                'response' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }
}
