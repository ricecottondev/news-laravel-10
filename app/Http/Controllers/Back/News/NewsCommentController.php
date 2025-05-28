<?php

namespace App\Http\Controllers\Back\News;

use App\Http\Controllers\Controller;
use App\Models\NewsComment;
use Illuminate\Http\Request;

class NewsCommentController extends Controller
{
    public function index()
    {
        $comments = NewsComment::with(['news', 'user'])->latest()->get();
        return view('back.news_comments.index', compact('comments'));
    }

    public function edit($id)
    {
        $comment = NewsComment::findOrFail($id);
        return view('back.news_comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = NewsComment::findOrFail($id);

        $request->validate([
            'status' => 'required|in:draft,published'
        ]);

        $comment->update([
            'status' => $request->status
        ]);

        return redirect()->route('back.news-comments.index')->with('success', 'Status komentar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $comment = NewsComment::findOrFail($id);
        $comment->delete();

        return redirect()->route('back.news-comments.index')->with('success', 'Komentar berhasil dihapus.');
    }
}
