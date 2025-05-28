<?php


namespace App\Http\Controllers\Api\Beranda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use App\Models\BlockedIp;

class TestimonialController extends Controller
{
    public function index()
    {
        $data = Testimonial::where('status', 'published')
            ->latest()
            ->limit(10)
            ->pluck('message');

        return response()->json($data);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        if (BlockedIp::where('ip', $request->ip())->exists()) {
            return response()->json(['message' => 'Access denied.'], 403);
        }

        // Deteksi bot sederhana berdasarkan User-Agent
        $userAgent = $request->userAgent();
        $isBot = Str::contains(strtolower($userAgent), [
            'bot',
            'crawl',
            'spider',
            'slurp',
            'bingpreview',
            'wget',
            'curl'
        ]);

        if ($isBot) {
            return response()->json([
                'message' => 'Detected as bot, testimonial not accepted.'
            ], 403);
        }

        // Simpan testimonial + data IP
        Testimonial::create([
            ...$validated,
            'ip_address' => $request->ip(),
            'user_agent' => $userAgent,
            'is_bot' => $isBot,
            'status' => 'draft',
        ]);


        if ($isBot) {
            return response()->json([
                'message' => 'Detected as bot, testimonial not accepted.'
            ], 403);
        }

        return response()->json(['message' => 'Testimonial submitted successfully.']);
    }
}
