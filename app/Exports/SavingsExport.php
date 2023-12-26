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
        $data = collect([]); 
        $cnt = 0;
        if($this->mdata){
             foreach($this->mdata as $dt){
                 $cnt = $cnt + 1;
                 $data->put($cnt, [ 'borrower' => $dt['borrower'], 'areaName' => $dt['areaName'], 'totalSavings' => $dt['totalSavings'] ]);
             }
        }
        return collect($data);
    }

    public function headings(): array
    {
        return ["MEMBER NAME", "AREA", "TOTAL SAVINGS"];
    }
}
