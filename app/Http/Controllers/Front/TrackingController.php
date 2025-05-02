<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsComment;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use App\Models\PageVisit;

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
            $data = json_decode(file_get_contents('php://input'), true); // karena sendBeacon tidak pakai header JSON

            $agent = new Agent();

            PageVisit::create([
                'url' => $data['url'] ?? '',
                'ip' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'browser' => $agent->browser(),
                'platform' => $agent->platform(),
                'duration' => $data['duration'] ?? 0,
                'visited_at' => now(),
            ]);

            return response()->json(['message' => 'Tracked']);
        } catch (\Exception $e) {
            \Log::error('Tracking Error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
