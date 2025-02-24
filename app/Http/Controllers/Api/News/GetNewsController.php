<?php

namespace App\Http\Controllers\Api\News;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\News;
use DateTime;


use Symfony\Component\HttpFoundation\Response;

class GetNewsController extends Controller
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

    public function index(Request $request)
    {
        $idnews = $request->id;
        $idcategory = $request->category_id;

        $news = [];

        $response =  DB::select('select * from news_category as c');

        if (!empty($idcategory)) {
            $response =  DB::select('select * from news_category as c where id=' . $idcategory);
        }

        #get date minus one day
        $now = new DateTime(); // Create a DateTime object for the current date and time
        $now->modify('-1 day'); // Add one day to the current date and time
        $formattedDate = $now->format('Y-m-d H:i:s');


        for ($m = 0; $m < count($response); $m++) {

            $res = $response[$m];
            // $responsevouchers =  DB::select('select * from onepoint_voucher as m where m.id_merchant = '.$res->id);
            $resnews = DB::table('news')
                ->join('news_category', 'news_category.id', '=', 'news.category_id')
                ->where('news_category.id', '=', $res->id)
                ->where('status', '=', 'published')
                ->select(
                    'news.id',
                    'news.title',
                    'news.short_desc',
                    'news.text',
                    'news.type',
                    'news.image',
                    'news.file',
                    'news.video',
                    'news.quote_text',
                    'news.quote_author',
                    'news.author',
                    'news.slug',
                    'news.status',
                    'news.images_code',
                    'news.order',
                    'news.category_id',
                )
                ->get();

            $res->news = $resnews;
            array_push($news, $res);
        }

        //dd($news);

        return response()->json([
            'success' => true,
            'message' => 'Get News',
            'data' => $news
        ], Response::HTTP_OK);
    }

    public function indexMobile(Request $request)
    {
        $newData = News::select('title', 'short_desc', 'url')->latest()->get();
        return response()->json([
            'success' => true,
            'promo' => $newData,
        ], 200);
    }
}
