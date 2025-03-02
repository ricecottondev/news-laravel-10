<?php

namespace App\Services;

use GuzzleHttp\Client;

class DeepSeekService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.deepseek.com/v1/', // Ganti dengan base URL API DeepSeek
            'headers' => [
                'Authorization' => 'Bearer ' . env('DEEPSEEK_API_KEY'),
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function getDataFromDeepSeek()
    {
        $response = $this->client->get('endpoint'); // Ganti dengan endpoint yang sesuai
        return json_decode($response->getBody(), true);
    }
}
