<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use OpenAI\Laravel\Facades\OpenAI;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;


class DeepSeekChatController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */

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
    public function index(Request $request)
    {
        return view('back.deepseekchat.form');
    }

    public function sendPrompt(Request $request)
    {
        // Validasi input
        $request->validate([
            'prompt' => 'required|string|max:1000',
            'system_message' => 'nullable|string|max:1000', // Input pesan sistem dari user
        ]);

        // Ambil prompt dan pesan sistem dari input user
        $userPrompt = $request->input('prompt');
        $systemMessage = $request->input('system_message', 'You are a helpful assistant'); // Default system message


        // dump($userPrompt);
        // dd($systemMessage);

        // Header untuk request API
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . env('DEEPSEEK_API_KEY'),
        ];

        // Body untuk request API
        $body = json_encode([
            'messages' => [
                [
                    'content' => $systemMessage, // Pesan sistem dinamis
                    'role' => 'system',
                ],
                [
                    'content' => $userPrompt, // Prompt dari user
                    'role' => 'user',
                ],
            ],
            'model' => 'deepseek-chat',
            'frequency_penalty' => 0,
            'max_tokens' => 2048,
            'presence_penalty' => 0,
            'response_format' => [
                'type' => 'text',
            ],
            'stop' => null,
            'stream' => false,
            'stream_options' => null,
            'temperature' => 1,
            'top_p' => 1,
            'tools' => null,
            'tool_choice' => 'none',
            'logprobs' => false,
            'top_logprobs' => null,
        ]);

        // Buat request menggunakan Guzzle
        $guzzleRequest = new GuzzleRequest('POST', 'https://api.deepseek.com/chat/completions', $headers, $body);

        try {
            // Kirim request dan tunggu respons
            $response = $this->client->sendAsync($guzzleRequest)->wait();

            // Decode respons JSON
            $responseData = json_decode($response->getBody(), true);

            // Ambil pesan dari respons
            $message = $responseData['choices'][0]['message']['content'] ?? 'Tidak ada respons';

            // Tampilkan respons ke view
            return view('back.deepseekchat.result', [
                'model' => $systemMessage,
                'prompt' => $userPrompt,
                'response' => $message,
            ]);
        } catch (\Exception $e) {
            // Tangani error
            return view('back.deepseekchat.result', [
                'model' => $systemMessage,
                'prompt' => $userPrompt,
                'response' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }
}
