<?php

namespace App\Http\Controllers\Back\Scrapping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Client;
use DOMDocument;
use DOMXPath;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Str;

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

        //dd($data);

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
                // 'a',

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

                if ($tag === 'a') {
                    $href = $node->attr('href');

                    // Validasi URL berita sesuai pola /news/YYYY-MM-DD/slug/angka
                    if ($href && preg_match('#^https://www\.abc\.net\.au/news/\d{4}-\d{2}-\d{2}/[^/]+/\d+#', $href)) {
                        // Masukkan hanya URL berita valid
                        // dump("<a href=\"{$href}\">{$href}</a>");
                        $orderedText[] = "<a href=\"{$href}\">{$href}</a>";
                    }

                    return;
                }

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

            $fullText = '';
            // dump($orderedText);
            foreach ($orderedText  as $line) {
                $fullText = $fullText . $line;
            }
            // dd($fullText);
            $result = $this->extractArticlesFromHtml($fullText);




            return [
                'ordered_text' => $result,
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



    function extractArticlesFromHtml($html)
    {

        $crawler = new Crawler($html);
        $articles = [];
        $now = date('Y-m-d');
        $oldurl = '';

        $crawler->filter('[class*="CardHeading"]')->each(function ($node, $i) use (&$articles, $now, &$oldurl) {
            // Sekarang $i berisi index: 0, 1, 2, ...
            // dump("oldurl :".$oldurl);
            if ($i > 0) {
                // Jika $i lebih dari 0, ambil elemen berikutnya
                $node = $node->nextAll()->first();
                // dump("Index ke-$i: " . $node->text());
                //dump($node->ancestors()->filter('a')->first());

                $linkNode = $node->ancestors()->filter('a')->first();


                $title = trim($node->text());

                // Cari <div> setelah judul sebagai ringkasan
                $summaryNode = $node->nextAll()->first();
                $summary = $summaryNode ? trim($summaryNode->text()) : '';

                // Deteksi tanggal di summary
                $date = $now;
                if (preg_match('/\d{1,2}\s+[A-Za-z]+\s+\d{4}|\b[A-Za-z]+\s+\d{1,2},\s+\d{4}|\d{1,2}\/\d{1,2}\/\d{2,4}/', $summary, $match)) {
                    $date = $match[0];
                }

                // Cari node yang mengandung "Source: ... /Topic: ..."
                $contextNode = null;
                // Coba cari <a> terdekat yang membungkus atau mengelilingi judul
                $url = null;
                // Ambil <a> terdekat yang membungkus judul
                $linkNode = null;

                $node->previousAll()->each(function ($n, $a) use (&$linkNode) {
                    // Stop iterasi jika sudah ketemu sebelumnya
                    if ($linkNode) return false;


                    if ($n->nodeName() === 'a') {
                        $href = $n->attr('href');

                        // Debug
                        // dump('ada ' . $a);
                        // dump($href);

                        if (
                            $href &&
                            preg_match('#^https://www\.abc\.net\.au/news/\d{4}-\d{2}-\d{2}/[a-z0-9\-]+/\d+$#i', $href)
                        ) {
                            $linkNode = $n;

                            return false; // ✅ hentikan iterasi setelah match
                        }
                    }
                });



                $node->nextAll()->each(function ($n) use (&$contextNode) {
                    $text = $n->text();
                    if (Str::contains($text, 'Source:') && Str::contains($text, '/Topic:')) {
                        $contextNode = $n;
                        return false; // stop looping
                    }
                });

                $url = $linkNode ? $linkNode->attr('href') : null;


                // dump("oldurl :".$oldurl);
                // dump("url :".$url);
                if($url == $oldurl){
                    // dump("sama");
                    $url = null;
                }
                else
                {
                    // dump("beda");
                    $oldurl = $url;
                }




                $source = '';
                $topic = '';

                if ($contextNode) {
                    $text = $contextNode->text();
                    if (preg_match('/Source:\s*(.*?)\s*\/Topic:\s*(.*)/', $text, $match)) {
                        $source = trim($match[1]);
                        $topic = trim($match[2]);
                    }
                }

                if ($title && $summary && $source && $topic && $url) {
                    $articles[] = [
                        'title' => $title,
                        'summary' => $summary,
                        'source' => $source,
                        'topic' => $topic,
                        'date' => $date,
                        'url' => $url
                    ];
                }
            }
        });

        // dd($articles);
        return $articles;

        //dd("===================================end=============================================================================");




        // Cari semua elemen dengan class mengandung "CardHeading"
        $crawler->filter('[class*="CardHeading"]')->each(function ($node) use (&$articles, $now) {
            dump($node->text());
            dump($node->ancestors()->filter('a')->first());
            $linkNode = $node->ancestors()->filter('a')->first();
            $title = trim($node->text());
            // Cari <div> setelah judul sebagai ringkasan
            $summaryNode = $node->nextAll()->first();
            $summary = $summaryNode ? trim($summaryNode->text()) : '';

            // Deteksi tanggal di summary
            $date = $now;
            if (preg_match('/\d{1,2}\s+[A-Za-z]+\s+\d{4}|\b[A-Za-z]+\s+\d{1,2},\s+\d{4}|\d{1,2}\/\d{1,2}\/\d{2,4}/', $summary, $match)) {
                $date = $match[0];
            }

            // Cari node yang mengandung "Source: ... /Topic: ..."


            $contextNode = null;

            // Coba cari <a> terdekat yang membungkus atau mengelilingi judul
            $url = null;

            // Ambil <a> terdekat yang membungkus judul
            $linkNode = null;

            $node->nextAll()->each(function ($n) use (&$contextNode) {
                $text = $n->text();
                if (Str::contains($text, 'Source:') && Str::contains($text, '/Topic:')) {
                    $contextNode = $n;
                    return false; // stop looping
                }

                if ($n->nodeName() === 'a') {
                    dump('ada');
                    $href = $n->attr('href');
                    dump($href);
                    if ($href && preg_match('#^https://www\.abc\.net\.au/news/\d{4}-\d{2}-\d{2}/[a-z0-9\-]+/\d+$#i', $href)) {
                        $linkNode = $n;
                        return false; // stop if valid URL found
                    }
                }
            });

            // Coba cari <a> terdekat yang membungkus atau mengelilingi judul
            // $url = null;

            // Ambil <a> terdekat yang membungkus judul
            // $linkNode = null;

            // $node->nextAll()->each(function ($n) use (&$linkNode) {
            //     dump($linkNode);
            //     if ($n->nodeName() === 'a') {
            //         dump('ada');
            //         $href = $n->attr('href');
            //         dump($href);
            //         if ($href && preg_match('#^https://www\.abc\.net\.au/news/\d{4}-\d{2}-\d{2}/[a-z0-9\-]+/\d+$#i', $href)) {
            //             $linkNode = $n;
            //             return false; // stop if valid URL found
            //         }
            //     }
            // });
            // if ($linkNode) {
            //     $href = $linkNode->attr('href');

            //     // Validasi: hanya ambil URL dengan pola /news/YYYY-MM-DD/.../angka
            //     if (
            //         $href &&
            //         preg_match('#^https://www\.abc\.net\.au/news/\d{4}-\d{2}-\d{2}/[a-z0-9\-]+/\d+$#i', $href)
            //     ) {
            //         $url = $href;
            //     }
            // }

            $url = $linkNode ? $linkNode->attr('href') : null;

            //dd($url);

            $source = '';
            $topic = '';

            if ($contextNode) {
                $text = $contextNode->text();
                if (preg_match('/Source:\s*(.*?)\s*\/Topic:\s*(.*)/', $text, $match)) {
                    $source = trim($match[1]);
                    $topic = trim($match[2]);
                }
            }

            if ($title && $summary && $source && $topic) {
                $articles[] = [
                    'title' => $title,
                    'summary' => $summary,
                    'source' => $source,
                    'topic' => $topic,
                    'date' => $date,
                    'url' => $url
                ];
            }
        });
        dd($articles);
        return $articles;
    }
}
