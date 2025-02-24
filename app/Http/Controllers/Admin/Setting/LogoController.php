<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTraits;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Banner;
use File;


class LogoController extends Controller
{
    use ImageUploadTraits;
    protected $pathImage;

    public function __construct()
    {
        $this->pathImage = 'assets/img/logo/';
        $this->pathImageFooter = 'assets/img/';
    }

    public function index()
    {
        $pathimg = $this->pathImage;
        $banner = Banner::all();

        return view('back.setting.index', compact('banner', 'pathimg'));
    }

    public function store(Request $request)
    {
        $inputName = "logo-sda-invert.svg";
        $oldfile ='logo-sda-invert.svg';
        $path = $this->pathImage;
        if ($request->hasFile('image')) {
            $image = $request->file('image');  // Get the file
            $imageName = 'logo-sda-invert.svg';  // Generate the filename

            // Ensure the directory exists
            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0755, true);
            }

            if (File::exists(public_path($path . $oldfile))) {
                File::delete(public_path($path . $oldfile));
            }

            $image->move(public_path($path), $imageName);
        }

        return redirect()->route('logo.index');
    }

    public function logofooter(Request $request)
    {
        $inputName = "corner-solution.png";
        $oldfile ='corner-solution.png';
        $path = $this->pathImageFooter;
        if ($request->hasFile('image_footer')) {
            $image = $request->file('image_footer');  // Get the file
            $imageName = 'corner-solution.png';  // Generate the filename

            // Ensure the directory exists
            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0755, true);
            }

            if (File::exists(public_path($path . $oldfile))) {
                File::delete(public_path($path . $oldfile));
            }

            $image->move(public_path($path), $imageName);
        }

        return redirect()->route('logo.index');
    }

}
