<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GetFormController extends Controller
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


    public function GetFormGroupByVariant(Request $request)
    {
        $id_variant = $request->id_variant;

        $response =  DB::select('select pm.id, pcm.product_collection_name, ptm.product_type_name,
                pfm.product_form_name,
                ppm.product_package_name
            from product_models as pm
            LEFT JOIN product_collection_models as pcm on pcm.id = pm.product_collection
            LEFT JOIN product_type_models as ptm on ptm.id = pm.product_type
            LEFT JOIN product_form_models as pfm on pfm.id = pm.product_form
            LEFT JOIN product_package_models as ppm on ppm.id = pm.product_package
            where pm.product_variant = ' . $id_variant . ' group by pm.product_form');
        $data = $response;
        return $data;
    }

    public function GetFormsGroupByVariant($variant)
    {
        $id_variant = $variant;

        $response =  DB::select('select pm.id,pm.product_variant,pm.product_form, pm.product_collection, pcm.product_collection_name, ptm.product_type_name,
                pfm.product_form_name,
                ppm.product_package_name
            from product_models as pm
            LEFT JOIN product_collection_models as pcm on pcm.id = pm.product_collection
            LEFT JOIN product_type_models as ptm on ptm.id = pm.product_type
            LEFT JOIN product_form_models as pfm on pfm.id = pm.product_form
            LEFT JOIN product_package_models as ppm on ppm.id = pm.product_package
            where pm.product_variant = ' . $id_variant . ' group by pm.product_form');
        $data = $response;
        return $data;
    }
}