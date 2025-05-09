<?php

namespace App\Http\Controllers\Back\Banner;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use ImageUploadTraits;
    protected $pathImage;

    public function __construct()
    {
        $this->pathImage = 'assets/banner/';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pathimg = $this->pathImage;
        $banner = Banner::all();
        return view('back.banner.index', compact('banner', 'pathimg'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'image_desktop' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_mobile' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'start' => 'required',
            'end' => 'required',
            'status' => 'required',
            'deleted' => 'nullable',

        ]);

        if ($request->hasFile('image_desktop')) {
            $imagePath = $this->uploadImage($request, 'image_desktop', $validate['name'] . '_' . 'desktop', $this->pathImage);
            $validate['image_desktop'] = $imagePath;
        }
        if ($request->hasFile('image_mobile')) {
            $imagePath = $this->uploadImage($request, 'image_mobile', $validate['name'] . '_' . 'mobile', $this->pathImage);
            $validate['image_mobile'] = $imagePath;
        }

        Banner::create($validate);
        return redirect()->route('banner.index')->with('success', 'Banner successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $banner = Banner::find($id);
        $pathimg = $this->pathImage;
        return view('back.banner.edit', compact('banner', 'pathimg'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::find($id);
        $pathimg = $this->pathImage;
        return view('back.banner.edit', compact('banner', 'pathimg'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::find($id);
        $validate = $request->validate([
            'name' => 'required',
            'image_desktop' => 'nullable',
            'image_mobile' => 'nullable',
            'start' => 'required',
            'end' => 'required',
            'status' => 'required',
            'deleted' => 'required',

        ]);

        if ($request->hasFile('image_desktop')) {
            $imagePath = $this->updateImage($request, 'image_desktop', $validate['name'] . '_' . 'desktop', $this->pathImage, $banner->image_desktop);
            $validate['image_desktop'] = $imagePath;
        }
        if ($request->hasFile('image_mobile')) {
            $imagePath = $this->updateImage($request, 'image_mobile', $validate['name'] . '_' . 'mobile', $this->pathImage, $banner->image_mobile);
            $validate['image_mobile'] = $imagePath;
        }

        $banner->update($validate);
        return redirect()->route('banner.index')->with('success', 'Banner successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        $path_desktop = $this->pathImage . $banner->image_desktop;
        $this->deleteImage($path_desktop);
        $path_mobile = $this->pathImage . $banner->image_mobile;
        $this->deleteImage($path_mobile);
        $banner->delete();
        return redirect()->route('banner.index')->with('success', 'Banner successfully deleted.');
    }
}
