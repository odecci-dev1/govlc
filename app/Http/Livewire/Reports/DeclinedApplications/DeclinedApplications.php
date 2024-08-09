<?php

namespace App\Http\Livewire\Reports\DeclinedApplications;

use App\Models\Application;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class DeclinedApplications extends Component
{
    public $keyword = '';
    public $paginate = [];
    public $paginationPaging = [];

    public $data;

    
    public function setPage($page = 1){
        $this->paginate['page'] = $page;
    }
    
    public function mount(){
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 50;
        $this->paginate['FilterName'] = '';
        $this->paginate['module'] = 'Declined';
        $this->paginationPaging['totalPage'] = 0;
        $this->paginationPaging['totalRecord'] = 0;
    }

    public function render()
    {
        $this->data = $this->getMembers();
        
        return view('livewire.reports.declined-applications.declined-applications');
    }

    private function getMembers($paginate = true)
    {
        $applications = Application::with(['member', 'detail', 'loantype', 'loanhistory'])
            ->where('Status', 11)
            ->get();

        if ($paginate) {
            $totalItems = $applications->count();
    
            $this->paginationPaging['totalPage'] = ceil($applications->count() / $this->paginate['pageSize']);
            $this->paginationPaging['totalRecord'] = $totalItems;
            $this->paginationPaging['currentPage'] = $this->paginate['page'];
            $this->paginationPaging['nextPage'] = $this->paginate['page'] < $this->paginationPaging['totalPage'] ? $this->paginate['page'] + 1 : $this->paginationPaging['totalPage'];
            $this->paginationPaging['prevPage'] = $this->paginate['page'] > 1 ? $this->paginate['page'] - 1 : 1;
    
            $startItem = ($this->paginate['page'] - 1) * $this->paginate['pageSize'] + 1;
            $endItem = min($this->paginate['page'] * $this->paginate['pageSize'], $totalItems);
    
            $this->paginationPaging['startItem'] = $startItem;
            $this->paginationPaging['endItem'] = $endItem;
    
            $paginatedMembers = $applications->slice(($this->paginate['page'] - 1) * $this->paginate['pageSize'], $this->paginate['pageSize']);
    
            return $paginatedMembers;
        }

        return $applications;
    }
}
