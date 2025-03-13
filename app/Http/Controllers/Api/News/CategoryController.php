<?php

namespace App\Http\Controllers\Api\News;

use App\Models\Category;
use App\Models\CountriesCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CountriesCategoriesNews;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil parameter country_name dari request
        $countryName = $request->input('country_name');

        // Mengambil kategori berdasarkan country_name
        $categories = CountriesCategories::whereHas('country', function ($query) use ($countryName) {
            $query->where('country_name', $countryName);
        })->with('category')->get()->pluck('category.name')->toArray();

        // Mengembalikan response JSON dengan format yang diinginkan
        return response()->json(['categories' => $categories]);
    }

    public function getFullCategory(Request $request)
    {
        // Mengambil parameter country_name dari request
        $countryName = $request->input('country_name');

        // Mengambil kategori berdasarkan country_name
        $categories = CountriesCategories::whereHas('country', function ($query) use ($countryName) {
            $query->where('country_name', $countryName);
        })->with('category')->get()->pluck('category')->toArray();

        // Mengembalikan response JSON dengan format yang diinginkan
        return response()->json(['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function batchstore(Request $request)
    {
        $request->validate([
            'name' => 'required|array', // Pastikan `name` adalah array
            'name.*' => 'required|string|unique:categories,name', // Validasi setiap nama unik
        ]);

        // Mapping data untuk batch insert
        $categoriesData = array_map(function ($name) {
            return [
                'name' => $name,
                'description' => $name, // Isi description dengan name
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $request->name);

        // Batch insert ke database
        Category::insert($categoriesData);

        return response()->json(['message' => 'Categories stored successfully'], 201);
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(null, 204);
    }

    public function categoriesWithNews(Request $request)
{
        // Ambil country_name dari request
        $countryName = $request->input('country_name');

        // Ambil ID negara berdasarkan country_name
        $country = Country::where('country_name', $countryName)->first();

        if (!$country) {
            return response()->json(['message' => 'Country not found'], 404);
        }

        // Ambil kategori yang memiliki news di negara tertentu
        $categories = Category::whereHas('countriesCategoriesNews', function ($query) use ($country) {
            $query->where('country_id', $country->id)
                ->whereHas('news'); // Pastikan ada berita
        })
            ->select('id', 'name', 'description')
            ->get()->pluck('name')->toArray();

        // Kembalikan response dalam format JSON
        return response()->json(['categories' => $categories]);
    }
}
