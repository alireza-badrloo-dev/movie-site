<?php

namespace App\Exports;

use App\Models\Movie;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MoviesExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    
    public function collection()
    {
        return Movie::select('id', 'title_fa', 'title_en', 'year', 'imdb_rate', 'type', 'status')->orderBy('title_fa', 'asc')->get();
    }

   
    public function headings(): array
    {
        return [
            'شناسه',
            'عنوان فارسی',
            'عنوان انگلیسی',
            'سال تولید',
            'امتیاز IMDB',
            'نوع',
            'وضعیت'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ 
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => '1F4E78']
                ]
            ]
        ];
    }
}
