<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CollectedExport implements FromCollection, WithHeadings
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
                'AREA' => $dt['area'],
                'FIELD OFFICER' => $dt['fieldOffice'],
                'TOTAL COLLECTIONS' => $dt['totalCollections'],
                'TOTAL SAVINGS' => $dt['totalSavings'],
                'TOTAL LAPSES' => $dt['totalLapses'],
                'TOTAL ADVANCES' => $dt['totalAdvances'],
                'CASH REMITTED' => $dt['cashRemitted'],
                'TOTAL NP' => $dt['totalNP'],
            ];
        });
    }

    public function headings(): array
    {
        return ["AREA", "FIELD OFFICER", "TOTAL COLLECTIONS", "TOTAL SAVINGS", "TOTAL LAPSES", "TOTAL ADVANCES", "CASH REMITTED", "TOTAL NP"];
    }
}
