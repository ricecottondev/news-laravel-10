<?php

namespace App\Http\Controllers;

use App\Models\NewsShare;
use Illuminate\Http\Request;


class ShareLogController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'news_id' => 'required|exists:news,id',
            'platform' => 'required|string|max:50',
        ]);

        NewsShare::create([
            'news_id' => $request->news_id,
            'platform' => $request->platform,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true]);
    }
}
