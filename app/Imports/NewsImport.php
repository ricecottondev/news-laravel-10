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
            'title'       => $row['title'],
            'content'     => $row['content'],
            'category'    => $row['category'],
            'published_at' => $row['published_at'],
        ]);
    }
}
