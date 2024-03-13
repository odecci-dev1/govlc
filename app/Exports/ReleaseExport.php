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
       $data = collect([]); 
       $cnt = 0;
       if($this->mdata){
            foreach($this->mdata as $dt){
                $cnt = $cnt + 1;
                $data->put($cnt, [ 'naid' => $dt['naid'], 'borrower' => $dt['borrower'], 'co_Borrower' => $dt['co_Borrower'], 'area' => $dt['area'], 'loanType' => $dt['loanType'], 'loanAmount' => $dt['loanAmount'], 'advancePayment' => $dt['advancePayment'], 'terms' => (!empty($dt['termofPayment']) ? $dt['termofPayment'] : ''), 'dueDate' =>  date('Y-m-d', strtotime($dt['dueDate'])), 'releasingDate' =>  date('Y-m-d', strtotime($dt['releasingDate'])) ]);
            }
       }
       return collect($data);
    }

    public function headings(): array
    {
        return ["APPLICATION REFERENCE", "MEMBER NAME", "CO BORROWER", "AREA", "LOAN TYPE", "LOAN AMOUNT", "ADVANCE PAYMENT", "TERMS", "DUE DATE", "DATE RELEASED"];
    }
}
