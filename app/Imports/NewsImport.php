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

        // Konversi tanggal dari Excel ke format datetime Laravel
        $dateString = $row['date'] ?? null;

        dump($dateString);
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

        $news = new News([
            'title' => $row['title'],
            'short_desc' => $row['short_desc'],
            'content' => $row['content'],
            'is_breaking_news' => 0,
            'author' => 'factabot',
            'slug' => Str::slug($row['title']),
            'status' => 'published',
            'views' => 0,
            'created_at' => $createdAt,
        ]);

        // $news->timestamps = false; // <-- Ini penting
        $news->save();

        // Simpan relasi country & category dengan news
        // CountriesCategoriesNews::create([
        //     'country_id' => $country_id,
        //     'category_id' => $category_id,
        //     'news_id' => $news->id,
        //     'status' => 'active',
        // ]);

        // Proses banyak kategori
        if (!empty($row['category'])) {
            $categoryNames = explode(';', $row['category']);

            foreach ($categoryNames as $name) {
                $name = trim($name); // hilangkan spasi atau newline

                if (!empty($name)) {
                    $category = Category::where('name', $name)->first();

                    if ($category) {
                        CountriesCategoriesNews::create([
                            'country_id' => $country_id,
                            'category_id' => $category->id,
                            'news_id' => $news->id,
                            'status' => 'active',
                        ]);
                    }
                }
            }
        }

        return $news;
    }
}
