<?php

namespace App\Http\Livewire\Reports\ReleaseReport;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReleaseExport;
use App\Models\Application;
use App\Models\Area;
use App\Models\Members;

class ReleaseReport extends Component
{
    public $datestart;
    public $dateend;
    public $data;
    public $paginate = [];
    public $paginationPaging = [];
    public $totalSavingsAmount = 0; 

    public function mount(){
        $this->dateend = date('Y-m-d');      
        $this->datestart = date('Y-m-d', strtotime("-1 months"));
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 15;
    }

    public function exportReport()
    {
        $data = $this->getMembers(false, false);
        $exportData = $data->map(function ($member) {
            return [ 
                'naid' => $member->NAID,
                'borrower' => $member->member->full_name,
                'co_Borrower' => $member->comaker->Lnam . $member->comaker->full_name,
                'area' => !empty($member->areaName) ? $member->areaName : 'N/A',
                'loanType' => $member->loantype->LoanTypeName,
                'loanAmount' => number_format($member->detail->LoanAmount, 2),
                'advancePayment' => !empty($member->collectionareamember->AdvancePayment) ? number_format($member->collectionareamember->AdvancePayment, 2) : 0.00,
                'terms' => !empty($member->termsofpayments->NameOfTerms) ? $member->termsofpayments->NameOfTerms : 'No terms',
                'dueDate' => !empty($member->loanHistory->DueDate) ? date('Y-m-d', strtotime($member->loanHistory->DueDate)) : 'Empty date',
                'releasingDate' => !empty($member->loanHistory->DateReleased) ? date('Y-m-d', strtotime($member->loanHistory->DateReleased)) : 'Empty date',
            ];
        });
        return Excel::download(new ReleaseExport( $exportData ), 'Release_Report_'. $this->datestart . '_' . 'to' . '_' .  $this->dateend .'.xlsx');
    }

    public function print()
    {
        $data = $this->getMembers(false, false);

        $printhtml = view('livewire.reports.release-report.release-report-print', [
            'members' => $data,
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
        $members = $this->getMembers();

        return view('livewire.reports.release-report.release-report', [
            'members' => $members
        ]);
    }

    private function getMembers($paginate = true, $includeInactive = true)
    {
        $members = Application::with(['member', 'detail', 'loantype', 'loanhistory', 'termsofpayment'])
            ->when(!$includeInactive, function ($query) {
                $query->where('Status', '!=', 2);
            })
            ->whereHas('loanhistory', function ($query) {
                $query->whereBetween('DateCreated', [$this->datestart, $this->dateend]);
            })
            ->get();
        
        $members->map(function ($application) {
            if ($application->member) {
                $application->areaName = $application->member->areaName;
            } else {
                $application->areaName = 'N/A';
            }
        });

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
