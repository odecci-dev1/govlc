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
        $data = collect([]); 
        $cnt = 0;
        if($this->mdata){
             foreach($this->mdata as $dt){
                 $cnt = $cnt + 1;
                 $data->put($cnt, [ 'Borrower' => $dt['Borrower'], 'LoanAmount' => $dt['LoanAmount'], 'DateReleased' => date('Y-m-d', strtotime($dt['DateReleased'])), 'DueDate' => date('Y-m-d', strtotime($dt['DueDate'])), 'TotalNP' => $dt['TotalNP'], 'TotalPastDueDay' => $dt['TotalPastDueDay'] ]);
             }
        }
        return collect($data);
    }

    public function headings(): array
    {
        return ["MEMBER NAME", "LOAN AMOUNT", "DATE RELEASED", "DUE DATE", "TOTAL NP", "TOTAL PAST DUE DAY(S)"];
    }
}
