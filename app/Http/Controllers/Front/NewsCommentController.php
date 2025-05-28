<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsComment;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsCommentController extends Controller
{
    public function store(Request $request, $newsId)
    {
        $request->validate([
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:news_comments,id',
            'guest_name' => auth()->check() ? 'nullable' : 'required|string|max:100',
        ]);

        NewsComment::create([
            'user_id' => auth()->id(), // null jika guest
            'guest_name' => auth()->check() ? null : $request->guest_name,
            'news_id' => $newsId,
            'parent_id' => $request->parent_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }
}
