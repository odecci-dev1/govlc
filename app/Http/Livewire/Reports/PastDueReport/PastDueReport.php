<?php

namespace App\Http\Livewire\Reports\PastDueReport;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PastDueExport;
use App\Models\Application;
use App\Models\Area;
use App\Models\LoanHistory;
use App\Models\Members;

class PastDueReport extends Component
{

    public $datestart;
    public $dateend;
    public $member;
    public $data;
    public $keyword = '';
    public $paginate = [];
    public $paginationPaging = [];
    public $newappmodelkeyword = '';
    public $sample = []; 
    public $selectArea='All'; 
    public function mount()
    {
        $this->dateend = date('Y-m-d');      
        $this->datestart = date('Y-m-d', strtotime("-1 month"));
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 15;
    }

    public function setMember($fullname = '')
    {
        $this->member = $fullname;
    }

    public function exportReport()
    {
        $data = $this->getMembers(false, false);
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
        return Excel::download(new PastDueExport( $exportData ), 'Past_Due_Report_'. $this->datestart . '_' . 'to' . '_' . $this->dateend .'.xlsx');
    }

    public function print()
    {
        $data = $this->getMembers(false, false);

        $printhtml = view('livewire.reports.past-due-report.past-due-report-print', [
            'data' => $data,
            'datestart' => $this->datestart,
            'dateend' => $this->dateend,
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
        $this->data = $this->getMembers();
        return view('livewire.reports.past-due-report.past-due-report');
    }

    private function getMembers($paginate = true, $includeInactive = true)
    {
        if($this->selectArea =='All'){
            $members = LoanHistory::with(['member', 'collectionareamember'])
              ->whereHas('member', function ($query) {
                    $query->where('Fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('Lname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('MemId', 'like', '%' . $this->keyword . '%');
            })
            //->whereBetween('DateCreated', [$this->datestart, $this->dateend])
            ->whereNotNull('Penalty')
            ->get();
        }
        else{
            $members = LoanHistory::with(['member', 'collectionareamember'])
              
            ->whereHas('member', function ($query) {
                $getAreas = Area::where('Id',$this->selectArea)->first();
                $areas = explode('|', $getAreas->City);
                $city=[];
                $barangay=[];
                foreach ($areas as $area) {
                    $loc =  explode(',',$area);
                    $barangay []= trim($loc[0],' ');
                    $city []= trim($loc[1],' ');
                }
                $query->whereIn('Barangay',$barangay)->whereIn('City',$city)->
                    where('Fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('Lname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('MemId', 'like', '%' . $this->keyword . '%');
            })
            //->whereBetween('DateCreated', [$this->datestart, $this->dateend])
            ->whereNotNull('Penalty')
            ->get();
        }
    


        if ($paginate) {
            $totalItems = $members->count();
    
            $this->paginationPaging['totalPage'] = ceil($members->count() / $this->paginate['pageSize']);
            $this->paginationPaging['totalRecord'] = $totalItems;
            $this->paginationPaging['currentPage'] = $this->paginate['page'];
            $this->paginationPaging['nextPage'] = $this->paginate['page'] < $this->paginationPaging['totalPage'] ? $this->paginate['page'] + 1 : $this->paginationPaging['totalPage'];
            $this->paginationPaging['prevPage'] = $this->paginate['page'] > 1 ? $this->paginate['page'] - 1 : 1;
    
            $startItem = ($this->paginate['page'] - 1) * $this->paginate['pageSize'] + 1;
            $endItem = min($this->paginate['page'] * $this->paginate['pageSize'], $totalItems);
    
            $this->paginationPaging['startItem'] = $startItem;
            $this->paginationPaging['endItem'] = $endItem;
    
            $paginatedMembers = $members->slice(($this->paginate['page'] - 1) * $this->paginate['pageSize'], $this->paginate['pageSize']);
    
            return $paginatedMembers;
        }

        return $members;
    }
}
