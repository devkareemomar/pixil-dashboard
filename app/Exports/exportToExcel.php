<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class exportToExcel implements FromCollection, WithHeadings, WithStyles {

    protected $data;
    protected $header;

    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    public function collection()
    {
        return $this->data;
    }
    public function headings(): array
    {
        return $this->header;
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->setRightToLeft(true);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
            'enclosure' => '"',
        ];
    }
}
