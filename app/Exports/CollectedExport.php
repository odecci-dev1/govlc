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
        $data = collect([]); 
        $cnt = 0;
        if($this->mdata){
                foreach($this->mdata as $dt){
                    $cnt = $cnt + 1;
                    $data->put($cnt, [ 'areaName' => $dt['areaName'], 'fieldOfficer' => $dt['fieldOfficer'], 'totalCollection' => $dt['totalCollection'], 'totalSavings' => $dt['totalSavings'], 'totalLapses' => $dt['totalLapses'], 'totalAdvance' => $dt['totalAdvance'], 'cashRemit' => $dt['cashRemit'], 'totalNP' => (!empty($dt['totalNP']) ? $dt['totalNP'] : '') ]);
                }
        }
        return collect($data);
    }

    public function headings(): array
    {
        return ["AREA", "FIELD OFFICER", "TOTAL COLLECTIONS", "TOTAL SAVINGS", "TOTAL LAPSES", "TOTAL ADVANCES", "CASH REMITTED", "TOTAL NP"];
    }
}
