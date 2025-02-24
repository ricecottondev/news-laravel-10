<?php

namespace App\Http\Controllers\Api\Merchandise;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GetMerchandiseController extends Controller
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

    public function getAll(Request $request)
    {
        $merchandise = [];
        $response =  DB::select('select mpm.*, pm.fileimages from merchandise_product_models as mpm 
INNER JOIN product_models as pm ON mpm.id_product = pm.id
where mpm.status = "active" order by mpm.id asc');

        for ($m = 0; $m < count($response); $m++) {
            $prdct = $response[$m];
            if (!empty($prdct->fileimages)) {
                $prdct->images = "../files/product-images/" . (json_decode($response[$m]->fileimages))[0];
                $prdct->img = (json_decode($response[$m]->fileimages))[0];
            } else {
                $prdct->images = '../files/imagenotavailable.jpg';
                $prdct->img = 'imagenotavailable.jpg';
            }

            array_push($merchandise, $prdct);
        }

        // dd($merchandise);
        return $merchandise;
    }

    public function getByFilter(Request $request)
    {

        $response =  DB::select('select * from merchandise_product_models');
        return $response;
    }
}