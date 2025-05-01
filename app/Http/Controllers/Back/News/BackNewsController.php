<?php

namespace App\Http\Controllers\Back\News;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\CountriesCategories;
use App\Models\CountriesCategoriesNews;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NewsImport;
use App\Models\News;


class BackNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = Country::all();
        $categories = Category::all();

        $query = News::with('category')->orderBy('id', 'desc');

        // Search by title or short_desc
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('short_desc', 'like', '%' . $request->search . '%');
            });
        }

        $news = $query->paginate(10); // 10 items per page

        return view('back.news.index', compact('news', 'countries', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'status' => 'required|string|in:draft,published',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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

        // Simpan data ke database
        News::create([
            'category_id' => 1,
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'content' => $request->content,
            'is_breaking_news' => $request->has('is_breaking_news'),
            'author' => $request->author,
            'slug' => $slug, // Slug hasil konversi
            'status' => $request->status,
            'image' => $imagePath, // Simpan path gambar ke database
        ]);

        return redirect()->route('news-master.index')->with('success', 'News item created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('back.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        $news = News::findOrFail($id);
        $countries = Country::all();
        $categories = Category::all(); // Ambil semua kategori
        $countriescategoriesnews = $news->countriesCategoriesNews()->get();
        $defaultCountry = 4;
        $defaultCategory = CountriesCategories::where('country_id', $defaultCountry)
            ->pluck('category_id')
            ->first(); // Ambil 1 nilai kategori default
        return view('back.news.edit', compact('news', 'countries', 'categories', 'defaultCountry', 'defaultCategory'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, News $news)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'short_desc' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'status' => 'required|string|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Slug unik
        $slug = preg_replace('/[^A-Za-z0-9\- ]/', '', $request->title);
        $slug = str_replace(' ', '_', $slug);
        $originalSlug = $slug;
        $count = 1;
        while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
            $slug = $originalSlug . '_' . $count++;
        }

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }

            $imagePath = $request->file('image')->store('images/news', 'public');
            $news->image = $imagePath;
        }

        // Update data
        $news->title = $request->title;
        $news->short_desc = $request->short_desc;
        $news->content = $request->content;
        $news->author = $request->author;
        $news->slug = $slug;
        $news->status = $request->status;
        $news->is_breaking_news = $request->has('is_breaking_news');

        // $news->save();

        return redirect()->route('news-master.index')->with('success', 'News item updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // Hapus gambar jika ada
        if ($news->image) {
            Storage::delete('public/' . $news->image);
        }

        // Hapus berita
        // $news = News::findOrFail($id);


        $news->delete();

        return redirect()->route('news-master.index')->with('success', 'News item deleted successfully.');
    }

    public function importForm()
    {
        $countries = Country::where('status', 'active')->get(); // Ambil negara yang aktif
        return view('back.news.import', compact('countries'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Simpan country & category ke session untuk digunakan di import class
        session([
            'import_country_id' => $request->country_id,
            'import_category_id' => $request->category_id,
        ]);

        try {
            Excel::import(new NewsImport, $request->file('file'));
            return redirect()->back()->with('success', 'News imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing file: ' . $e->getMessage());
        }
    }

    public function bulkForm()
    {
        $countries = Country::all(); // Ambil semua negara
        return view('back.news.bulk', compact('countries'));
    }

    public function uncategorized(Request $request)
    {
        $query = News::leftJoin('countries_categories_news as ccn', 'news.id', '=', 'ccn.news_id')
            ->leftJoin('categories as c', 'c.id', '=', 'ccn.category_id')
            ->whereNull('c.id')
            ->select('news.*')
            ->distinct();

        if ($request->filled('start_date')) {
            $query->whereDate('news.created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('news.created_at', '<=', $request->end_date);
        }

        $uncategorizedNews = $query->get();
        $countries = Country::all();

        return view('back.news.uncategorized', compact('uncategorizedNews', 'countries'));
    }


    public function assignCategory(Request $request)
    {
        $request->validate([
            'news_id' => 'required|exists:news,id',
            'country_id' => 'required|exists:countries,id',
        ]);

        CountriesCategoriesNews::create([
            'news_id' => $request->news_id,
            'country_id' => $request->country_id,
            'category_id' => 24, // ID kategori Uncategorized
            'status' => 'active',
        ]);

        return response()->json(['success' => true, 'message' => 'Category assigned.']);
    }

    public function assignUncategorized(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
        ]);

        $uncategorizedNews = News::leftJoin('countries_categories_news as ccn', 'news.id', '=', 'ccn.news_id')
            ->leftJoin('categories as c', 'c.id', '=', 'ccn.category_id')
            ->whereNull('c.id')
            ->select('news.id')
            ->distinct()
            ->get();

        foreach ($uncategorizedNews as $news) {
            \App\Models\CountriesCategoriesNews::create([
                'country_id' => $request->country_id,
                'category_id' => 24, // ID untuk "Uncategorized"
                'news_id' => $news->id,
                'status' => 'active',
            ]);
        }

        return redirect()->route('news-master.uncategorized')->with('success', 'All uncategorized news have been assigned.');
    }


    public function updateStatus(Request $request)
    {
        $request->validate([
            // 'news_id' => 'required|exists:plans,id',
            'new_status' => 'required|in:draft,published',
        ]);

        $news = News::findOrFail($request->news_id);
        $news->status = $request->new_status;
        // $news->modified_by_id = Auth::id() ?? 1;
        $news->save();

        return redirect()->back()->with('success', 'News status updated.');
    }
}
