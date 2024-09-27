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
use Livewire\WithPagination;

class SavingsReport extends Component
{
    use WithPagination;

    public $datestart;
    public $dateend;
    public $member;
    public $memberName;
    public $memberId;
    public $data;
    public $keyword = '';
    public $paginate = [
        'page' => 1,
        'pageSize' => 15
    ];
    public $paginateModal = [];
    public $paginationPaging = [];
    public $paginationPagingModal = [];
    public $totalSavingsAmount = 0; 
    public $runningSavings;
    public $showModal = false;
    public $area;
    public $selectArea='All'; 

    public function mount()
    {
        $this->dateend = date('Y-m-d');      
        $this->datestart = date('Y-m-d', strtotime("-1 months"));
        $this->paginationPaging = [
            'startItem' => 0,
            'endItem' => 0,
            'totalRecord' => 0,
            'totalPage' => 1,
            'currentPage' => 1,
            'nextPage' => 1,
            'prevPage' => 1
        ];

        $this->paginateModal = [
            'pageModal' => 1,
            'pageSizeModal' => 15
        ];

        $this->paginationPagingModal = [
            'startItemModal' => 0,
            'endItemModal' => 0,
            'totalRecordModal' => 0,
            'totalPageModal' => 1,
            'currentPageModal' => 1,
            'nextPageModal' => 1,
            'prevPageModal' => 1
        ];
    }

