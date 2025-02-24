<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Field;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubProduct;
use Illuminate\Support\Facades\DB;

class Front_LandingController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::where('parent_id', '=', null)
            ->where('status', '=', 'active')
            ->get();

        $product_count = DB::table('sub_products')->count();

        //dd("landing");

        return view('front.landing', compact('categories', 'product_count'));
    }

    public function searchResults(Request $request)
    {
        $title = "Search Page";
        $query = $request->input('query');
        $keywords = explode(' ', $query);

        // Dapatkan parameter filter
        $brands = $request->input('brands', []);
        $fields_search = $request->input('fields', []);
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        //dump($fields_search);

        // ================================================================== Brand Query =============================================================
        $BrandsQuery = SubProduct::with('product.brand')
            ->join('products', 'products.id', '=', 'sub_products.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->select('brands.*');

        $this->applyKeywordFilters($BrandsQuery, $keywords);

        // ================================================================== Field Query =============================================================
        $FieldsQuery = SubProduct::with('product', 'product.brand', 'product.category', 'product.category.fields')
            ->join('products', 'products.id', '=', 'sub_products.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('fields', 'categories.id', '=', 'fields.category_id')
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->select('fields.*')
            ->distinct();

        $this->applyKeywordFilters($FieldsQuery, $keywords);

        $fields = $FieldsQuery->get();
        foreach ($fields as $field) {
            $FieldsValueQuery = SubProduct::with('product')
                ->join('products', 'products.id', '=', 'sub_products.product_id')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('fields', 'categories.id', '=', 'fields.category_id')
                ->join('field_products', 'field_products.field_id', '=', 'fields.id')
                ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
                ->where('fields.id', '=', $field->id)
                ->whereColumn('field_products.sub_product_id', 'sub_products.id')
                ->whereColumn('field_products.field_id', 'fields.id')
                ->select(
                    // 'sub_products.*',
                    // 'brands.name as brand_name', 'field_products.*',
                    // DB::raw('sub_products.id'),
                    // DB::raw('MIN(brands.name) as brand_name'),
                    'field_products.value as value'
                )
                ->distinct()
                // ->groupBy('sub_products.id')
                ->groupBy('field_products.value')

                ->orderBy('value', 'DESC');

            $this->applyKeywordFilters($FieldsValueQuery, $keywords);

            foreach ($fields_search as $fieldId => $fieldValue) {
                if ($fieldValue <> "Select Value") {
                    $FieldsValueQuery
                        // ->join('categories', 'categories.id', '=', 'products.category_id')
                        // ->join('fields', 'categories.id', '=', 'fields.category_id')
                        // ->join('field_products', 'field_products.field_id', '=', 'fields.id')
                        ->whereHas('fieldProducts', function ($query) use ($fieldId, $fieldValue) {
                            $query->where('field_id', $fieldId)->where('value', '=', $fieldValue);
                        });
                }
            }

            $field->value = $FieldsValueQuery->get();
        }

        // $sql = $FieldsValueQuery->toSql();
        // $bindings = $FieldsValueQuery->getBindings();

        // dump(vsprintf(str_replace('?', '%s', $sql), array_map(function ($binding) {
        //     return is_numeric($binding) ? $binding : "'" . $binding . "'";
        // }, $bindings)));

        // dump($fields);

        // ================================================================== SubProduct Query =============================================================
        $subProductsQuery = SubProduct::with('product.brand')
            ->join('products', 'products.id', '=', 'sub_products.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->select('sub_products.*', 'brands.name as brand_name')
            ->distinct();

        $this->applyKeywordFilters($subProductsQuery, $keywords);

        // Filter berdasarkan brand
        if (!empty($brands)) {
            $subProductsQuery->whereIn('brands.name', $brands);
        }

        // Filter berdasarkan field
        // if (!empty($fields_search)) {
        //     dd("ck1");
        //     foreach ($fields_search as $fieldId => $fieldValue) {
        //         if ($fieldValue !== "Open this select menu") {
        //             $subProductsQuery->whereHas('product.fieldProducts', function ($query) use ($fieldId, $fieldValue) {
        //                 $query->where('field_id', $fieldId)->where('value', 'LIKE', '%' . $fieldValue . '%');
        //             });
        //         }
        //     }
        // }

        foreach ($fields_search as $fieldId => $fieldValue) {
            if ($fieldValue <> "Select Value") {
                $subProductsQuery
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->join('fields', 'categories.id', '=', 'fields.category_id')
                    ->join('field_products', 'field_products.field_id', '=', 'fields.id')
                    ->whereHas('fieldProducts', function ($query) use ($fieldId, $fieldValue) {
                        $query->where('field_id', $fieldId)->where('value', '=', $fieldValue);
                    });
            }
        }

        // Filter berdasarkan harga
        if (!empty($minPrice)) {
            $subProductsQuery->where('sub_products.price', '>=', $minPrice);
        }
        if (!empty($maxPrice)) {
            $subProductsQuery->where('sub_products.price', '<=', $maxPrice);
        }

        $subProducts = $subProductsQuery->get();

        $sql = $subProductsQuery->toSql();
        $bindings = $subProductsQuery->getBindings();

        // dump(vsprintf(str_replace('?', '%s', $sql), array_map(function ($binding) {
        //     return is_numeric($binding) ? $binding : "'" . $binding . "'";
        // }, $bindings)));

        // dump($fields);
        // dump($subProducts);

        $brands = $BrandsQuery->distinct()->get();

        return view('front.landing-search-results', compact('subProducts', 'title', 'brands', 'query', 'fields'));
    }

    private function applyKeywordFilters($query, $keywords)
    {
        foreach ($keywords as $keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->orWhere('brands.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('categories.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('sub_products.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('sku', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('barcode', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('product', function ($query) use ($keyword) {
                        $query->where('product_type', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('fieldProducts', function ($query) use ($keyword) {
                        $query->where('value', 'LIKE', '%' . $keyword . '%');
                    });
            });
        }
    }
}
