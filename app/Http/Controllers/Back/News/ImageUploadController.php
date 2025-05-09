<?php

namespace App\Http\Controllers\Back\News;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\News;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class ImageUploadController extends Controller
{
    /**
     * Handle image upload from clipboard or drag-drop.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
{
    // Validasi apakah file gambar tersedia
    if (!$request->hasFile('image')) {
        return response()->json(['error' => 'No image uploaded.'], 400);
    }

    // Validasi file gambar
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    ]);

    $image = $request->file('image');

    // Gunakan Intervention Image v3 (GD driver)
    $manager = new ImageManager(new GdDriver());

    // Resize dan konversi ke WebP
    $resized = $manager->read($image->getPathname())
    ->cover(800, 800);


    // Tambahkan watermark teks
    // Baca watermark image (harus PNG dengan transparansi agar bagus)
    $watermarkPath = public_path('assets/watermark/watermark1_10.png'); // Pastikan file ini ada
    $watermark = $manager->read($watermarkPath); // Atur ukuran watermark

    // Tempelkan watermark di pojok kanan bawah
    $resized->place($watermark);
    $encoded = $resized->toWebp(80);
    // Generate nama file unik dan path
    $filename = Str::uuid() . '.webp';
    $path = 'images/news/' . $filename;

    // Simpan ke storage
    Storage::disk('public')->put($path, $encoded->toString());

    // Update pada record News jika tersedia
    if ($request->filled('news_id')) {
        $news = News::find($request->input('news_id'));

        if ($news) {
            // Hapus gambar lama jika ada
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }

            // Update image path
            $news->image = $path;
            $news->save();
        }
    }

    // Kirim respon ke frontend
    return response()->json([
        'success' => true,
        'url' => asset('storage/' . $path),
        'path' => $path,
    ]);
}

    public function storeBase64(Request $request): JsonResponse
{
    $data = $request->input('image');
    $newsId = $request->input('news_id');

    if (!$data || !preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
        return response()->json(['error' => 'Invalid image data.'], 400);
    }

    $imageData = substr($data, strpos($data, ',') + 1);
    $imageData = base64_decode($imageData);

    if ($imageData === false) {
        return response()->json(['error' => 'Base64 decode failed.'], 400);
    }

    $extension = strtolower($type[1]); // png, jpg, etc.
    if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
        return response()->json(['error' => 'Invalid image type.'], 400);
    }

    $filename = Str::uuid() . '.' . $extension;
    $path = 'images/news/' . $filename;
    Storage::disk('public')->put($path, $imageData);

    if ($newsId) {
        $news = News::find($newsId);
        if ($news) {
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
            $news->image = $path;
            $news->save();
        }
    }

    return response()->json([
        'success' => true,
        'url' => asset('storage/' . $path),
        'path' => $path,
    ]);
}

}
