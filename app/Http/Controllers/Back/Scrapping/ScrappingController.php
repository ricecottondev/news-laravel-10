<?php
namespace App\Http\Controllers\Back\Scrapping;

use App\Exports\OrderedTextExport;
use App\Http\Controllers\Controller;
use App\Models\ArticleScraping;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\DomCrawler\Crawler;

class ScrappingController extends Controller
{
    public function index(Request $request)
    {
        $data = null;

        if ($request->has('url')) {
            // $data     = $this->scrapperFulltext($request->url);
            $data = $this->checkLinkBeforeScrapping($request->url);
            // $data = $this->scrapper($request->url);
        }

                                   //dd($data);
        session()->forget('data'); // Reset session
        session(['data' => $data]);
        return view('back.Scrapper.scrapper-index', compact('data'));
    }

    public function scrapper($url)
    {
        $client = new Client();
        $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        try {
            $crawler = $client->request('GET', $url);

            $data = [
                'title'    => [],
                'h1'       => [],
                'h2'       => [],
                'h3'       => [],
                'p'        => [],
                'span'     => [],
                'a'        => [],
                'a_links'  => [],
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

    public function checkLinkBeforeScrapping($url)
    {
        // Parse URL untuk mendapatkan host/domain
        $parsedUrl = parse_url($url, PHP_URL_HOST);

        if ($parsedUrl === 'www.abc.net.au') {
            $data = $this->scrapperFulltext($url);
        } elseif ($parsedUrl === 'www.bloomberg.com') {
            $data = 'Bloomberg';
        } elseif ($parsedUrl === 'edition.cnn.com') {
            $data = $this->scrapperFulltextCNN($url);
        } else {
            $data = 'Unknown';
        }

        return $data;
    }

    public function scrapperFulltextCNN($url)
    {
        $client = new Client();
        $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        try {
            $crawler = $client->request('GET', $url);

            $articles = [];

            // Filter tag <a> dengan class container__link--type-article
            $crawler->filter('a.container__link--type-article')->each(function ($node) use (&$articles) {
                // Ambil URL dari atribut href
                $href = $node->attr('href');

                // Pastikan URL lengkap
                if ($href && ! str_starts_with($href, 'http')) {
                    $href = 'https://edition.cnn.com' . $href;
                }
                // dump($href);
                // Ambil title dari span dengan class container__headline-text
                $title = $node->filter('span.container__headline-text')->count() > 0
                ? trim($node->filter('span.container__headline-text')->text())
                : '';

                // Validasi bahwa href dan title tidak kosong
                if ($href && $title) {
                    $articleContent = $this->scrapeArticleContentCNN($href);
                    $articles[]     = $articleContent;
                    if (! isset($articleContent['error'])) {
                    }
                }
            });

            return [
                'ordered_text' => $articles,
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Gagal mengambil data: ' . $e->getMessage(),
            ];
        }
    }

    public function scrapeArticleContentCNN($url)
    {
        $client = new Client();
        $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        try {
            $crawler = $client->request('GET', $url);

            // Ambil title dari h1 dengan class headline__text atau vossi-headline-text
            $title = $crawler->filter('h1.headline__text, h1.vossi-headline-text')->count() > 0
            ? trim($crawler->filter('h1.headline__text, h1.vossi-headline-text')->text())
            : '';

            // Ambil summary dari dua tag <p> pertama dengan class vossi-paragraph
            $summary    = '';
            $paragraphs = $crawler->filter('p.vossi-paragraph')->slice(0, 2);
            $paragraphs->each(function ($node) use (&$summary) {
                $text = trim($node->text());
                if ($text) {
                    $summary .= htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . ' ';
                }
            });
            $summary = trim($summary);

            // Ambil topic dari tag <a> dengan class breadcrumb__parent-link atau vossi-breadcrumb__parent-link
            $topic = $crawler->filter('a.breadcrumb__parent-link, a.vossi-breadcrumb__parent-link')->count() > 0
            ? trim($crawler->filter('a.breadcrumb__parent-link, a.vossi-breadcrumb__parent-link')->text())
            : '';

            // Ambil date dari div dengan class vossi-timestamp dan format ke YYYY-MM-DD
            // $date = $crawler->filter('div.vossi-timestamp')->count() > 0
            // ? trim($crawler->filter('div.vossi-timestamp')->text())
            // : '';
            // $date = $date ? Carbon::parse($date)->format('Y-m-d') : '';

            $date = '';
            if ($crawler->filter('div.vossi-timestamp')->count() > 0) {
                try {
                    $rawDate = trim($crawler->filter('div.vossi-timestamp')->text());
                    // Clean the "Published" prefix and normalize the format
                    $cleanDate = preg_replace('/^(Published|Updated)\s*/i', '', $rawDate);
                    // Map EDT to a valid timezone identifier
                    $cleanDate = str_replace('EDT', 'America/New_York', $cleanDate);
                    $date      = Carbon::parse($cleanDate, 'America/New_York')->format('Y-m-d');
                } catch (\Exception $e) {
                    $date = '';
                }
            }

            // Ambil content dari semua tag <p> dengan class vossi-paragraph
            $content = '';
            $crawler->filter('p.vossi-paragraph')->each(function ($node) use (&$content) {
                $text = trim($node->text());
                if ($text) {
                    $content .= htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "\n";
                }
            });
            $content = trim($content);

            // Tentukan source menggunakan fungsi checkLinkBeforeScrapping
            $source = "CNN";

            // Array untuk menyimpan hasil artikel
            $articles = [];

            // Validasi data sebelum menyimpan ke database
            if ($title && $summary && $source && $topic && $url && $date) {
                try {
                    // $sublink = self::getSubLink($url);

                    // Simpan artikel ke database
                    ArticleScraping::create([
                        'title'   => $title,
                        'summary' => $summary,
                        'source'  => $source,
                        'topic'   => $topic,
                        'date'    => $date,
                        'url'     => $url,
                        'content' => $content, // Gunakan content, bukan sublink
                    ]);

                    // Tambahkan artikel dengan alert-success
                    $articles = [
                        'title'   => $title,
                        'summary' => $summary,
                        'source'  => $source,
                        'topic'   => $topic,
                        'date'    => $date,
                        'url'     => $url,
                        'content' => $content,
                        'alert'   => 'alert-success',
                        'message' => 'Successfully inserted into database',
                    ];
                } catch (\Illuminate\Database\QueryException $e) {
                    // Tangani error, misalnya duplikasi URL
                    $errorMessage = 'Failed to insert into database';
                    if ($e->getCode() == 23000) { // Kode error untuk constraint unik
                        $errorMessage = 'Failed to insert: Duplicate URL';
                    } else {
                        $errorMessage .= ': ' . $e->getMessage();
                    }

                    $articles = [
                        'title'   => $title,
                        'summary' => $summary,
                        'source'  => $source,
                        'topic'   => $topic,
                        'date'    => $date,
                        'url'     => $url,
                        'content' => $content,
                        'alert'   => 'alert-danger',
                        'message' => $errorMessage,
                    ];
                } catch (\Exception $e) {
                    // Tangani error lain (misalnya, format tanggal salah)
                    $articles = [
                        'title'   => $title,
                        'summary' => $summary,
                        'source'  => $source,
                        'topic'   => $topic,
                        'date'    => $date,
                        'url'     => $url,
                        'content' => $content,
                        'alert'   => 'alert-danger',
                        'message' => 'Failed to insert: ' . $e->getMessage(),
                    ];
                }
            } else {
                // Jika data tidak lengkap
                $articles = [
                    'title'   => $title,
                    'summary' => $summary,
                    'source'  => $source,
                    'topic'   => $topic,
                    'date'    => $date,
                    'url'     => $url,
                    'content' => $content,
                    'alert'   => 'alert-danger',
                    'message' => 'Incomplete data for insertion',
                ];
            }

            // return [
            //     'articles' => $articles,
            // ];
            return $articles;

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
                // 'ul',
                // 'li',

                // Struktur halaman
                'html',
                'body',

                // Tambahan tag pembungkus/umum
                // 'div',
                // 'span',
                'main',
                'defs',
            ];

            $orderedText = [];

            $crawler->filterXPath('//*')->each(function ($node) use (&$orderedText, $excludedTags) {
                $tag = $node->nodeName();

                if (in_array($tag, $excludedTags)) {
                    return;
                }

                $text = trim($node->text());
                if ($text === '') {
                    return;
                }

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
                    $cleanText     = htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
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
            foreach ($orderedText as $line) {
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

    public function extractArticlesFromHtml($html)
    {

        $crawler  = new Crawler($html);
        $articles = [];
        $now      = date('Y-m-d');
        $oldurl   = '';
        // dump($crawler);

        $crawler->filter('[class*="CardHeading"]')->each(function ($node, $i) use (&$articles, $now, &$oldurl) {
            // Sekarang $i berisi index: 0, 1, 2, ...
            // dump("oldurl :".$oldurl);
            if ($i > 0) {
                // Jika $i lebih dari 0, ambil elemen berikutnya
                $node = $node->nextAll()->first();
                // dump("Index ke-$i: " . $node->text());
                //dump($node->ancestors()->filter('a')->first());
                // dump($node);

                $linkNode = $node->ancestors()->filter('a')->first();

                $title = trim($node->text());
                // dump("========================================================");
                // dump("Judul ke-$i: $title");

                // Cari <div> setelah judul sebagai ringkasan
                $summaryNode = $node->nextAll()->first();
                $summary     = $summaryNode ? trim($summaryNode->text()) : '';

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
                    if ($linkNode) {
                        return false;
                    }

                    if ($n->nodeName() === 'a') {
                        $href = $n->attr('href');

                        if (
                            $href &&
                            preg_match('#^https://www\.abc\.net\.au/news/\d{4}-\d{2}-\d{2}/[a-z0-9\-]+/\d+$#i', $href)
                        ) {
                            $linkNode = $n;

                            return false; // ✅ hentikan iterasi setelah match
                        }
                    }
                });

                // Cari elemen pertama yang mengandung Source: dan /Topic:
                $node->nextAll()->each(function ($n) use (&$contextNode) {
                    $htmlContent = $n->outerHtml(); // Ambil HTML lengkap dari node

                    // Periksa apakah HTML mengandung 'Source:' dan '/Topic:'
                    if ($contextNode === null && Str::contains($htmlContent, 'Source:') && Str::contains($htmlContent, '/Topic:')) {
                        $contextNode = $n;
                                      // dump("contextNode pertama ditemukan: $htmlContent"); // Debug elemen yang dipilih
                        return false; // Hentikan loop setelah elemen pertama ditemukan
                    }

                    // dump("Node diabaikan: $htmlContent"); // Debug node lain
                });

                $url = $linkNode ? $linkNode->attr('href') : null;

                // dump("oldurl :".$oldurl);
                // dump("url :".$url);
                if ($url == $oldurl) {
                    // dump("sama");
                    $url = null;
                } else {
                    // dump("beda");
                    $oldurl = $url;
                }

                $source = '';
                $topic  = '';

                // Proses contextNode untuk ekstraksi topik
                if ($contextNode) {
                    $text = $contextNode->text(); // Ambil teks bersih dari contextNode
                                                  // dump("Teks contextNode: $text"); // Debug teks yang diekstrak

                    // Gunakan regex yang fleksibel untuk menangkap topik
                    if (preg_match('/Source:\s*([^\s].*?)\s*\/Topic:\s*(.*)/', $text, $match)) {
                        $source = trim($match[1]);
                        $topic  = trim($match[2]);
                        // dump("Source: $source, Topik: $topic"); // Debug hasil ekstraksi
                    } else {
                        $source = 'Unknown';
                        $topic  = 'Unknown';
                        // dump("Regex gagal, teks: $text"); // Debug jika regex gagal
                    }
                } else {
                    $source = 'Unknown';
                    $topic  = 'Unknown';
                    // dump("contextNode tidak ditemukan"); // Debug jika contextNode tidak ada
                }
                // dump($topic);
                if ($title && $summary && $source && $topic && $url) {
                    try {
                        $sublink = self::getSubLink($url);

                        // Coba simpan artikel ke database
                        ArticleScraping::create([
                            'title'   => $title,
                            'summary' => $summary,
                            'source'  => $source,
                            'topic'   => $topic,
                            'date'    => Carbon::parse($date)->format('Y-m-d'), // Pastikan format tanggal benar
                            'url'     => $url,
                            'content' => $sublink, // Gunakan 'content' sesuai array
                        ]);

                        // Jika berhasil, tambahkan artikel dengan alert-success
                        $articles[] = [
                            'title'   => $title,
                            'summary' => $summary,
                            'source'  => $source,
                            'topic'   => $topic,
                            'date'    => $date,
                            'url'     => $url,
                            'content' => $sublink,
                            'alert'   => 'alert-success',
                            'message' => 'Successfully inserted into database',
                        ];
                    } catch (\Illuminate\Database\QueryException $e) {
                        // Tangani error, misalnya duplikasi URL
                        $errorMessage = 'Failed to insert into database';
                        if ($e->getCode() == 23000) { // Kode error untuk constraint unik
                            $errorMessage = 'Failed to insert: Duplicate URL';
                        } else {
                            $errorMessage .= ': ' . $e->getMessage();
                        }

                        // Tambahkan artikel dengan alert-danger
                        $articles[] = [
                            'title'   => $title,
                            'summary' => $summary,
                            'source'  => $source,
                            'topic'   => $topic,
                            'date'    => $date,
                            'url'     => $url,
                            'content' => $sublink,
                            'alert'   => 'alert-danger',
                            'message' => $errorMessage,
                        ];
                    } catch (\Exception $e) {
                        // Tangani error lain (misalnya, format tanggal salah)
                        $articles[] = [
                            'title'   => $title,
                            'summary' => $summary,
                            'source'  => $source,
                            'topic'   => $topic,
                            'date'    => $date,
                            'url'     => $url,
                            'content' => $sublink,
                            'alert'   => 'alert-danger',
                            'message' => 'Failed to insert: ' . $e->getMessage(),
                        ];
                    }
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
            $title    = trim($node->text());
            // Cari <div> setelah judul sebagai ringkasan
            $summaryNode = $node->nextAll()->first();
            $summary     = $summaryNode ? trim($summaryNode->text()) : '';

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
                if (Str::contains($text, 'Source:') && Str::contains($text, 'Topic:')) {
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

            $url = $linkNode ? $linkNode->attr('href') : null;

            //dd($url);

            $source = '';
            $topic  = '';

            if ($contextNode) {
                $text = $contextNode->text();
                if (preg_match('/Source:\s*(.*?)\s*\/Topic:\s*(.*)/', $text, $match)) {
                    $source = trim($match[1]);
                    $topic  = trim($match[2]);
                }
            }

            if ($title && $summary && $source && $topic) {
                $articles[] = [
                    'title'   => $title,
                    'summary' => $summary,
                    'source'  => $source,
                    'topic'   => $topic,
                    'date'    => $date,
                    'url'     => $url,
                ];
            }
        });
        // dd($articles);
        return $articles;
    }

    private function getSubLink($subLinks)
    {
        $client = new Client();
        $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        try {
            $crawler = $client->request('GET', $subLinks);

            $orderedTextFromSubLink = [];

            $crawler->filter('.paragraph_paragraph__iYReA')->each(function ($node) use (&$orderedTextFromSubLink) {
                // Hapus semua <a> tag dari node sebelum mengambil teks
                foreach ($node->filter('a') as $aTag) {
                    $aTag->parentNode->removeChild($aTag);
                }

                $text = trim($node->text());

                if ($text === '') {
                    return;
                }

                // Simpan hanya teks tanpa tag HTML
                $orderedTextFromSubLink[] = $text;
            });

            // Bersihkan teks dari potongan JSON
            $orderedTextFromSubLink = array_map(function ($text) {
                return self::removeJsonFragments($text);
            }, $orderedTextFromSubLink);

            // Hapus duplikat dan reset index
            $orderedTextFromSubLink = array_values(array_unique($orderedTextFromSubLink));

            // Gabungkan semua ke satu string
            $fullText = implode('', $orderedTextFromSubLink);

            return $fullText;
        } catch (\Throwable $th) {
            return [
                'error' => 'Gagal mengambil data: ' . $th->getMessage(),
            ];
        }
    }

    public function exportExcel()
    {
        $data = session('data')['ordered_text'] ?? [];

        if (empty($data)) {
            abort(400, 'Tidak ada data untuk diekspor.');
        }

        return Excel::download(new OrderedTextExport($data), 'export-news.xlsx');
    }
}
