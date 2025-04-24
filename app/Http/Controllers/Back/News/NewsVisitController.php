<?php

namespace App\Http\Controllers\Back\News;

use App\Http\Controllers\Controller;
use App\Models\NewsVisit;
use Illuminate\Http\Request;

class NewsVisitController extends Controller
{
    public function index(Request $request)
    {
        $visits = NewsVisit::with('news')
            ->orderBy('visited_at', 'desc')
            ->paginate(20);

        return view('back.news.visits', compact('visits'));
    }
}
