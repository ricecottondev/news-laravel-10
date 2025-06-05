<?php

namespace App\Imports;

use App\Models\News;
use App\Models\CountriesCategoriesNews;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class NewsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        $country_id = Session::get('import_country_id');
        // $category_id = Session::get('import_category_id');

        $title = trim($row['headline'] ?? '');
        // dump($title);
        // Abaikan jika judul kosong
        if (empty($title)) {
            return null;
        }

        // ✅ Cek apakah judul sudah ada
        $existing = News::where('title', $title)->exists();
        if ($existing) {
            dump("existing, abort save");
            return null; // Skip jika sudah ada
        }

        // Konversi tanggal dari Excel ke format datetime Laravel
        $dateString = $row['date'] ?? null;

        // dump($dateString);
        $createdAt = null;
        if (!empty($row['date'])) {
            $rawDate = $row['date'];

            try {
                // Deteksi apakah nilai numerik (serial Excel)
                if (is_numeric($rawDate)) {
                    $createdAt = Carbon::instance(Date::excelToDateTimeObject($rawDate));
                } else {
                    try {
                        $createdAt = Carbon::createFromFormat('Y-m-d', $rawDate)->startOfDay(); // "2025-04-11"
                    } catch (\Exception $e1) {
                        try {
                            $createdAt = Carbon::createFromFormat('j-M-y', $rawDate)->startOfDay(); // "8-Apr-25"
                        } catch (\Exception $e2) {
                            $createdAt = now(); // fallback
                        }
                    }
                }
            } catch (\Exception $e) {
                dd("parsing : false");
                $createdAt = now(); // fallback jika parsing gagal
            }
        } else {
            dd("field date : false");
            $createdAt = now(); // fallback jika tidak ada field date
        }

        // $createdAt = !empty($row['date']) ? Date::excelToDateTimeObject($row['date']) : now();

        //dd($createdAt);
        // dump("already to save");
        $news = new News([
            'title' => $row['headline'],
            'short_desc' => $row['summary'],
            'content' => $row['content'],
            'is_breaking_news' => 0,
            'author' => 'factabot',
            'slug' => Str::slug($row['headline']),
            'status' => 'published',
            'views' => 0,
            'created_at' => $createdAt,
            'color' => $row['color'],
        ]);

        // $news->timestamps = false; // <-- Ini penting
        $news->save();
        dump('news saved');

        // Simpan relasi country & category dengan news
        // CountriesCategoriesNews::create([
        //     'country_id' => $country_id,
        //     'category_id' => $category_id,
        //     'news_id' => $news->id,
        //     'status' => 'active',
        // ]);

        // Proses banyak kategori
        if (!empty($row['category'])) {
            dump($row['category']);
            $categoryNames = explode(';', $row['category']);

            foreach ($categoryNames as $name) {
                $name = trim($name); // hilangkan spasi atau newline

                if (!empty($name)) {
                    dump("not empty name: " . $name);
                    $category = Category::where('name', $name)->first();

                    if ($category) {
                        dump("category found: " . $category->name);
                        CountriesCategoriesNews::create([
                            'country_id' => $country_id,
                            'category_id' => $category->id,
                            'news_id' => $news->id,
                            'status' => 'active',
                        ]);
                    }
                    else {
                        dump("category not found: " . $name);
                        // Jika kategori tidak ditemukan, buat baru
                        // $newCategory = Category::create([
                        //     'name' => $name,
                        //     'slug' => Str::slug($name),
                        //     'status' => 'active',
                        // ]);

                        CountriesCategoriesNews::create([
                            'country_id' => $country_id,
                            'category_id' => 24,
                            'news_id' => $news->id,
                            'status' => 'active',
                        ]);
                    }
                }
                else {
                    dump("empty name, skip");
                }
            }
        }
        else {
            dump("category is empty, skip");
        }

        return $news;
    }
}
