<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsComment;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use App\Models\PageVisit;
use Illuminate\Support\Str;


class TrackingController extends Controller
{
    public function trackNewsDuration(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['news_id']) || !isset($data['duration'])) {
            return response()->json(['status' => 'invalid'], 400);
        }

        // Optional: cari kunjungan terakhir untuk user dan update durasinya
        $visit = \App\Models\NewsVisit::where('news_id', $data['news_id'])
            ->where('ip', $request->ip())
            ->orderByDesc('visited_at')
            ->first();

        if ($visit) {
            $visit->duration_seconds = $data['duration'];
            $visit->save();
        }

        return response()->json(['status' => 'ok']);
    }

    public function trackPageDuration(Request $request)
    {
        $agent = new Agent();

        try {
            $data = json_decode(file_get_contents('php://input'), true); // untuk sendBeacon

            $referrer = $request->headers->get('referer');
            $userAgent = $request->header('User-Agent');

            // Prioritas: dari body JSON, dari query string, lalu dari referrer
            $source = $data['source'] ?? $request->query('source') ?? $this->detectSource($referrer);

            PageVisit::create([
                'url' => $data['url'] ?? '',
                'ip' => $request->ip(),
                'user_agent' => $userAgent,
                'browser' => $agent->browser(),
                'platform' => $agent->platform(),
                'duration' => $data['duration'] ?? 0,
                'visited_at' => now(),
                'referrer' => $referrer,
                'source' => $source,
            ]);

            return response()->json([
                'message' => 'Tracked',
                'source' => $source,
                'referrer' => $referrer,
            ]);
        } catch (\Exception $e) {
            \Log::error('Tracking Error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }



    private function detectSource(?string $referrer): ?string
    {
        if (!$referrer) return 'direct';

        $referrer = strtolower($referrer);

        return match (true) {
            str_contains($referrer, 'facebook.com') => 'facebook',
            str_contains($referrer, 'twitter.com') => 'twitter',
            str_contains($referrer, 'instagram.com') => 'instagram',
            str_contains($referrer, 't.co') => 'twitter-short',
            str_contains($referrer, 'wa.me'), str_contains($referrer, 'whatsapp.com') => 'whatsapp',
            str_contains($referrer, 'telegram.org'), str_contains($referrer, 't.me') => 'telegram',
            str_contains($referrer, 'linkedin.com') => 'linkedin',
            str_contains($referrer, 'youtube.com') => 'youtube',
            str_contains($referrer, 'google.com') => 'google',
            default => 'other',
        };
    }
}
