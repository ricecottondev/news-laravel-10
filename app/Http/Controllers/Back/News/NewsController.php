<?php

namespace App\Http\Controllers\Back\News;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\CountriesCategories;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NewsImport;
use App\Models\News;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        $categories = Category::all(); // Ambil semua kategori
        // $countriescategoriesnews = $news->countriesCategoriesNews()->get();
        $news = News::with('category')->orderBy('id', 'desc')->get();
        return view('back.news.index', compact('news','countries','categories'));
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

        return redirect()->route('news.index')->with('success', 'News item created successfully.');
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
public function edit(News $news)
{
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
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        if ($validator->fails()) {
            dump($request->title);
            dump($request->short_desc);
            dump($request->content);
            dump($request->author);
            dump($request->status);


            dd("test");
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Buat slug dari title
        $slug = preg_replace('/[&\/\\\()\+\-\?\<\>\@\#\!\$\%\^\*]/', '', $request->title); // Hapus karakter khusus
        $slug = str_replace(' ', '_', $slug); // Ganti spasi dengan "_"

        // Cek jika slug sudah ada di database dan bukan milik berita ini
        $originalSlug = $slug;
        $count = 1;
        while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
            $slug = $originalSlug . '_' . $count;
            $count++;
        }

         // Simpan gambar ke dalam folder public/images/news
         $imagePath = null;
         if ($request->hasFile('image')) {
             $image = $request->file('image');
             $imagePath = $image->store('images/news', 'public');
         }

        // Cek jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($news->image) {
                Storage::delete('public/' . $news->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('images/news', 'public');
            $news->image = $imagePath;
        }

        // Update data lainnya
        $news->update([
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

        return redirect()->route('news.index')->with('success', 'News item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News item deleted successfully.');
    }

    public function importForm()
    {
        return view('back.news.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new NewsImport, $request->file('file'));
            return redirect()->back()->with('success', 'News imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing file: ' . $e->getMessage());
        }
    }
}
