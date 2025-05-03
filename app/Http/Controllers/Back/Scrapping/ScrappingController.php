<?php

namespace App\Http\Controllers\Back\Scrapping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ScrappingController extends Controller
{
    public function index(Request $request)
    {
        // Jika tidak ada input URL, tampilkan view kosong
        $data = null;
        if (!$request->has('url')) {
            return view('back.Scrapper.scrapper-index', compact('data'));
        }

        $request->validate([
            'url' => 'required|url'
        ]);

        try {
            $data = $this->scrapper($request->url);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengambil data: ' . $e->getMessage());
        }

        return view('back.Scrapper.scrapper-index', compact('data'));
    }

    public function scrapper($url)
    {
        $client = new Client();
        $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0 Safari/537.36');

        $website = $client->request('GET', $url);

        $headings = [
            'title' => [],
            'h1' => [],
            'h2' => [],
            'h3' => [],
            'P' => [],
        ];
        $arrkeys = array_keys($headings);

        foreach ($arrkeys as $tag) {
            $website->filter($tag)->each(function ($node) use (&$headings, $tag) {
                $headings[$tag][] = $node->text();
            });
        }

        return $headings;
    }
}
