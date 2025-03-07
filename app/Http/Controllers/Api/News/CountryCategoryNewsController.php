<?php

namespace App\Http\Controllers\Api\News;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Category;
use App\Models\CountriesCategories;
use App\Models\CountriesCategoriesNews;
use App\Http\Controllers\Controller;

class CountryCategoryNewsController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $defaultCountry = 4;
        $defaultCategory = CountriesCategories::where('country_id', $defaultCountry)
            ->pluck('category_id')
            ->first();

        return view('form', compact('countries', 'defaultCountry', 'defaultCategory'));
    }

    public function getCategorieCountry(Request $request)
    {
        $country_id = $request->query('country_id');

        $categories = CountriesCategories::where('country_id', $country_id)
            ->with('category')
            ->get()
            ->pluck('category');

        return response()->json($categories);
    }

    public function SaveDataCountriesCategoriesNews(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'category_id' => 'required|exists:categories,id',
            'news_id' => 'required|integer'
        ]);

        CountriesCategoriesNews::create([
            'country_id' => $request->country_id,
            'category_id' => $request->category_id,
            'news_id' => $request->news_id,
            'status' => 1,
        ]);

        return response()->json(['message' => 'Data saved successfully']);
    }

    public function getSavedDataCountriesCategoriesNews($id)
    {   $news_id = $id;
        $data = CountriesCategoriesNews::with(['country', 'category'])->where("news_id",$news_id)->get();

        return response()->json($data);
    }

    public function deleteDataCountriesCategoriesNews($id)
    {
        $record = CountriesCategoriesNews::find($id);

        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $record->delete();

        return response()->json(['message' => 'Data deleted successfully']);
    }
}



