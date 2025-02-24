<?php

namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;
use App\Charts\SampleChart;
use Faker\Core\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // $historyorders = DB::select("select YEAR(tanggalorder) as date, MONTH(tanggalorder) as month,sum(itemsubtotal) as jumlah
		// 		from pos_order_models where deleted = 'false' 
		// 	 group by YEAR(tanggalorder), MONTH(tanggalorder) order by tanggalorder asc");
    //  /dd($historyorders);

        $label = [2011,2012,2013,2014,2015,2016,2017];
        $dataset = [5,4,10,6,5,9,8];
        $dataset2 = [6,7,3,5,4,6,10];
        $dataset3 = [2,4,5,6,5,7,8];
        $dataset4 = [8,4,15,6,3,9,6];
        // for ($ho = 0; $ho < count($historyorders); $ho++) { 
        //     array_push($label, $historyorders[$ho]->date);
        //     array_push($dataset, $historyorders[$ho]->jumlah);
        // }

        $chart = new SampleChart;

        $chart->labels($label);
        $chart->dataset('Supresso', 'bar', $dataset)->options([
            'backgroundColor' => "#ff5000",
        ]);
        $chart->dataset('IndracoStore', 'bar', $dataset2)->options([
            'backgroundColor' => "#a9a9a9",
        ]);
        $chart->dataset('Pandan Garden', 'bar', $dataset3)->options([
            'backgroundColor' => "#279259",
        ]);
        $chart->dataset('SDA', 'bar', $dataset4)->options([
            'backgroundColor' => "#ff0000",
        ]);


        $user = Auth::user();

        // if ($user->hasRole('Admin')) {
           
        //     return view('back/dashboard',compact('chart'));
        // } else  if ($user->hasRole('Member')) {
        //     return redirect('/home');
        //     // return redirect('/menu');
        // }

        // return redirect('/login');
        return view('back/dashboard',compact('chart'));
        
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
