<?php

namespace App\Http\Controllers\Back\Country;

use App\Models\Country;
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
        return view('back.countries.edit', compact('country'));
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
        ]);

        $country->update($request->all());
        return redirect()->route('country.index')->with('success', 'Country updated successfully.');
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
