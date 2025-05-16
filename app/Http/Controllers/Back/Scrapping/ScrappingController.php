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

    // public function scrapperFulltext($url)
    // {
    //     $client = new Client();
    //     $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

    //     try {
    //         $crawler = $client->request('GET', $url);

    //         // Ambil semua teks dalam satu string
    //         $fullText = null;
    //         // $fullText = $crawler->text();

    //         // Daftar tag yang ingin dikecualikan
    //         $excludedTags = [
    //             'html',
    //             'body',
    //             'header',
    //             'footer',
    //             'script',
    //             'style',
    //             'meta',
    //             'link',
    //             'head',
    //             'noscript'
    //         ];

    //         // Kelompokkan teks berdasarkan tag
    //         $groupedByTag = [];

    //         $crawler->filterXPath('//*')->each(function ($node) use (&$groupedByTag, $excludedTags) {
    //             $tag = $node->nodeName();
    //             $text = trim($node->text());

    //             // Skip tag tertentu
    //             if (in_array($tag, $excludedTags)) return;

    //             if ($text !== '') {
    //                 $groupedByTag[$tag][] = $text;
    //             }

    //             // Tangani khusus untuk <a> dan <img>
    //             if ($tag === 'a') {
    //                 $href = $node->attr('href');
    //                 if ($href) {
    //                     $groupedByTag['a_href'][] = $href;
    //                 }
    //             }

    //             if ($tag === 'img') {
    //                 $src = $node->attr('src');
    //                 if ($src) {
    //                     $groupedByTag['img_src'][] = $src;
    //                 }
    //             }
    //         });

    //         // Hilangkan duplikat
    //         foreach ($groupedByTag as $tag => $texts) {
    //             $groupedByTag[$tag] = array_values(array_unique($texts));
    //         }

    //         return [
    //             'full_text' => $fullText,
    //             'grouped_by_tag' => $groupedByTag,
    //         ];
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

            // Tag yang ingin dikecualikan dari hasil
            $excludedTags = [
                // Metadata dan layout
                'script',
                'style',
                'meta',
                'link',
                'head',
                'noscript',
                'base',

                // Navigasi & struktur
                'header',
                'footer',
                'nav',
                'aside',
                'section',

                // Media & embed
                'iframe',
                'svg',
                'canvas',
                'img',
                'video',
                'audio',
                'source',
                'embed',
                'object',
                'picture',
                'symbol',
                'polygon',
                'time',

                // Form & UI
                'form',
                'input',
                'button',
                'select',
                'textarea',
                'label',
                'details',
                'summary',

                // Navigasi dan tautan
                'a',

                // Struktur halaman
                'html',
                'body',

                // Tambahan tag pembungkus/umum
                // 'div',
                // 'span',
                'main',
                'defs'
            ];

            $orderedText = [];

            // Ambil semua elemen dan filter
            // $crawler->filterXPath('//*')->each(function ($node) use (&$orderedText, $excludedTags) {
            //     $tag = $node->nodeName();

            //     if (in_array($tag, $excludedTags)) return;

            //     $text = trim($node->text());
            //     $html = trim($node->html());

            //     // Tambahkan HTML lengkap jika valid
            //     if ($text !== '' && strip_tags($html) !== '') {
            //         $orderedText[] = $node->outerHtml(); // tampilkan dengan tag HTML
            //     }
            // });
            $crawler->filterXPath('//*')->each(function ($node) use (&$orderedText, $excludedTags) {
                $tag = $node->nodeName();

                if (in_array($tag, $excludedTags)) return;

                $text = trim($node->text());
                if ($text === '') return;

                if (in_array($tag, ['div', 'span', 'li', 'article'])) {
                    // Kosongkan semua tag di dalam, hanya ambil teks, tapi tetap gunakan tag aslinya
                    $cleanText = htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                    $orderedText[] = "<{$tag}>{$cleanText}</{$tag}>";
                } else {
                    // Ambil outer HTML utuh untuk tag lainnya
                    $orderedText[] = $node->outerHtml();
                }
            });

            // Bersihkan data yang mengandung JSON
            $orderedText = array_map(function ($text) {
                return self::removeJsonFragments($text);
            }, $orderedText);

            // Hapus duplikat dan reset index
            $orderedText = array_values(array_unique($orderedText));

            return [
                'ordered_text' => $orderedText,
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Gagal mengambil data: ' . $e->getMessage(),
            ];
        }
    }

    // Helper untuk menghapus fragmen JSON dan array JSON
    private static function removeJsonFragments($string)
    {
        // Hapus array JSON
        $string = preg_replace('/\[\s*\{.*?\}\s*\]/s', '', $string);

        // Hapus objek JSON
        $string = preg_replace('/\{\s*".*?"\s*:\s*.*?\}/s', '', $string);

        // Hapus isi {} atau []
        $string = preg_replace('/\{.*?\}/s', '', $string);
        $string = preg_replace('/\[.*?\]/s', '', $string);

        return trim($string);
    }
}
