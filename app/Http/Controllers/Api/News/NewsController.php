<?php

namespace App\Http\Controllers\Api\News;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil parameter dari request
        $countryName = $request->input('country_name');
        $categoryName = $request->input('category_name');

        // Mengambil berita dengan relasi kategori
        $query = News::with('category');

        // Jika country_name diberikan, filter berdasarkan country
        if ($countryName) {
            $query->whereHas('countriesCategoriesNews', function ($q) use ($countryName) {
                $q->whereHas('country', function ($q) use ($countryName) {
                    $q->where('country_name', $countryName);
                });
            });
        }

        // Jika category_name diberikan, filter berdasarkan kategori
        if ($categoryName) {
            $query->whereHas('category', function ($q) use ($categoryName) {
                $q->where('name', $categoryName);
            });
        }

        // Mengambil hasil query
        $news = $query->get();

        // Mengembalikan response JSON
        return response()->json($news);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string',
            'short_desc' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string',
            'slug' => 'required|string|unique:news,slug',
            'status' => 'required|string',
        ]);

        $news = News::create($request->all());
        return response()->json($news, 201);
    }

    public function show($id)
    {
        return News::with('category')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string',
            'short_desc' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string',
            'slug' => 'required|string|unique:news,slug,' . $id,
            'status' => 'required|string',
        ]);

        $news = News::findOrFail($id);
        $news->update($request->all());
        return response()->json($news, 200);
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return response()->json(null, 204);
    }

    public function getSearchNews(Request $request)
    {
        $query = $request->input('query');
        $countryName = $request->input('country_name');
        $categoryName = $request->input('category_name');

        // Mencari berita berdasarkan judul dan konten
        $newsQuery = News::query();

        // Filter berdasarkan judul dan konten
        if ($query) {
            $newsQuery->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('content', 'LIKE', "%{$query}%");
            });
        }

        // Filter berdasarkan country_name
        if ($countryName) {
            $newsQuery->whereHas('countriesCategoriesNews', function ($q) use ($countryName) {
                $q->whereHas('country', function ($q) use ($countryName) {
                    $q->where('country_name', $countryName);
                });
            });
        }

        // Filter berdasarkan category_name
        if ($categoryName) {
            $newsQuery->whereHas('countriesCategoriesNews', function ($q) use ($categoryName) {
                $q->whereHas('category', function ($q) use ($categoryName) {
                    $q->where('name', $categoryName);
                });
            });
        }

        $newsItems = $newsQuery->with('category')->get();

        if ($newsItems->isEmpty()) {
            return response()->json(['message' => 'No news items found.'], 404);
        }

        return response()->json($newsItems, 200);
    }

    public function getDetailNews($id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        return response()->json($news, 200);
    }
}
