<?php

namespace App\Imports;

use App\Models\News;
use App\Models\CountriesCategoriesNews;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NewsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        $country_id = Session::get('import_country_id');
        // $category_id = Session::get('import_category_id');

        $news = News::create([
            'title' => $row['title'],
            'short_desc' => $row['short_desc'],
            'content' => $row['content'],
            'is_breaking_news' => $row['is_breaking_news'] ?? 0,
            'author' => $row['author'] ?? 'Unknown',
            'slug' =>  $row['slug'],
            'status' => 'published',
            // 'image' => $row['image'] ?? null,
            'views' => $row['views'] ?? 0,
        ]);

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
