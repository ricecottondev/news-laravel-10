<?php

namespace App\Http\Controllers\Back\News;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::with('category')->get();
        return view('back.news.index', compact('news'));
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
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'slug' => 'required|string|unique:news,slug',
            'status' => 'required|string|in:draft,published',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan gambar ke dalam folder public/images/news
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images/news', 'public');
        }

        // Simpan data ke database
        News::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'content' => $request->content,
            'author' => $request->author,
            'slug' => $request->slug,
            'status' => $request->status,
            'image' => $imagePath, // Simpan path gambar ke database
        ]);

        return redirect()->route('news.index')->with('success', 'News item created successfully.'); }

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
        $categories = Category::all();
        return view('back.news.edit', compact('news', 'categories'));
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
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'slug' => 'required|string|unique:news,slug,' . $news->id,
            'status' => 'required|string|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($news->image) {
                Storage::delete($news->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('news_images', 'public');
            $news->image = $imagePath;
        }

        // Update data lainnya
        $news->update($request->except(['image']));

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
}
