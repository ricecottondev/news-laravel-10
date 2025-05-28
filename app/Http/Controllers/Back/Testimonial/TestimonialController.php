<?php

namespace App\Http\Controllers\Back\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('back.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('back.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'message' => 'required|string|max:1000',
            'status' => 'required|in:draft,published',
        ]);

        Testimonial::create($validated);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('back.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'message' => 'required|string|max:1000',
            'status' => 'required|in:draft,published',
        ]);




        $testimonial->update($validated);


        return redirect()->route('testimonials.index')->with('success', 'Testimonial berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial berhasil dihapus.');
    }
}
