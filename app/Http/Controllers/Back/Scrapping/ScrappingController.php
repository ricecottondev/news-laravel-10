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
            $data = $this->scrapperFulltext($request->url);
            // $data = $this->scrapper($request->url);
        }

        return view('back.Scrapper.scrapper-index', compact('data'));
    }

    public function scrapper($url)
    {
        $client = new Client();
        $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        try {
            $crawler = $client->request('GET', $url);

            $data = [
                'title' => [],
                'h1' => [],
                'h2' => [],
                'h3' => [],
                'p' => [],
                'span' => [],
                'a' => [],
                'a_links' => [],
                'img_srcs' => [],
            ];

            // Text content for specific tags
            foreach (['title', 'h1', 'h2', 'h3', 'p', 'span', 'a'] as $tag) {
                $crawler->filter($tag)->each(function ($node) use (&$data, $tag) {
                    $text = trim($node->text());
                    if ($text !== '') {
                        $data[$tag][] = $text;
                    }
                });
            }

            // Get href from <a> tags
            $crawler->filter('a')->each(function ($node) use (&$data) {
                $href = $node->attr('href');
                if ($href) {
                    $data['a_links'][] = $href;
                }
            });

            // Get src from <img> tags
            $crawler->filter('img')->each(function ($node) use (&$data) {
                $src = $node->attr('src');
                if ($src) {
                    $data['img_srcs'][] = $src;
                }
            });

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => 'Gagal mengambil data: ' . $e->getMessage(),
            ];
        }
    }


    // public function scrapper($url)
    // {
    //     $client = new Client();
    //     $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

    //     try {
    //         $crawler = $client->request('GET', $url);

    //         $headings = [
    //             'title' => [],
    //             'h1' => [],
    //             'h2' => [],
    //             'h3' => [],
    //             'P' => [],
    //             'a' => [],
    //             'src' => [],
    //             // 'div' => [],
    //         ];
    //         $arrkeys = array_keys($headings);

    //         foreach ($arrkeys as $tag) {
    //             $crawler->filter($tag)->each(function ($node) use (&$headings, $tag) {
    //                 $headings[$tag][] = $node->text();
    //             });
    //         }

    //         return $headings;
    //     } catch (\Exception $e) {
    //         return [
    //             'error' => 'Gagal mengambil data: ' . $e->getMessage(),
    //         ];
    //     }
    // }

    public function scrapperFulltext($url)
    {
        $client = new Client();
        $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        try {
            $crawler = $client->request('GET', $url);

            // Ambil semua teks dalam satu string
            $fullText = null;
            // $fullText = $crawler->text();

            // Daftar tag yang ingin dikecualikan
            $excludedTags = [
                'html',
                'body',
                'header',
                'footer',
                'script',
                'style',
                'meta',
                'link',
                'head',
                'noscript'
            ];

            // Kelompokkan teks berdasarkan tag
            $groupedByTag = [];

            $crawler->filterXPath('//*')->each(function ($node) use (&$groupedByTag, $excludedTags) {
                $tag = $node->nodeName();
                $text = trim($node->text());

                // Skip tag tertentu
                if (in_array($tag, $excludedTags)) return;

                if ($text !== '') {
                    $groupedByTag[$tag][] = $text;
                }

                // Tangani khusus untuk <a> dan <img>
                if ($tag === 'a') {
                    $href = $node->attr('href');
                    if ($href) {
                        $groupedByTag['a_href'][] = $href;
                    }
                }

                if ($tag === 'img') {
                    $src = $node->attr('src');
                    if ($src) {
                        $groupedByTag['img_src'][] = $src;
                    }
                }
            });

            // Hilangkan duplikat
            foreach ($groupedByTag as $tag => $texts) {
                $groupedByTag[$tag] = array_values(array_unique($texts));
            }

            return [
                'full_text' => $fullText,
                'grouped_by_tag' => $groupedByTag,
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Gagal mengambil data: ' . $e->getMessage(),
            ];
        }
    }
}
