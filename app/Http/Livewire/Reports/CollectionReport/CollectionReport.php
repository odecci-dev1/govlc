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
    public $data;
    public $keyword = '';
    public $totals = [];
    public $paginate = [];
    public $paginationPaging = [];

    public function mount()
    {
        $this->dateend = date('Y-m-d');      
        $this->datestart = date('Y-m-d', strtotime("-1 month"));
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 15;
    }
    
    public function exportReport()
    {
        $data = $this->getAreas(false, false);
        $exportData = $data->map(function ($d) {
            return [ 
                'area' =>  $d->Area,
                'fieldOffice' =>  $d->fieldOfficer->full_name,
                'totalCollections' =>  isset($totals[$d->id]['totalCollection']) ? number_format($totals[$d->id]['totalCollection'], 2) : '0.00',
                'totalSavings' =>  isset($totals[$d->id]['totalSavings']) ? number_format($totals[$d->id]['totalSavings'], 2) : '0.00',
                'totalLapses' =>  isset($totals[$d->id]['totalLapses']) ? number_format($totals[$d->id]['totalLapses'], 2) : '0.00',
                'totalAdvances' =>  isset($totals[$d->id]['totalAdvances']) ? number_format($totals[$d->id]['totalAdvances'], 2) : '0.00',
                'cashRemitted' =>  isset($totals[$d->id]['totalCollection']) ? number_format($totals[$d->id]['totalCollection'], 2) : '0.00',
                'totalNP' =>  $totals[$d->id]['totalNP'] ?? '0',
            ];
        });
        return Excel::download(new CollectedExport( $exportData ), 'Collection_Report_'. $this->datestart . '_' . 'to' . '_' .  $this->dateend .'.xlsx');
    }
    
    public function print()
    {
        $data = $this->getAreas(false, false);
        $printhtml = view('livewire.reports.collection-report.collection-report-print', [ 
            'data' => $data, 
            'datestart' => $this->datestart, 
            'dateend' => $this->dateend 
        ])->render();    
        $this->emit('printReport', ['data' => $printhtml]);
    }

    public function setPage($page = 1)
    {
        $this->paginate['page'] = $page;
    }

    public function goToFirstPage()
    {
        $this->paginate['page'] = 1;
    }

    public function goToLastPage()
    {
        $this->paginate['page'] = $this->paginationPaging['totalPage'];
    }

    public function render()
    {
        $this->data = $this->getAreas();

        return view('livewire.reports.collection-report.collection-report', [
            'totals' => $this->totals,
        ]);
    }

    public function getAreas($paginate = true, $includeInactive = true)
    {
        $areas = Area::with(['fieldOfficer', 'loanhistory'])->with( 'collectionAreas.areaMembers',function($query){
                $query->whereBetween('DateCollected',[$this->datestart, $this->dateend]);
            })
            ->whereHas('fieldOfficer', function ($query) {
                $query->where('Fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('Lname', 'like', '%' . $this->keyword . '%');
            })
            ->get();
        
        $grandTotalCollection = 0;
         
        foreach ($areas as $area) {
           
            $totalCollection = $area->collectionAreas->sum(function ($collectionArea) {
              
                return $collectionArea->areaMembers->sum('CollectedAmount');
            });
        
            $totalSavings = $area->collectionAreas->sum(function ($collectionArea) {
                return $collectionArea->areaMembers->sum('Savings');
            });
        
            $totalLapses = $area->collectionAreas->sum(function ($collectionArea) {

                return $collectionArea->areaMembers->sum('LapsePayment') - $collectionArea->areaMembers->sum('UsedAdvancePayment');
            });
        
            $totalAdvances = $area->collectionAreas->sum(function ($collectionArea) {
                $lapse =  $collectionArea->areaMembers->sum('LapsePayment') - $collectionArea->areaMembers->sum('UsedAdvancePayment');
                return $collectionArea->areaMembers->sum('AdvancePayment') - $collectionArea->areaMembers->sum('UsedAdvancePayment') - $lapse;
            });

            $totalNP = $area->collectionAreas->sum(function ($collectionArea) {
                return $collectionArea->areaMembers->where('Payment_Status', 2)->count();
            });

            $this->totals[$area->Id] = [
                'totalCollection' => $totalCollection,
                'totalSavings' => $totalSavings,
                'totalLapses' => $totalLapses,
                'totalAdvances' => $totalAdvances,
                'totalNP' => $totalNP,
            ];

            $grandTotalCollection += $totalCollection;
        }
      
        $this->totals['grandTotalCollection'] = $grandTotalCollection;

        if ($paginate) {
            $totalItems = $areas->count();
    
            $this->paginationPaging['totalPage'] = ceil($areas->count() / $this->paginate['pageSize']);
            $this->paginationPaging['totalRecord'] = $totalItems;
            $this->paginationPaging['currentPage'] = $this->paginate['page'];
            $this->paginationPaging['nextPage'] = $this->paginate['page'] < $this->paginationPaging['totalPage'] ? $this->paginate['page'] + 1 : $this->paginationPaging['totalPage'];
            $this->paginationPaging['prevPage'] = $this->paginate['page'] > 1 ? $this->paginate['page'] - 1 : 1;
    
            $startItem = ($this->paginate['page'] - 1) * $this->paginate['pageSize'] + 1;
            $endItem = min($this->paginate['page'] * $this->paginate['pageSize'], $totalItems);
    
            $this->paginationPaging['startItem'] = $startItem;
            $this->paginationPaging['endItem'] = $endItem;
    
            $paginatedData = $areas->slice(($this->paginate['page'] - 1) * $this->paginate['pageSize'], $this->paginate['pageSize']);
    
            return $paginatedData;
        }

        return $areas;
    }
}
