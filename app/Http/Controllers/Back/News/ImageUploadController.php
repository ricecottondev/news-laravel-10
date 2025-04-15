<?php

namespace App\Http\Controllers\Back\News;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\News;

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $image = $request->file('image');

        // Generate nama file unik
        $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();

        // Simpan file ke storage/app/public/images/news
        $imagePath = $image->storeAs('images/news', $filename, 'public');
        // $path = $file->store('uploads/news_images', 'public');
        if ($request->filled('news_id')) {
            $news = News::find($request->input('news_id'));

            if ($news) {
                // Hapus gambar lama jika ada
                if ($news->image && Storage::disk('public')->exists($news->image)) {
                    Storage::disk('public')->delete($news->image);
                }

                // Update field image
                $news->image = $imagePath;
                $news->save();
            }
        }

        // Kirimkan respon berupa path dan URL
        return response()->json([
            'success' => true,
            'url' => asset('storage/' . $imagePath),
            'path' => $imagePath,
        ]);
    }
}