    public function closeModal()
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
        $area = Area::where('AreaID',$this->selectArea)->first();
        $printhtml = view('livewire.reports.savings-report.savings-report-print', [
            'data' => $data,
            'datestart' => $this->datestart,
            'dateend' => $this->dateend,
            'member' => $this->member,
            'area'=> $this->selectArea == 'All' ? 'All Areas':$area->Area,
            'totalSavings' => $this->totalSavingsAmount,
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
        $this->paginateModal['pageModal'] = $page;
        $this->getRunningSavings();
    }

    public function goToFirstPageModal()
    {
        $this->paginateModal['pageModal'] = 1;
        $this->getRunningSavings();
    }

    public function goToLastPageModal()
    {
        $this->paginateModal['pageModal'] = $this->paginationPagingModal['totalPageModal'];
        $this->getRunningSavings();
    }

    public function toggleRunningSavings($memId)
    {
        $this->memberId = $memId;
        $member = Members::find($memId);
        $this->memberName = $member ? $member->full_name : 'Unknown Member';
        $this->getRunningSavings();
        $this->openModal();
    }

    public function openModal()
    {
        $this->showModal = !$this->showModal;
    }

    public function render()
    {
        $members = $this->getMembers();
        $this->totalSavingsAmount = $this->getTotalSavingsAmount();
        $this->area = Area::where('Status',1)->whereNotNull('Area')->get(); 
        return view('livewire.reports.savings-report.savings-report', [
            'totalSavings' => $this->totalSavingsAmount,
            'members' => $members,
            'runningSavings' => $this->runningSavings,
         
        ]);
    }

    private function getMembers($paginate = true, $includeInactive = true)
    {
        if($this->selectArea == 'All'){
            $membersWithSavings = Members::with(['memberSavings', 'memberArea'])
            ->with('savingsRunning', function ($query) {
                $query->whereBetween('Date', [$this->datestart, $this->dateend]);
            })
            ->when(!$includeInactive, function ($query) {
                $query->where('Status', '!=', 2);
            })
            ->where(function ($query) {
                $query->where('Fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('Lname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('MemId', 'like', '%' . $this->keyword . '%');
            })->whereHas('savingsRunning', function ($query) {
                $query->whereBetween('Date', [$this->datestart, $this->dateend]);
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
        }else{

            $membersWithSavings = Members::with(['memberSavings', 'memberArea'])
            ->with('savingsRunning', function ($query) {
                $query->whereBetween('Date', [$this->datestart, $this->dateend]);
            })
            ->when(!$includeInactive, function ($query) {
                $query->where('Status', '!=', 2);
            })
            ->where(function ($query) {
                $query->where('Fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('Lname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('MemId', 'like', '%' . $this->keyword . '%');
            })->where(function ($query) {
                $getAreas = Area::where('AreaID',$this->selectArea)->first();
                $areas = explode('|', $getAreas->City);
                $city=[];
                $barangay=[];
                foreach ($areas as $area) {
                    $loc =  explode(',',$area);
                    $barangay []= trim($loc[0],' ');
                    $city []= trim($loc[1],' ');
                }
                $query->whereIn('Barangay',$barangay)->whereIn('City',$city);
                
            })->whereHas('savingsRunning', function ($query) {
                $query->whereBetween('Date', [$this->datestart, $this->dateend]);
             })
            ->when($this->member, function ($query) {
                $query->where('MemId', $this->member);  
            })
            ->get();

            $membersWithoutSavings = Members::with(['memberArea'])
            ->when(!$includeInactive, function ($query) {
                $query->where('Status', '!=', 2);
            })->where(function ($query) {
                $getAreas = Area::where('AreaID',$this->selectArea)->first();
                $areas = explode('|', $getAreas->City);
                $city=[];
                $barangay=[];
                foreach ($areas as $area) {
                    $loc =  explode(',',$area);
                    $barangay []= trim($loc[0],' ');
                    $city []= trim($loc[1],' ');
                }
                $query->whereIn('Barangay',$barangay)->whereIn('City',$city);
                
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
        }
       
   
      
       

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

    private function getRunningSavings()
    {
        $data = SavingsRunningBalance::where('MemId', $this->memberId)->get();
        $totalItems = $data->count();

        $this->paginationPagingModal['totalPageModal'] = ceil($totalItems / $this->paginateModal['pageSizeModal']);
        $this->paginationPagingModal['totalRecordModal'] = $totalItems;
        $this->paginationPagingModal['currentPageModal'] = $this->paginateModal['pageModal'];
        $this->paginationPagingModal['nextPageModal'] = $this->paginateModal['pageModal'] < $this->paginationPagingModal['totalPageModal'] ? $this->paginateModal['pageModal'] + 1 : $this->paginationPagingModal['totalPageModal'];
        $this->paginationPagingModal['prevPageModal'] = $this->paginateModal['pageModal'] > 1 ? $this->paginateModal['pageModal'] - 1 : 1;

        $startItemModal = ($this->paginateModal['pageModal'] - 1) * $this->paginateModal['pageSizeModal'] + 1;
        $endItemModal = min($this->paginateModal['pageModal'] * $this->paginateModal['pageSizeModal'], $totalItems);

        $this->paginationPagingModal['startItemModal'] = $startItemModal;
        $this->paginationPagingModal['endItemModal'] = $endItemModal;

        $paginatedData = $data->slice(($this->paginateModal['pageModal'] - 1) * $this->paginateModal['pageSizeModal'], $this->paginateModal['pageSizeModal']);

        $this->runningSavings = $paginatedData;
    }

    private function getTotalSavingsAmount()
    {   if($this->selectArea == 'All'){
        $membersQuery = Members::with('memberSavings')->with('savingsRunning',function($query) {
            $query->whereBetween('Date', [$this->datestart, $this->dateend]);
             })
            ->where(function ($query) {
                $query->where('Fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('Lname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('MemId', 'like', '%' . $this->keyword . '%');
            })
            ->when($this->member, function ($query) {
                $query->where('MemId', $this->member);  
            });

            return $membersQuery->whereHas('savingsRunning', function ($query) {
                $query->whereBetween('Date', [$this->datestart, $this->dateend]);
            })->get()->flatMap(function ($member) {
                return $member->savingsRunning;
            })->sum('Savings');
        }else{
            $membersQuery = Members::with('memberSavings')->with('savingsRunning',function($query) {
                $query->whereBetween('Date', [$this->datestart, $this->dateend]);
                 })
                ->where(function ($query) {
                    $query->where('Fname', 'like', '%' . $this->keyword . '%')
                        ->orWhere('Lname', 'like', '%' . $this->keyword . '%')
                        ->orWhere('MemId', 'like', '%' . $this->keyword . '%');
                })
                ->when($this->member, function ($query) {
                    $query->where('MemId', $this->member);  
                })   ->where(function ($query) {
                    $getAreas = Area::where('AreaID',$this->selectArea)->first();
                    $areas = explode('|', $getAreas->City);
                    $city=[];
                    $barangay=[];
                    foreach ($areas as $area) {
                        $loc =  explode(',',$area);
                        $barangay []= trim($loc[0],' ');
                        $city []= trim($loc[1],' ');
                    }
                    $query->whereIn('Barangay',$barangay)->whereIn('City',$city);
                    
                });
    
                return $membersQuery->whereHas('savingsRunning', function ($query) {
                    $query->whereBetween('Date', [$this->datestart, $this->dateend]);
                })->get()->flatMap(function ($member) {
                    return $member->savingsRunning;
                })->sum('Savings');
        }
     
        
        // ->with('savingsRunning')->get()->flatMap(function ($member) {
         
        //     return $member->savingsRunning;
        // })->sum('Savings');

        
        // return $membersQuery->whereHas('memberSavings', function ($query) {
        //     $query->whereBetween('DateUpdated', [$this->datestart, $this->dateend]);
        // })->with('memberSavings')->get()->flatMap(function ($member) {
        //     return $member->memberSavings;
        // })->sum('TotalSavingsAmount');
    }
}
