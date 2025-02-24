<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GetWeightController extends Controller
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


    public function GetWeightGroupByVariant(Request $request)
    {
        $id_variant = $request->id_variant;
        $id_form = $request->id_form;
        $response =  DB::select('select pm.*, pcm.product_collection_name, ptm.product_type_name,
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
            where pm.product_variant = ' . $id_variant . ' and pm.product_form = ' . $id_form . ' group by pm.product_Weight');
        $data = $response;
        return $data;
    }


    public function GetWeightByVariant(Request $request)
    {
        $id_variant = $request->id_variant;
        $id_form = $request->id_form;
        $id_collection = $request->id_collection;
        $response =  DB::select('select pm.id, pm.product_collection, pm.product_form, pm.product_variant,pm.product_weight,
                pfm.product_form_name
            from product_models as pm
            INNER JOIN product_form_models as pfm on pfm.id = pm.product_form
            where pm.product_variant = ' . $id_variant . ' and pm.product_form = ' . $id_form . ' and pm.product_collection = ' . $id_collection . ' order by pm.product_weight');
        $data = $response;

        return $data;
    }

    public function GetWeightByForm($collection, $variant, $form)
    {
        $id_variant = $variant;
        $id_form = $form;
        $id_collection = $collection;
        //dd("test");
        $response =  DB::select('select pm.id, pm.product_collection, pm.product_form, pm.product_variant,pm.product_weight,
                pfm.product_form_name
            from product_models as pm
            INNER JOIN product_form_models as pfm on pfm.id = pm.product_form
            where pm.product_variant = ' . $id_variant . ' and pm.product_form = ' . $id_form . ' and pm.product_collection = ' . $id_collection . ' order by pm.product_weight');
        $data = $response;

        return $data;
    }
}