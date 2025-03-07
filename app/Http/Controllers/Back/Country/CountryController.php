<?php

namespace App\Http\Controllers\Back\Country;

use App\Models\Country;
use App\Models\Category;
use App\Models\CountriesCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the countries.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $countries = Country::all();
        return view('back.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new country.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('back.countries.create');
    }

    /**
     * Store a newly created country in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_name' => 'required|string|max:255',
        ]);

        Country::create($request->all());
        return redirect()->route('country.index')->with('success', 'Country created successfully.');
    }

    /**
     * Display the specified country.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\View\View
     */
    public function show(Country $country)
    {
        return view('back.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified country.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\View\View
     */
    public function edit(Country $country)
    {
        $categories = Category::all(); // Ambil semua kategori
        $selectedCategoryIds = CountriesCategories::where('country_id', $country->id)
            ->pluck('category_id')
            ->toArray(); // Ambil ID kategori yang sudah dipilih

        return view('back.countries.edit', compact('country', 'categories', 'selectedCategoryIds'));
    }


    /**
     * Update the specified country in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'country_name' => 'required|string|max:255',
            'category_ids' => 'array', // Bisa kosong jika tidak memilih kategori
        ]);

        // Update country data
        $country->update([
            'country_name' => $request->country_name,
        ]);

        // Sinkronisasi kategori yang dipilih
        $selectedCategories = $request->input('category_ids', []);

        // Hapus kategori lama dan tambahkan yang baru
        CountriesCategories::where('country_id', $country->id)->delete();

        foreach ($selectedCategories as $categoryId) {
            CountriesCategories::create([
                'country_id' => $country->id,
                'category_id' => $categoryId,
                'status' => 1, // Bisa diganti sesuai kebutuhan
            ]);
        }

        return redirect()->route('country.edit', $country->id)->with('success', 'Country updated successfully.');
    }


    /**
     * Remove the specified country from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('country.index')->with('success', 'Country deleted successfully.');
    }
}
