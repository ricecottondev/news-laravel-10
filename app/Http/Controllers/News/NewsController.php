<?php

namespace App\Http\Controllers\News;

use App\Models\Blog_article_model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $product_models = Product_model::latest()->get();

        $news =  DB::select("SELECT * from news");

        return view('news/list-news', compact('news'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd("ayam");
        $this->validate($request, [
            'product' => 'required'
        ]);

        $product_models = Blog_article_category_model::create([
            'id_category_product' => $request->id_category_product,
            'product' => $request->product,
            'description' => $request->description,
            // 'slug' => Str::slug($request->product)
        ]);

        if ($product_models) {
            return redirect()
                ->route('product.index')
                ->with([
                    'success' => 'New post has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog_article_category_models = Blog_article_category_model::find($id);
        return view('blog-article-categorys.show', compact('blog_article_category_models'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_models = Blog_article_category_model::findOrFail($id);
        return view('products.edit', compact('product_models'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product' => 'required'
        ]);

        $product_models = Blog_article_category_model::findOrFail($id);

        $product_models->update([
            'id_category_product' => $request->id_category_product,
            'product' => $request->product,
            'description' => $request->description,
        ]);

        if ($product_models) {
            return redirect()
                ->route('product.index')
                ->with([
                    'success' => 'Post has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem has occured, please try again'
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
