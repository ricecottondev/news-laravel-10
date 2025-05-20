<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderedTextExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data)->map(function ($item) {
            return [
                'category' => $item['topic'] ?? '',
                'headline' => $item['title'] ?? '',
                'summary'  => $item['summary'] ?? '',
                'content'  => strip_tags($item['sublink'] ?? ''),
                'date'     => $item['date'] ?? '',
                'color'    => 'white',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Category',
            'Headline',
            'Summary',
            'Content',
            'Date',
            'Color',
        ];
    }
}
