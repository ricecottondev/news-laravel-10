<?php

namespace App\Http\Controllers\Api\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsVisitMobile;
use Illuminate\Support\Carbon;

class MobileVisitController extends Controller
{
    /**
     * POST: Menyimpan data kunjungan halaman berita.
     */
    public function trackVisit(Request $request)
    {
        $request->validate([
            'page_name' => 'required|string',
            'news_title' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'device_id' => 'required|string|max:255',
            'session_duration' => 'nullable|numeric',
            'platform' => 'nullable|string|max:50',
        ]);

        $visit = NewsVisitMobile::create([
            'page_name' => $request->page_name,
            'news_title' => $request->news_title,
            'country' => $request->country,
            'device_id' => $request->device_id,
            'session_duration' => $request->session_duration,
            'platform' => $request->platform,
            'visited_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Visit recorded',
            'data' => $visit,
        ]);
    }
}
