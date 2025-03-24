<?php

namespace App\Imports;

use App\Models\News;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NewsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new News([
            // 'title'       => $row['title'],
            // 'content'     => $row['content'],
            // 'category'    => $row['category'],
            // 'published_at' => $row['published_at'],
            'title' => $row['title'],
            'short_desc' => $row['short_desc'],
            'content' => $row['content'],
            'is_breaking_news' => $row['is_breaking_news'],
            'author' => $row['author'],
            'slug' => $row['slug'],
            'status' => $row['status'],
            'views' => $row['views'],

        ]);
    }
}
