<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsOrderController extends Controller
{
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'order' => 'required|integer|min:0|max:5'
        ]);

        $news->order = $validated['order'];
        $news->save();

        return response()->json(['success' => true]);
    }
}
