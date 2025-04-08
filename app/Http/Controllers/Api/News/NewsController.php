<?php

namespace App\Http\Controllers\Api\News;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use \Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use App\Models\Subscribe;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\CountriesCategoriesNews;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $countryName = $request->input('country_name');
        $categoryName = $request->input('category_name');

        // Mapping country ke region
        $asiaCountries = ['indonesia', 'malaysia', 'singapore', 'japan', 'india', 'thailand', 'philippines', 'vietnam', 'south korea'];
        $europeCountries = ['united kingdom', 'germany', 'france', 'italy', 'netherlands', 'spain', 'sweden', 'switzerland', 'norway', 'denmark'];

        if ($countryName) {
            $countryName = strtolower($countryName);

            if (in_array($countryName, $asiaCountries)) {
                $countryName = 'ASIA';
            } elseif (in_array($countryName, $europeCountries)) {
                $countryName = 'Europe';
            } elseif ($countryName === 'united states') {
                $countryName = 'USA';
            }
        }

        $perPage = $request->input('limit', 10);
        $page = $request->input('page', 1);

        $query = News::with('category', 'countriesCategoriesNews.country', 'countriesCategoriesNews.category');

        if ($countryName) {
            $query->whereHas('countriesCategoriesNews.country', function ($q) use ($countryName) {
                $q->where('country_name', $countryName);
            });
        }

        if ($categoryName) {
            $query->whereHas('countriesCategoriesNews.category', function ($q) use ($categoryName) {
                $q->where('name', $categoryName);
            });
        }

        // Tambahkan DISTINCT untuk mencegah duplikat karena join
        $query->select('news.*')->distinct();

        //$news = $query->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        $news = $query->orderBy('id', 'desc')->paginate($perPage, ['*'], 'page', $page);

        $data = $news->map(function ($item) {
            $baseUrl = env('APP_URL', url('/'));

            $date = $item->updated_at ?: $item->created_at;
            $formattedDate = $date->format('F j, Y');

            $categories = $item->countriesCategoriesNews->map(function ($ccn) {
                return $ccn->category ? $ccn->category->name : null;
            })->filter()->unique()->values()->toArray();

            $newssugestion = $this->newssugestions($item);

            return [
                'id' => $item->id,
                'title' => $item->title,
                'short_desc' => $item->short_desc,
                'image_url' => $item->image ? $baseUrl . '/storage/' . $item->image : null,
                'category' => $categories,
                'date' => $formattedDate,
                'sugestion' => $newssugestion
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


    public function newssugestions($item)
    {

        $keywords = explode(' ', $item->title);
        $suggestedNews = News::where('id', '!=', $item->id) // Hindari berita yang sedang dibaca
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $word) {
                    $query->orWhere('title', 'LIKE', "%{$word}%");
                }
            })
            ->limit(5) // Ambil maksimal 5 berita
            ->get();
        $datasugestion = $suggestedNews->map(function ($newssugestion) {
            $baseUrl = env('APP_URL', url('/'));
            $date = $newssugestion->updated_at ? $newssugestion->updated_at : $newssugestion->created_at;
            $formattedDate = $date->format('F j, Y'); // Format tanggal sesuai kebutuhan
            $categories = $newssugestion->countriesCategoriesNews->map(function ($ccn) {
                return $ccn->category ? $ccn->category->name : null;
            })->filter()->unique()->values()->toArray(); // Hapus null, duplikasi, dan reset indeks array

            return [
                'id' => $newssugestion->id,
                'title' => $newssugestion->title,
                'short_desc' => $newssugestion->short_desc,
                'image_url' => $newssugestion->image ? $baseUrl . '/storage/' . $newssugestion->image : null,
                //'category' => $newssugestion->category ? $newssugestion->category->name : 'Uncategorized', // Pastikan category tidak null
                'category' => $categories, // Array string kategori
                'date' => $formattedDate
                // 'is_breaking_news' => $newssugestion->is_breaking_news
            ];
        });

        return $datasugestion;
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

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token has expired, please login again'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token, please provide a valid token'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token not provided or is incorrect'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $id = $request->id;
        $news = News::with('category')->where("id", $id)->first(); // Mengambil satu berita

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        // ✅ Cek apakah user memiliki subscription aktif
        $isSubscribed = Subscribe::where('user_id', $user->id)
            ->where('end_date', '>=', Carbon::now()) // Subscription masih aktif
            ->exists();

        // ✅ Konfigurasi batasan untuk user yang belum berlangganan
        $accessLimit = 5; // Maksimal berita yang dapat dibaca oleh user tanpa subscribe
        $viewCountKey = "user_{$user->id}_view_count";
        $viewCount = Cache::get($viewCountKey, 0);



        // ✅ Tambah view count ke database
        $news->increment('views');

        $baseUrl = env('APP_URL', url('/'));
        $date = $news->updated_at ? $news->updated_at : $news->created_at;
        $formattedDate = $date->format('F j, Y'); // Format tanggal sesuai kebutuhan
        $categories = $news->countriesCategoriesNews->map(function ($ccn) {
            return $ccn->category ? $ccn->category->name : null;
        })->filter()->unique()->values()->toArray(); // Hapus null, duplikasi, dan reset indeks array

        // ✅ Jika user belum subscribe, batasi akses hanya bisa melihat 5 berita
        if (!$isSubscribed && $viewCount >= $accessLimit) {
            // $viewCountKey = "user_{$user->id}_view_count";
            // $viewCount = Cache::get($viewCountKey, 0);


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
                'view' => $news->views,
                'subscribed' => $isSubscribed,
                'view_count' => $viewCount,
                // 'access_limit' => $accessLimit,
                'status' => true,
                // 'success' => false,
                'access_limit' => false,
                'message' => 'You have reached the free news view limit. Please subscribe to access more news.',
                'total_comment' => $news->comments->count(),
                'link' => 'https://prism.sda.co.id/subscribes'
            ], 200);


            // Tambahkan jumlah berita yang dilihat
            Cache::put($viewCountKey, $viewCount + 1, now()->addDay()); // Reset setiap hari
        }

        $news->increment('views');

        // ✅ Tambahkan jumlah berita yang dilihat oleh user dalam cache
        Cache::increment($viewCountKey);
        Cache::put($viewCountKey, Cache::get($viewCountKey, 0), now()->addDay()); // Reset setiap hari

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
            'view' => $news->views,
            'subscribed' => $isSubscribed,
            'view_count' => $viewCount,
            // 'access_limit' => $accessLimit,
            'limit_detail' => "You have read $viewCount out of $accessLimit free news articles.",
            'status' => true,
            // 'success' => true,
            'access_limit' => true,
            'total_comment' => $news->comments->count(),
            'link' => 'https://prism.sda.co.id/subscribes'
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
            })->limit(10);
        }

        // Jika category_name diberikan, filter berdasarkan kategori
        // if ($categoryName) {
        //     $query->whereHas('category', function ($q) use ($categoryName) {
        //         $q->where('name', $categoryName);
        //     });
        // }


        if ($categoryName) {
            $query->whereHas('countriesCategoriesNews', function ($q) use ($categoryName) {
                $q->whereHas('category', function ($q) use ($categoryName) {
                    $q->where('name', $categoryName);
                });
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

    public function getNewsVoice(Request $request)
    {
        // Mengambil parameter dari request
        $countryName = $request->input('country_name');
        $categoryName = $request->input('category_name');

        // Mengambil parameter pagination
        $perPage = $request->input('limit', 1); // Default 10 item per halaman
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
                'content' => $item->content,
                'image_url' => $item->image ? $baseUrl . '/storage/' . $item->image : null,
                //'category' => $item->category ? $item->category->name : 'Uncategorized', // Pastikan category tidak null
                // 'category' => $categories, // Array string kategori
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

    public function bulkStore(Request $request)
    {
        // Simpan country & category ke session
        session([
            'import_country_id' => $request->country_id,
            'import_category_id' => $request->category_id,
        ]);

        $data = $request->input('news');
        if ($data) {
            foreach ($data as $item) {
                $news = News::create([
                    'title'   => $item['title'],
                    'short_desc' => $item['short_desc'],
                    'content' => $item['content'],
                    'is_breaking_news' => 0,
                    'author'  => 'factabot',
                    'slug'    => \Illuminate\Support\Str::slug($item['title'], '_'),
                    'status'  => 'draft',
                    'views'   => 0,
                ]);

                // Ambil Country & Category dari session
                $country_id = Session::get('import_country_id');
                $category_id = Session::get('import_category_id');

                // Simpan relasi berita dengan Country & Category
                CountriesCategoriesNews::create([
                    'country_id' => $country_id,
                    'category_id' => $category_id,
                    'news_id' => $news->id,
                    'status' => 'active',
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'News successfully saved!']);
    }
}
