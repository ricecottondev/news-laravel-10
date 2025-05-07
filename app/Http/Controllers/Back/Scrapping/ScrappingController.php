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
        $data = null;

        if ($request->has('url')) {
            $data = $this->scrapper($request->url);
        }

        return view('back.Scrapper.scrapper-index', compact('data'));
    }

    public function scrapper($url)
    {
        $client = new Client();
        $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        try {
            $crawler = $client->request('GET', $url);

            $headings = [
                'title' => [],
                'h1' => [],
                'h2' => [],
                'h3' => [],
                'P' => [],
                'div' => [],
            ];
            $arrkeys = array_keys($headings);

            foreach ($arrkeys as $tag) {
                $crawler->filter($tag)->each(function ($node) use (&$headings, $tag) {
                    $headings[$tag][] = $node->text();
                });
            }

            return $headings;
        } catch (\Exception $e) {
            return [
                'error' => 'Gagal mengambil data: ' . $e->getMessage(),
            ];
        }
    }

    public function scrapperFulltext($url)
    {
        $client = new Client();
        $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        try {
            $crawler = $client->request('GET', $url);

            // Ambil semua teks dalam satu string
            $fullText = $crawler->text();

            // Ambil semua teks dari setiap node (tanpa filter tag)
            $allNodesText = [];
            $crawler->filterXPath('//*')->each(function ($node) use (&$allNodesText) {
                $text = trim($node->text());
                if ($text !== '') {
                    $allNodesText[] = $text;
                }
            });

            return [
                'full_text' => $fullText,
                'node_texts' => $allNodesText,
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Gagal mengambil data: ' . $e->getMessage(),
            ];
        }
    }
}
