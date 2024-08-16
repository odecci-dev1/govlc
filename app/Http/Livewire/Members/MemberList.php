<?php

namespace App\Http\Livewire\Members;

use App\Models\Application;
use App\Models\Members;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class MemberList extends Component
{
    
    public $list = [];
    public $status = '';
    public $loantype = '';
    public $loantypeList;
    public $usertype;
    public $keyword = '';
    public $paginate = [];
    public $paginationPaging = [];


    public function mount(){
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 25;
        $this->paginate['FilterName'] = '';
        $this->status = '';
        $this->paginate['module'] = 'Member';
        $this->paginationPaging['totalPage'] = 0;
        $this->paginationPaging['totalRecord'] = 0;
        $this->usertype = session()->get('auth_usertype'); 
    }

    public function setPage($page = 1){
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
        $this->list = $this->getMembers();       
       
        return view('livewire.members.member-list');
    }

    private function getMembers($paginate = true)
    {
        $members = Members::with(['applications', 'detail', 'loanhistory','fileuploads'])
            ->whereHas('applications', function ($query) {
                $query->where('Status', 7);
            })
            ->where(function ($query) {
                $query->where('Fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('Lname', 'like', '%' . $this->keyword . '%');
            });
  
        if ($this->status !== '') {
            $members->where('Status', $this->status);
        }

        $members = $members->get();
  
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
