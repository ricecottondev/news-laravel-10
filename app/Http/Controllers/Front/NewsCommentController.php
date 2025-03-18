<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsComment;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsCommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        NewsComment::create([
            'user_id' => Auth::id(), // Mengambil user ID yang sedang login
            'news_id' => $id,
            'comment' => $request->comment,
            'parent_id' => $request->parent_id ?? null
        ]);

        return back()->with('success', 'Comment posted successfully.');
    }
}
