<?php

namespace App\Http\Controllers\Admin\AssetImage;

use App\Http\Controllers\Controller;
use App\Models\AssetImage;
use App\Models\Banner;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssetImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use ImageUploadTraits;
    protected $pathImage;

    public function __construct()
    {
        $this->pathImage = 'images/assetImage/';
    }

    public function index()
    {
        $pathimg = $this->pathImage;
        $asset = AssetImage::all();
        // dd($asset);
        return view('back.assetimage.index', compact('asset', 'pathimg'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.assetimage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link_asset' => 'nullable',
            'deleted' => 'nullable',

        ]);

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadImageAsset($request, 'image', $this->pathImage);

            // Update the validation array with the correct file name and link asset
            $renameImage = strtolower(Str::slug($imagePath['imagename']));
            $validate['name'] = $imagePath['imagename'] . '.' . $imagePath['ext'];
            $validate['image'] = $renameImage . '.' . $imagePath['ext'];
            $validate['link_asset'] = asset($this->pathImage . $validate['image']);
        }

        AssetImage::create($validate);
        return redirect()->back()->with('success', 'Asset successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssetImage $assetimage)
    {
        $pathimg = $this->pathImage;
        return view('back.assetimage.edit', compact('assetimage', 'pathimg'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssetImage $assetimage)
    {
        $validate = $request->validate([
            'name' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link_asset' => 'nullable',
            'deleted' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $this->updateImageAsset($request, 'image', $this->pathImage, $assetimage->image);
            $renameImage = strtolower(Str::slug($imagePath['imagename']));

            $validate['name'] = $imagePath['imagename'] . '.' . $imagePath['ext'];
            $validate['image'] = $renameImage . '.' . $imagePath['ext'];
            $validate['link_asset'] = asset($this->pathImage . $validate['image']);
        }

        $assetimage->update($validate);
        return redirect()->back()->with('success', 'Asset successfully Upadated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssetImage $assetimage)
    {
        $path_image = $this->pathImage . $assetimage->image;
        $this->deleteImage($path_image);
        $assetimage->delete();
        return redirect()->back()->with('success', 'Asset successfully Deleted.');
    }
}







