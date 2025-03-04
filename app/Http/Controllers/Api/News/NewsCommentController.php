<?php

namespace App\Http\Controllers\Api\News;

use Illuminate\Http\Request;
use App\Models\NewsComment;
use App\Models\News;
use App\Models\User;
use App\Http\Controllers\Controller;

class NewsCommentController extends Controller
{
    /**
     * POST: Menambahkan komentar ke berita.
     */
    public function postComment(Request $request)
    {
        $request->validate([
            'news_id' => 'required|exists:news,id',
            'user_id' => 'required|exists:users,id',
            'comment' => 'required|string|max:500',
        ]);

        $comment = NewsComment::create([
            'news_id' => $request->news_id,
            'user_id' => $request->user_id,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Comment posted successfully',
            'comment' => $comment
        ], 201);
    }

    /**
     * GET: Mengambil komentar berdasarkan news_id.
     */
    public function getComment(Request $request)
    {

        $news_id = $request->input('news_id');
        $news = News::find($news_id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $comments = NewsComment::where('news_id', $news_id)
            ->join('users', 'news_comments.user_id', '=', 'users.id') // Join untuk mengambil nama user
            ->select('news_comments.id', 'users.name', 'news_comments.comment', 'news_comments.created_at') // Pilih kolom yang dibutuhkan
            ->orderBy('news_comments.created_at', 'desc')
            ->get();

        return response()->json([
            'news_id' => $news_id,
            'comments' => $comments,
        ]);
    }

}
