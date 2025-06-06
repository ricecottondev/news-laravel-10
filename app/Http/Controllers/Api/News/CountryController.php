<?php

namespace App\Http\Controllers\Api\News;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CountriesCategories;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Country::orderBy('country_name', 'asc')->pluck('country_name')->toArray();

        // Mapping region
        $asiaCountries = ['indonesia', 'malaysia', 'singapore', 'japan', 'india', 'thailand', 'philippines', 'vietnam', 'south korea'];
        $europeCountries = ['united kingdom', 'germany', 'france', 'italy', 'netherlands', 'spain', 'sweden', 'switzerland', 'norway', 'denmark'];


        if ($request->has('country')) {
            $selectedCountry = strtolower($request->input('country'));

            // Mapping negara ke region
            if (in_array($selectedCountry, $asiaCountries)) {
                $selectedCountry = 'asia';
            } elseif (in_array($selectedCountry, $europeCountries)) {
                $selectedCountry = 'europe';
            } elseif ($selectedCountry === 'united states') {
                $selectedCountry = 'usa';
            }

            // Pisahkan negara yang sesuai dengan parameter
            $filtered = array_filter($query, function ($name) use ($selectedCountry) {
                return strtolower($name) === strtolower($selectedCountry);
            });

            // Ambil sisanya (tanpa negara yang dipilih)
            $remaining = array_diff($query, $filtered);

            // Gabungkan hasilnya
            $query = array_merge($filtered, $remaining);
        }

        return response()->json(['countries' => $query]);
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
        $validatedData = $request->validate([
            'country_name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $country = Country::create($validatedData);
        return response()->json($country, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return response()->json($country);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $validatedData = $request->validate([
            'country_name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $country->update($validatedData);
        return response()->json($country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return response()->json(null, 204);
    }

    public function getCategorieCountry(Request $request)
    {

        $country_id = $request->country_id;
        $categories = CountriesCategories::where('country_id', $country_id)
            ->with('category')
            ->get()
            ->pluck('category');

        return response()->json($categories);
    }
}
