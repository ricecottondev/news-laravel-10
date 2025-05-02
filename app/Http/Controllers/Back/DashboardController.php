<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Charts\SampleChart;
use Faker\Core\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Country;
use App\Models\Category;
use App\Models\CountriesCategories;
use App\Models\News;
use App\Models\CountriesCategoriesNews;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        $category = Category::get();


        $paginated = DB::table('news_visits')
            ->select('news_id', DB::raw('COUNT(*) as visit_count'))
            ->groupBy('news_id')
            ->orderByDesc('visit_count')
            ->paginate(10); // Tambahkan pagination di sini

        $newsDetails = \App\Models\News::whereIn('id', $paginated->pluck('news_id'))
            ->get()
            ->keyBy('id');

        $data = DB::table('news_visits')
            ->select('platform', DB::raw('COUNT(*) as visit_count'))
            ->groupBy('platform')
            ->orderByDesc('visit_count')
            ->get();

        $platforms = $data->pluck('platform');
        $counts = $data->pluck('visit_count');

        $paginatedFiltered = DB::table('news_visits')
            ->where('platform', '!=', '0') // filter platform 0
            ->select('news_id', DB::raw('COUNT(*) as visit_count'))
            ->groupBy('news_id')
            ->orderByDesc('visit_count')
            ->paginate(10, ['*'], 'filtered'); // beri nama page lain jika ingin beda dari default

        $newsDetailsFiltered = \App\Models\News::whereIn('id', $paginatedFiltered->pluck('news_id'))
            ->get()
            ->keyBy('id');

        $datanewsdurationFiltered = DB::table('news_visits')
            ->where('platform', '!=', '0') // filter platform 0
            ->whereNotNull('duration_seconds')
            ->select('news_id', DB::raw('COUNT(*) as visit_count'), DB::raw('SUM(duration_seconds) as total_duration'), DB::raw('AVG(duration_seconds) as avg_duration'))
            ->groupBy('news_id')
            ->orderByDesc('total_duration')
            ->paginate(10, ['*'], 'filtered'); // beri nama page lain jika ingin beda dari default

        $newsdurationFiltered = \App\Models\News::whereIn('id', $datanewsdurationFiltered->pluck('news_id'))
            ->get()
            ->keyBy('id');

        // 1. Jumlah pengunjung tiap halaman
        $pageViews = DB::table('page_visits')
            ->select('url', DB::raw('COUNT(*) as total_visits'))
            ->groupBy('url')
            ->orderByDesc('total_visits')
            ->get();

        // 2. Rata-rata dan total durasi per halaman
        $pageDurations = DB::table('page_visits')
            ->select('url', DB::raw('COUNT(*) as visits'), DB::raw('SUM(duration) as total_duration'), DB::raw('AVG(duration) as avg_duration'))
            ->groupBy('url')
            ->orderByDesc('total_duration')
            ->get();

        // 3. Durasi per IP
        $ipDurations = DB::table('page_visits')
            ->select('ip', DB::raw('COUNT(*) as visits'), DB::raw('SUM(duration) as total_duration'), DB::raw('AVG(duration) as avg_duration'))
            ->groupBy('ip')
            ->orderByDesc('total_duration')
            ->get();

        return view('back/dashboard', [
            'topNews' => $paginated,
            'newsDetails' => $newsDetails,
            'platforms' => $platforms,
            'counts' => $counts,
            'filteredTopNews' => $paginatedFiltered,
            'newsDetailsFiltered' => $newsDetailsFiltered,

            'filteredDurationNews' => $datanewsdurationFiltered,
            'newsdurationFiltered' => $newsdurationFiltered,


            'pageViews' => $pageViews,
            'pageDurations' => $pageDurations,
            'ipDurations' => $ipDurations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
