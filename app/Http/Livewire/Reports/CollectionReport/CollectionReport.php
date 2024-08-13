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
                'memberName' =>  $d->member->full_name,
                'loanAmount' => !empty($d->LoanAmount) ? number_format($d->LoanAmount, 2) : '0.00',
                'dateReleased' => !empty($d->DateReleased) ? date('Y-m-d', strtotime($d->DateReleased)) : '',
                'dueDate' => !empty($d->DueDate) ? date('Y-m-d', strtotime($d->DueDate)) : '',
                'totalNP' => optional($d->collectionareamember)->CollectedAmount == 0.00 
                                ? '0.00' 
                                : optional($d->collectionareamember)->CollectedAmount,
                'totalPastDueDays' => $d->pastDueDays(),
            ];
        });
        return Excel::download(new CollectedExport( $data ), 'Collection_Report_'. $this->datestart . '_' . 'to' . '_' .  $this->dateend .'.xlsx');
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

        // dd($this->data);
        return view('livewire.reports.collection-report.collection-report', [
            'totals' => $this->totals,
        ]);
    }

    public function getAreas($paginate = true, $includeInactive = true)
    {
        $areas = Area::with(['fieldOfficer', 'collectionAreas.collectionAreaMembers', 'loanhistory'])
            ->whereHas('fieldOfficer', function ($query) {
                $query->where('Fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('Lname', 'like', '%' . $this->keyword . '%');
            })
            ->get();

        foreach ($areas as $area) {
            $totalCollection = $area->collectionAreas->sum(function ($collectionArea) {
                return $collectionArea->collectionAreaMembers->sum('CollectedAmount');
            });
        
            $totalSavings = $area->collectionAreas->sum(function ($collectionArea) {
                return $collectionArea->collectionAreaMembers->sum('Savings');
            });
        
            $totalLapses = $area->collectionAreas->sum(function ($collectionArea) {
                return $collectionArea->collectionAreaMembers->sum('LapsePayment');
            });
        
            $totalAdvances = $area->collectionAreas->sum(function ($collectionArea) {
                return $collectionArea->collectionAreaMembers->sum('AdvancePayment');
            });

            $totalNP = $area->collectionAreas->sum(function ($collectionArea) {
                return $collectionArea->collectionAreaMembers->where('CollectedAmount', 0.00)->count();
            });

            $this->totals[$area->id] = [
                'totalCollection' => $totalCollection,
                'totalSavings' => $totalSavings,
                'totalLapses' => $totalLapses,
                'totalAdvances' => $totalAdvances,
                'totalNP' => $totalNP,
            ];
        }

        dd($this->totals);
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
