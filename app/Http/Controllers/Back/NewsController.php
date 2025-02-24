<?php

namespace App\Http\Controllers\News;

use App\Models\News_model;
use App\Models\Product_model;
use App\Models\News_category_model;
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
        $news =  DB::select("SELECT n.id, n.title, c.name, n.created_at from news as n inner join news_category as c on n.category_id = c.id order by n.id desc");

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
        $news_category_models = News_category_model::latest()->get();
        return view('news/add-news', compact('news_category_models'));
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
            'title' => 'required'
        ]);

        $files = '';
        if ($request->hasfile('image')) {

            // foreach ($request->file('filenames') as $file) {
            $file = $request->file('image');
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->move(public_path('files/news-images'), $name);
            $files = $name;
            // }
        }

        $news_models = News_model::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'text' => $request->text,
            'image' => $files
        ]);

        if ($news_models) {
            return redirect()
                ->route('news.index')
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
        $resnews =  DB::select("SELECT n.id, n.title, c.name, n.created_at, n.short_desc, n.text from news as n inner join news_category as c on n.category_id = c.id where n.id=" . $id);
        $news = $resnews[0];
        $Product_model = new Product_model;
        $product_collection = $Product_model->getProduct();

        //dd($product_collection);

        $product_models = [];
        $res_related_produk = DB::select("SELECT a.artikel_group,
        pvm.product_variant_name,pm.*, pcm.product_collection_name, ptm.product_type_name,
                            pfm.product_form_name,
                            ppm.product_package_name,
                        (select discount_models.discount from discount_models 
                        LEFT JOIN discount_cluster_models as dcm on discount_models.discount_cluster_id = dcm.id
                        where  (NOW() >= dcm.active_date AND NOW() <= dcm.off_date) and discount_models.product_id = pm.id and discount_models.product_id = pm.id ORDER BY dcm.created_at DESC LIMIT 1
                                    ) 
                                    as disc_event,
                                    (select dcm.nama from discount_models 
                        LEFT JOIN discount_cluster_models as dcm on discount_models.discount_cluster_id = dcm.id
                        where  (NOW() >= dcm.active_date AND NOW() <= dcm.off_date) and discount_models.product_id = pm.id ORDER BY dcm.created_at DESC LIMIT 1
                                    ) 
                                    as event_promo
                                                                 from artikel_produk as a LEFT JOIN product_models as pm on a.product_id = pm.id  
         LEFT JOIN product_collection_models as pcm on pcm.id = pm.product_collection
                        LEFT JOIN product_type_models as ptm on ptm.id = pm.product_type
                        LEFT JOIN product_form_models as pfm on pfm.id = pm.product_form
                        LEFT JOIN product_package_models as ppm on ppm.id = pm.product_package
                                    LEFT JOIN product_variant_models as pvm on pvm.id = pm.product_variant
        where a.artikel_group = " . $id);

        for ($p = 0; $p < count($res_related_produk); $p++) {
            $prdct = $res_related_produk[$p];
            if (!empty($prdct->fileimages)) {
                $prdct->images = json_decode($res_related_produk[$p]->fileimages);
            } else {
                $prdct->images = null;
            }


            if (!empty($prdct->disc_event)) {
                $prdct->product_price_after_disc =   ($prdct->product_price) - (($prdct->product_price) * ($prdct->disc_event) / 100);
            } else {
                $prdct->product_price_after_disc =  $prdct->product_price;
            }
            array_push($product_models, $prdct);
        }

        //dd($news);
        //$product_models = Blog_article_category_model::findOrFail($id);
        return view('news.edit-news', compact('news', 'product_models', 'product_collection'));
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
            'title' => 'required'
        ]);

        $files = '';
        if ($request->hasfile('image')) {

            // foreach ($request->file('filenames') as $file) {
            $file = $request->file('image');
            $name = time() . rand(1, 100) . '.' . $file->extension();

            $file->move(public_path('files/news-images'), $name);

            $files = $name;
            // }
        }


        $news_models = News_model::findOrFail($id);

        $news_models->update([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'text' => $request->text,
            'image' => $files
        ]);

        if ($news_models) {
            return redirect()
                ->route('news.index')
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
