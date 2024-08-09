<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReleaseExport implements FromCollection, WithHeadings
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
                'APPLICATION REFERENCE' => $dt['naid'],
                'MEMBER NAME' => $dt['borrower'],
                'CO BORROWER' => $dt['co_Borrower'],
                'AREA' => $dt['area'],
                'LOAN TYPE' => $dt['loanType'],
                'LOAN AMOUNT' => $dt['loanAmount'],
                'ADVANCE PAYMENT' => $dt['advancePayment'],
                'TERMS' => $dt['terms'],
                'DUE DATE' => $dt['dueDate'],
                'DATE RELEASED' => $dt['releasingDate'],
            ];
        });
    }

    public function headings(): array
    {
        return ["APPLICATION REFERENCE", "MEMBER NAME", "CO BORROWER", "AREA", "LOAN TYPE", "LOAN AMOUNT", "ADVANCE PAYMENT", "TERMS", "DUE DATE", "DATE RELEASED"];
    }
}
