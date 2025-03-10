<?php

namespace App\Http\Controllers\Api\News;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
            $categories = $item->countriesCategoriesNews->map(function ($ccn) {
                return $ccn->category ? $ccn->category->name : null;
            })->filter()->unique()->values()->toArray(); // Hapus null, duplikasi, dan reset indeks array

            return [
                'id' => $item->id,
                'title' => $item->title,
                'image_url' => $item->image ? $baseUrl . '/storage/' . $item->image : null,
                //'category' => $item->category ? $item->category->name : 'Uncategorized', // Pastikan category tidak null
                'category' => $categories, // Array string kategori
                'date' => $formattedDate
                // 'is_breaking_news' => $item->is_breaking_news
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
        $validator = Validator::make($request->all(), [

            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'status' => 'required|string|in:draft,published',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        if ($validator->fails()) {
            return response()->json($validator, 404);
        }
        //  dd("test");
        // Buat slug dari title
        $slug = preg_replace('/[&\/\\\()\+\-\?\<\>\@\#\!\$\%\^\*]/', '', $request->title); // Hapus karakter khusus
        $slug = str_replace(' ', '_', $slug); // Ganti spasi dengan "_"

        // Cek jika slug sudah ada di database
        $originalSlug = $slug;
        $count = 1;
        while (News::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '_' . $count;
            $count++;
        }

        // Simpan gambar ke dalam folder public/images/news
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images/news', 'public');
        }

        // $news = News::create($request->all());
        $news = News::create([
            'category_id' => 1,
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'content' => $request->content,
            'is_breaking_news' => $request->is_breaking_news ?? 0,
            'author' => $request->author,
            'slug' => $slug, // Slug hasil konversi
            'status' => $request->status,
            'image' => $imagePath, // Simpan path gambar ke database
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil ditambahkan',
            'data' => $news
        ], 201);
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
        $categories = $news->countriesCategoriesNews->map(function ($ccn) {
            return $ccn->category ? $ccn->category->name : null;
        })->filter()->unique()->values()->toArray(); // Hapus null, duplikasi, dan reset indeks array


        return response()->json([
            'id' => $news->id,
            'title' => $news->title,
            'short_desc' => $news->short_desc,
            'content' => $news->content,
            'author' => $news->author,
            'slug' => $news->slug,
            'status' => $news->status,
            'image_url' => $news->image ? $baseUrl . '/storage/' . $news->image : null,
            //'category' => $news->category ? $news->category->name : null, // Pastikan category berupa string atau null
            'category' => $categories,
            'date' => $formattedDate,
            // 'is_breaking_news' => $news->is_breaking_news
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
            $categories = $item->countriesCategoriesNews->map(function ($ccn) {
                return $ccn->category ? $ccn->category->name : null;
            })->filter()->unique()->values()->toArray(); // Hapus null, duplikasi, dan reset indeks array

            return [
                'id' => $item->id,
                'title' => $item->title,
                'image_url' => $item->image ? $baseUrl . '/storage/' . $item->image : null,
                //'category' => $item->category ? $item->category->name : 'Uncategorized',
                'category' => $categories,
                'date' => $formattedDate,
                // 'is_breaking_news' => $item->is_breaking_news
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

    public function getBreakingNews(Request $request)
    {
        // Mengambil parameter dari request
        $countryName = $request->input('country_name');
        $categoryName = "Breaking News";

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
        $news = $query->orderBy('created_at', 'desc')
            // ->where("is_breaking_news", 1)
            ->get();
        // ->paginate($perPage, ['*'], 'page', $page);

        $data = $news->map(function ($item) {
            $baseUrl = env('APP_URL', url('/'));

            // Menentukan date berdasarkan created_at atau updated_at
            $date = $item->updated_at ? $item->updated_at : $item->created_at;
            $formattedDate = $date->format('F j, Y'); // Format tanggal sesuai kebutuhan
            $categories = $item->countriesCategoriesNews->map(function ($ccn) {
                return $ccn->category ? $ccn->category->name : null;
            })->filter()->unique()->values()->toArray(); // Hapus null, duplikasi, dan reset indeks array

            return [
                'id' => $item->id,
                'title' => $item->title,
                'image_url' => $item->image ? $baseUrl . '/storage/' . $item->image : null,
                //'category' => $item->category ? $item->category->name : 'Uncategorized', // Pastikan category tidak null
                'category' => $categories,
                'date' => $formattedDate,
                // 'is_breaking_news' => $item->is_breaking_news
            ];
        });

        return response()->json(
            [
                'data' => $data,
            ]
        );
    }
}
