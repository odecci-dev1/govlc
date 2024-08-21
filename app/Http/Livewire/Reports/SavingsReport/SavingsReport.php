<?php

namespace App\Http\Livewire\Reports\SavingsReport;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SavingsExport;
use App\Models\Area;
use App\Models\Members;
use App\Models\SavingsRunningBalance;
use Illuminate\Support\Facades\Log;

class SavingsReport extends Component
{
    public $datestart;
    public $dateend;
    public $member;
    public $data;
    public $keyword = '';
    public $paginate = [
        'page' => 1,
        'pageSize' => 15
    ];
    public $paginateModal = [
        'page' => 1,
        'pageSize' => 15
    ];
    public $paginationPaging = [];
    public $paginationPagingModal = [];
    public $totalSavingsAmount = 0; 
    public $runningSavings;
    public $showModal = false;

    public function mount()
    {
        $this->dateend = date('Y-m-d');      
        $this->datestart = date('Y-m-d', strtotime("-1 months"));
    }
    
    public function toggleRunningSavings()
    {
        $this->showModal = !$this->showModal;
    }

    public function setMember($memId  = null)
    {
        $this->member = $memId ;
    }

    public function exportReport()
    {
        $data = $this->getMembers(false, false);
        $exportData = $data->map(function ($member) {
            return [
                'borrower' => "{$member->Fname} {$member->Mname} {$member->Lname}",
                'areaName' => $member->areaName,
                'totalSavings' => $member->memberSavings->sum('TotalSavingsAmount'),
            ];
        });
        return Excel::download(new SavingsExport( $exportData ), 'Savings_Report_'. $this->datestart . '_' . 'to' . '_' .  $this->dateend .'.xlsx');
    }

    public function print()
    {
        $data = $this->getMembers(false, false);

        $printhtml = view('livewire.reports.savings-report.savings-report-print', [
            'data' => $data,
            'datestart' => $this->datestart,
            'dateend' => $this->dateend,
            'member' => $this->member
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
    
    public function setPageModal($page = 1)
    {
        $this->paginateModal['page'] = $page;
    }

    public function goToFirstPageModal()
    {
        $this->paginateModal['page'] = 1;
    }

    public function goToLastPageModal()
    {
        $this->paginateModal['page'] = $this->paginationPagingModal['totalPage'];
    }

    public function render()
    {
        $members = $this->getMembers();
        $this->totalSavingsAmount = $this->getTotalSavingsAmount();
        $this->runningSavings = $this->getRunningSavings();

        return view('livewire.reports.savings-report.savings-report', [
            'totalSavings' => $this->totalSavingsAmount,
            'members' => $members,
        ]);
    }

    
    private function getMembers($paginate = true, $includeInactive = true)
    {
        $membersWithSavings = Members::with(['memberSavings', 'memberArea'])
            ->when(!$includeInactive, function ($query) {
                $query->where('Status', '!=', 2);
            })
            ->where(function ($query) {
                $query->where('Fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('Lname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('MemId', 'like', '%' . $this->keyword . '%');
            })
            ->whereHas('memberSavings', function ($query) {
                $query->whereBetween('DateUpdated', [$this->datestart, $this->dateend]);
            })
            ->when($this->member, function ($query) {
                $query->where('MemId', $this->member);  
            })
            ->get();

        $membersWithoutSavings = Members::with(['memberArea'])
            ->when(!$includeInactive, function ($query) {
                $query->where('Status', '!=', 2);
            })
            ->where(function ($query) {
                $query->where('Fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('Lname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('MemId', 'like', '%' . $this->keyword . '%');
            })
            ->whereDoesntHave('memberSavings')
            ->when($this->member, function ($query) {
                $query->where('MemId', $this->member);  
            })
            ->get();

        $members = $membersWithSavings->concat($membersWithoutSavings)->unique('MemId');

        $areas = Area::all();

        $members->map(function ($member) use ($areas) {
            $memberFullLocation = "{$member->Barangay}, {$member->City}";
            $matchingArea = $areas->first(function (Area $area) use ($memberFullLocation) {
                return in_array($memberFullLocation, $area->city_list);
            });
            $member->areaName = $matchingArea ? $matchingArea->Area : 'N/A';
            return $member;
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

    
    private function getRunningSavings($paginateModal = true)
    {
        $data = SavingsRunningBalance::get();

        if ($paginateModal) {
            $totalItems = $data->count();
    
            $this->paginationPagingModal['totalPage'] = ceil($data->count() / $this->paginateModal['pageSize']);
            $this->paginationPagingModal['totalRecord'] = $totalItems;
            $this->paginationPagingModal['currentPage'] = $this->paginateModal['page'];
            $this->paginationPagingModal['nextPage'] = $this->paginateModal['page'] < $this->paginationPagingModal['totalPage'] ? $this->paginateModal['page'] + 1 : $this->paginationPagingModal['totalPage'];
            $this->paginationPagingModal['prevPage'] = $this->paginateModal['page'] > 1 ? $this->paginateModal['page'] - 1 : 1;
    
            $startItem = ($this->paginateModal['page'] - 1) * $this->paginateModal['pageSize'] + 1;
            $endItem = min($this->paginateModal['page'] * $this->paginateModal['pageSize'], $totalItems);
    
            $this->paginationPagingModal['startItem'] = $startItem;
            $this->paginationPagingModal['endItem'] = $endItem;
    
            $paginatedData = $data->slice(($this->paginateModal['page'] - 1) * $this->paginateModal['pageSize'], $this->paginateModal['pageSize']);
    
            return $paginatedData;
        }

        return $data;
    }

    private function getTotalSavingsAmount()
    {
        $membersQuery = Members::with('memberSavings')
            ->where(function ($query) {
                $query->where('Fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('Lname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('MemId', 'like', '%' . $this->keyword . '%');
            })
            ->when($this->member, function ($query) {
                $query->where('MemId', $this->member);  
            });

        return $membersQuery->whereHas('memberSavings', function ($query) {
            $query->whereBetween('DateUpdated', [$this->datestart, $this->dateend]);
        })->with('memberSavings')->get()->flatMap(function ($member) {
            return $member->memberSavings;
        })->sum('TotalSavingsAmount');
    }
}
