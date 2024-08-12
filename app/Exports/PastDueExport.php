<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PastDueExport implements FromCollection, WithHeadings
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
                'MEMBER NAME' => $dt['memberName'],
                'LOAN AMOUNT' => $dt['loanAmount'],
                'DATE RELEASED' => $dt['dateReleased'],
                'DUE DATE' => $dt['dueDate'],
                'TOTAL NP' => $dt['totalNP'],
                'TOTAL PAST DUE DAY(S)' => $dt['totalPastDueDays'],
            ];
        });
    }

    public function headings(): array
    {
        return ["MEMBER NAME", "LOAN AMOUNT", "DATE RELEASED", "DUE DATE", "TOTAL NP", "TOTAL PAST DUE DAY(S)"];
    }
}
