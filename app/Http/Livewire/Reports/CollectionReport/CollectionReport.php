<?php

namespace App\Http\Livewire\Reports\CollectionReport;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CollectedExport;
use App\Models\Area;

class CollectionReport extends Component
{
    public $datestart;
    public $dateend;
    public $res;

    public function mount(){
        $this->dateend = date('Y-m-d');      
        $this->datestart = date('Y-m-d', strtotime("-6 days"));
    }

    
    public function exportCollectionReport(){
        return Excel::download(new CollectedExport( $this->res ), 'Collection_Report_'. $this->datestart . '_' . $this->dateend .'.xlsx');
    }
    
    public function print(){
        $printhtml = view('livewire.reports.collection-report.collection-report-print', [ 'data' => $this->res, 'datestart' => $this->datestart, 'dateend' => $this->dateend ])->render();    
        $this->emit('printReport', ['data' => $printhtml]);
    }

    // public function render()
    // {
    //     $areasQuery = Area::whereNotNull('FOID')->where('Status', 1);
    //     // dd($areasQuery->get());
        
    //     $input = [
    //         'page' => 1,
    //         'pageSize' => 1000,
    //         'datefrom' => $this->datestart,
    //         'dateto' => $this->dateend,
    //      ];
    //     $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Reports/Reports_CollectionList', $input);  
    //     $this->res = collect($data->json());        
    //     return view('livewire.reports.collection-report.collection-report');
    // }

    public function render()
    {
        $areas = Area::with(['collectionAreas.collectionAreaMembers'])
            ->whereNotNull('FOID')
            ->where('Status', 1)
            ->get();

        $this->res = $areas->map(function ($area) {
            return [
                'areaName' => $area->Area,
                'fieldOfficer' => $area->fieldOfficer->full_name,
                'totalCollection' => $area->collectionAreas->sum('collectionAreaMembers.total_collection'),
                'totalSavings' => $area->collectionAreas->sum('collectionAreaMembers.total_savings'),
                'totalLapses' => $area->collectionAreas->sum('collectionAreaMembers.total_lapses'),
                'totalAdvance' => $area->collectionAreas->sum('collectionAreaMembers.total_advance'),
                'cashRemit' => $area->collectionAreas->sum('collectionAreaMembers.cash_remit'),
                'totalNP' => $area->collectionAreas->sum('collectionAreaMembers.total_np'),
            ];
        });

        return view('livewire.reports.collection-report.collection-report', [
            'res' => $this->res,
        ]);
    }
}
