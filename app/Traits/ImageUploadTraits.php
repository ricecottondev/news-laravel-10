<?php

namespace App\Traits;

use Illuminate\Support\Str;
use File;

trait ImageUploadTraits
{
    public function uploadImage($request, $inputName, $filename, $path)
    {
        if ($request->hasFile($inputName)) {
            $image = $request->file($inputName);  // Get the file
            $ext = $image->getClientOriginalExtension();  // Get the file extension

            $imageName = $filename . '_' . uniqid() . '.' . $ext;  // Generate the filename

            // Ensure the directory exists
            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0755, true);
            }

            // Move the file to the correct path
            $image->move(public_path($path), $imageName);

            return $imageName;
        }
    }

    public function updateImage($request, $inputName, $filename, $path, $oldfile = null)
    {
        if ($request->hasFile($inputName)) {
            if (File::exists(public_path($path . $oldfile))) {
                File::delete(public_path($path . $oldfile));
            }
            return $this->uploadImage($request, $inputName, $filename, $path);
        }
    }

    public function uploadImageProduct($request, $inputName, $path)
    {
        if ($request->hasFile($inputName)) {
            $image = $request->file($inputName);  // Get the file
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME); // Get the original file name without extension
            $ext = $image->getClientOriginalExtension();  // Get the file extension

            $imageName = $originalName . '.' . $ext;  // Set file name

            // Ensure the directory exists
            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0755, true);
            }

            // Move the file to the correct path
            $image->move(public_path($path), $imageName);

            return $imageName;
        }
    }

    public function updateImageProduct($request, $inputName, $path, $oldfile = null)
    {
        if ($request->hasFile($inputName)) {
            if (File::exists(public_path($path . $oldfile))) {
                File::delete(public_path($path . $oldfile));
            }
            return $this->uploadImageProduct($request, $inputName, $path);
        }
    }

    public function uploadImageAsset($request, $inputName, $path)
    {
        if ($request->hasFile($inputName)) {
            $image = $request->file($inputName);
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = $image->getClientOriginalExtension();

            $renameImageAsset = strtolower(Str::slug($originalName)) . '.' . $ext;

            // Pastikan direktori ada
            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0755, true);
            }

            // Pindahkan file ke path yang benar
            $image->move(public_path($path), $renameImageAsset);

            return [
                'imagename' => $originalName,
                'ext' => $ext,
            ];
        }
    }

    public function updateImageAsset($request, $inputName, $path, $oldfile = null)
    {
        if ($request->hasFile($inputName)) {
            if (File::exists(public_path($path . $oldfile))) {
                File::delete(public_path($path . $oldfile));
            }
            return $this->uploadImageAsset($request, $inputName, $path);
        }
    }

    public function uploadImageConfirmPayment($request, $inputName, $path)
    {
        if ($request->hasFile($inputName)) {
            $image = $request->file($inputName);
            $originalName = $request->nomerorder;
            $ext = $image->getClientOriginalExtension();
            $renameImageAsset = $originalName . '.' . $ext;

            // Pastikan direktori ada
            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0755, true);
            }

            // Pindahkan file ke path yang benar
            $image->move(public_path($path), $renameImageAsset);

            return [
                'imagename' => $originalName,
                'ext' => $ext,
            ];
        }
    }

    public function updateImageConfirmPayment($request, $inputName, $path, $oldfile = null)
    {
        if ($request->hasFile($inputName)) {
            if (File::exists(public_path($path . $oldfile))) {
                File::delete(public_path($path . $oldfile));
            }
            return $this->uploadImageAsset($request, $inputName, $path);
        }
    }

    public function deleteImage($path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }



}
