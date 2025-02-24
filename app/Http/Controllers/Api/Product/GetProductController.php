<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GetProductController extends Controller
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

    public function GetProductById(Request $request)
    {
        $id = $request->id;
        $product_models = [];
        $product_models_array = [];


        $product_models_res =  DB::select('select pm.*, pcm.product_collection_name, ptm.product_type_name,
                pfm.product_form_name,
                ppm.product_package_name,
            (select discount_models.discount from discount_models 
            LEFT JOIN discount_cluster_models as dcm on discount_models.discount_cluster_id = dcm.id
            where  (NOW() >= dcm.active_date AND NOW() <= dcm.off_date) and discount_models.product_id = pm.id
						 ) 
						as disc_event,
						(select dcm.nama from discount_models 
            LEFT JOIN discount_cluster_models as dcm on discount_models.discount_cluster_id = dcm.id
            where  (NOW() >= dcm.active_date AND NOW() <= dcm.off_date) and discount_models.product_id = pm.id
						 ) 
						as event_promo
            from product_models as pm
            LEFT JOIN product_collection_models as pcm on pcm.id = pm.product_collection
            LEFT JOIN product_type_models as ptm on ptm.id = pm.product_type
            LEFT JOIN product_form_models as pfm on pfm.id = pm.product_form
            LEFT JOIN product_package_models as ppm on ppm.id = pm.product_package
            where pm.id = 
            ' . $id);



        for ($p = 0; $p < count($product_models_res); $p++) {
            $prdct = $product_models_res[$p];
            $aciditydesc = explode("/", $product_models_res[$p]->product_aciditydesc);
            $bodydesc = explode("/", $product_models_res[$p]->product_bodydesc);
            $prdct->acidity_desc = $aciditydesc[0];
            $prdct->body_desc = $bodydesc[0];

            if (!empty($prdct->fileimages)) {
                $prdct->images = json_decode($product_models_res[$p]->fileimages);
            } else {
                $prdct->images = null;
            }


            if (!empty($prdct->disc_event)) {
                $prdct->product_price_after_disc =   ($prdct->product_price) - (($prdct->product_price) * ($prdct->disc_event) / 100);
            } else {
                $prdct->product_price_after_disc =  $prdct->product_price;
            }

            $prdct->variant = null;

            array_push($product_models_array, $prdct);
        }

        //get variant coffee models
        $product_variant_res =  DB::select('select pvm.product_variant_name,pm.*, pcm.product_collection_name, ptm.product_type_name,
                pfm.product_form_name,
                ppm.product_package_name,
            (select discount_models.discount from discount_models 
            LEFT JOIN discount_cluster_models as dcm on discount_models.discount_cluster_id = dcm.id
            where  (NOW() >= dcm.active_date AND NOW() <= dcm.off_date) and discount_models.product_id = pm.id
						 ) 
						as disc_event,
						(select dcm.nama from discount_models 
            LEFT JOIN discount_cluster_models as dcm on discount_models.discount_cluster_id = dcm.id
            where  (NOW() >= dcm.active_date AND NOW() <= dcm.off_date) and discount_models.product_id = pm.id
						 ) 
						as event_promo
            from product_models as pm
            LEFT JOIN product_collection_models as pcm on pcm.id = pm.product_collection
            LEFT JOIN product_type_models as ptm on ptm.id = pm.product_type
            LEFT JOIN product_form_models as pfm on pfm.id = pm.product_form
            LEFT JOIN product_package_models as ppm on ppm.id = pm.product_package
						LEFT JOIN product_variant_models as pvm on pvm.id = pm.product_variant
						where pm.product_variant = 
            ' . $product_models_array[0]->product_variant);

        $product_models_array[0]->variant = $product_variant_res;
        //dd($product_models_array[0]);


        $product_models = $product_models_array[0];
        $product_models_modal = $product_models_array;
        $data = $product_models_modal;
        return $data;
    }
}