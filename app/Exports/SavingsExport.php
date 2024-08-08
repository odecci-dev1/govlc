<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SavingsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $mdata;

    function __construct($mdata) {
            $this->mdata = $mdata;
    }

    public function collection()
    {
        return $this->mdata->map(function ($dt) {
            return [
                'MEMBER NAME' => $dt['borrower'],
                'AREA' => $dt['areaName'],
                'TOTAL SAVINGS' => $dt['totalSavings'],
            ];
        });
    }

    public function headings(): array
    {
        return ["MEMBER NAME", "AREA", "TOTAL SAVINGS"];
    }
}
