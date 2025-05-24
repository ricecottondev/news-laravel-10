<?php
namespace App\Http\Controllers\Back\IpCheck;

use App\Http\Controllers\Controller;
use App\Models\NewsVisit;
use App\Models\PageVisit;
use Illuminate\Http\Request;

class IpCheckController extends Controller
{
    public function index(Request $request)
    {
        $botPattern = '/(bot|crawl|slurp|spider|baidu|yandex|bing|google|facebook|duckduck)/i';

        $newsVisits = NewsVisit::all()->map(function ($visit) use ($botPattern) {
            $visit->is_bot = preg_match($botPattern, $visit->user_agent) ? 'Yes' : 'No';
            return $visit;
        });

        $pageVisits = PageVisit::all()->map(function ($visit) use ($botPattern) {
            $visit->is_bot = preg_match($botPattern, $visit->user_agent) ? 'Yes' : 'No';
            return $visit;
        });

        $newsTotal  = $newsVisits->count();
        $newsBots   = $newsVisits->where('is_bot', 'Yes')->count();
        $newsHumans = $newsTotal - $newsBots;

        $pageTotal  = $pageVisits->count();
        $pageBots   = $pageVisits->where('is_bot', 'Yes')->count();
        $pageHumans = $pageTotal - $pageBots;

        $summary = [
            'news_total'          => $newsTotal,
            'news_bots'           => $newsBots,
            'news_bots_percent'   => $newsTotal ? round(($newsBots / $newsTotal) * 100, 1) : 0,
            'news_humans'         => $newsHumans,
            'news_humans_percent' => $newsTotal ? round(($newsHumans / $newsTotal) * 100, 1) : 0,

            'page_total'          => $pageTotal,
            'page_bots'           => $pageBots,
            'page_bots_percent'   => $pageTotal ? round(($pageBots / $pageTotal) * 100, 1) : 0,
            'page_humans'         => $pageHumans,
            'page_humans_percent' => $pageTotal ? round(($pageHumans / $pageTotal) * 100, 1) : 0,
        ];

        return view('back.ip_check.ipcheck', compact('newsVisits', 'pageVisits', 'summary'));
    }

    public function index2(Request $request)
    {
        $ip       = $request->ip(); // atau $request->getClientIp();
        $hostname = gethostbyaddr($ip);

        $isBot = preg_match('/(bot|crawl|slurp|spider|baidu|yandex|bing|google|facebook|duckduck)/i', $hostname);

        return view('back.ip_check.ipcheck', [
            'ip'       => $ip,
            'hostname' => $hostname,
            'isBot'    => $isBot,
        ]);
    }
}
