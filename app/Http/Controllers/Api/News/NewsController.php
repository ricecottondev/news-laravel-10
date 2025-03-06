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

    // Mengambil parameter pagination
    $perPage = $request->input('limit', 10); // Default 10 item per halaman
    $page = $request->input('page', 1); // Default halaman 1

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

    // Order by DESC berdasarkan created_at (atau updated_at jika lebih sesuai)
    $news = $query->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);

    $data = $news->map(function ($item) {
        $baseUrl = env('APP_URL', url('/'));

        // Menentukan date berdasarkan created_at atau updated_at
        $date = $item->updated_at ? $item->updated_at : $item->created_at;
        $formattedDate = $date->format('F j, Y'); // Format tanggal sesuai kebutuhan

        return [
            'id' => $item->id,
            'title' => $item->title,
            'image_url' => $item->image ? $baseUrl . '/storage/' . $item->image : null,
            'category' => $item->category ? $item->category->name : 'Uncategorized', // Pastikan category tidak null
            'date' => $formattedDate
        ];
    });

    return response()->json(
        [
            'page' => $news->currentPage(),
            'limit' => $news->perPage(),
            'total_page' => $news->lastPage(),
            'total_news' => $news->total(),
            'data' => $data,
        ]
    );
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

    public function show(Request $request)
{
    $id = $request->id;
    $news = News::with('category')->where("id", $id)->first(); // Mengambil satu berita

    if (!$news) {
        return response()->json(['message' => 'News not found'], 404);
    }

    $baseUrl = env('APP_URL', url('/'));
    $date = $news->updated_at ? $news->updated_at : $news->created_at;
    $formattedDate = $date->format('F j, Y'); // Format tanggal sesuai kebutuhan

    return response()->json([
        'id' => $news->id,
        'title' => $news->title,
        'short_desc' => $news->short_desc,
        'content' => $news->content,
        'author' => $news->author,
        'slug' => $news->slug,
        'status' => $news->status,
        'image_url' => $news->image ? $baseUrl . '/storage/' . $news->image : null,
        'category' => $news->category ? $news->category->name : null, // Pastikan category berupa string atau null
        'date' => $formattedDate
    ], 200);
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

    // public function getSearchNews(Request $request)
    // {
    //     $query = $request->input('query');
    //     $countryName = $request->input('country_name');
    //     $categoryName = $request->input('category_name');

    //     // Mencari berita berdasarkan judul dan konten
    //     $newsQuery = News::query();

    //     // Filter berdasarkan judul dan konten
    //     if ($query) {
    //         $newsQuery->where(function ($q) use ($query) {
    //             $q->where('title', 'LIKE', "%{$query}%")
    //                 ->orWhere('content', 'LIKE', "%{$query}%");
    //         });
    //     }

    //     // Filter berdasarkan country_name
    //     if ($countryName) {
    //         $newsQuery->whereHas('countriesCategoriesNews', function ($q) use ($countryName) {
    //             $q->whereHas('country', function ($q) use ($countryName) {
    //                 $q->where('country_name', $countryName);
    //             });
    //         });
    //     }

    //     // Filter berdasarkan category_name
    //     if ($categoryName) {
    //         $newsQuery->whereHas('countriesCategoriesNews', function ($q) use ($categoryName) {
    //             $q->whereHas('category', function ($q) use ($categoryName) {
    //                 $q->where('name', $categoryName);
    //             });
    //         });
    //     }

    //     $newsItems = $newsQuery->with('category')->get()->map(function ($item) {
    //         $baseUrl = env('APP_URL', url('/'));
    //         $date = $item->updated_at ? $item->updated_at : $item->created_at;
    //         $formattedDate = $date->format('F j, Y'); // Format tanggal sesuai kebutuhan
    //         return [
    //             'id' => $item->id,
    //             // 'category_id' => $item->category_id,
    //             'title' => $item->title,
    //             'short_desc' => $item->short_desc,
    //             'content' => $item->content,
    //             'author' => $item->author,
    //             'slug' => $item->slug,
    //             'status' => $item->status,
    //             'image_url' => $item->image ? $baseUrl . '/storage/' . $item->image : null,
    //             'category' => $item->category ? $item->category->name : [], // Pastikan category berupa array
    //             'date' => $formattedDate
    //         ];
    //     });



    //     if ($newsItems->isEmpty()) {
    //         return response()->json(['message' => 'No news items found.'], 404);
    //     }

    //     return response()->json($newsItems, 200);
    // }

    public function getSearchNews(Request $request)
{
    $query = $request->input('query');
    $countryName = $request->input('country_name');
    $categoryName = $request->input('category_name');

    // Mengambil parameter pagination
    $perPage = $request->input('limit', 10); // Default 10 item per halaman
    $page = $request->input('page', 1); // Default halaman 1

    // Mencari berita berdasarkan judul dan konten
    $newsQuery = News::with('category');

    if ($query) {
        $newsQuery->where(function ($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
                ->orWhere('content', 'LIKE', "%{$query}%");
        });
    }

    if ($countryName) {
        $newsQuery->whereHas('countriesCategoriesNews', function ($q) use ($countryName) {
            $q->whereHas('country', function ($q) use ($countryName) {
                $q->where('country_name', $countryName);
            });
        });
    }

    if ($categoryName) {
        $newsQuery->whereHas('category', function ($q) use ($categoryName) {
            $q->where('name', $categoryName);
        });
    }

    // Order by DESC berdasarkan created_at
    $news = $newsQuery->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);

    $data = $news->map(function ($item) {
        $baseUrl = env('APP_URL', url('/'));
        $date = $item->updated_at ? $item->updated_at : $item->created_at;
        $formattedDate = $date->format('F j, Y');

        return [
            'id' => $item->id,
            'title' => $item->title,
            'image_url' => $item->image ? $baseUrl . '/storage/' . $item->image : null,
            'category' => $item->category ? $item->category->name : 'Uncategorized',
            'date' => $formattedDate
        ];
    });

    return response()->json([
        'page' => $news->currentPage(),
        'limit' => $news->perPage(),
        'total_page' => $news->lastPage(),
        'total_news' => $news->total(),
        'data' => $data,
    ]);
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
