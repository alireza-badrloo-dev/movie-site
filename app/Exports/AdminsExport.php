<?php

namespace App\Exports;

use App\Models\AdminModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AdminsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{

    public function collection()
    {
        return AdminModel::select('id', 'name', 'email','mobile', 'admin', 'created_at')->orderBy('name', 'asc')->get();
    }


    public function headings(): array
    {
        return [
            'شناسه',
            'نام و نام خانوادگی',
            'ایمیل',
            'شماره',
            'افزوده شده توسط',
            'تاریخ ایجاد'
        ];
    }


    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1F4E78']]
            ]
        ];
    }
}
