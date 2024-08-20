<?php

namespace App\Http\Livewire\Transactions\LoanCalculator;

use App\Models\LoanCalculator;
use Livewire\Component;

class LoanCalculatorList extends Component
{
    public $data;
    public $paginate = [];
    public $paginationPaging = [];
    public $openCalculator = false;

    public function mount()
    {
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 15;
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

    public function calculatorToggle()
    {
        $this->openCalculator = !$this->openCalculator;
    }

    public function render()
    {
        $this->data = $this->getData();
        return view('livewire.transactions.loan-calculator.loan-calculatorlist');
    }

    private function getdata($paginate = true, $includeInactive = true)
    {
        $data = LoanCalculator::all();

        if ($paginate) {
            $totalItems = $data->count();
    
            $this->paginationPaging['totalPage'] = ceil($data->count() / $this->paginate['pageSize']);
            $this->paginationPaging['totalRecord'] = $totalItems;
            $this->paginationPaging['currentPage'] = $this->paginate['page'];
            $this->paginationPaging['nextPage'] = $this->paginate['page'] < $this->paginationPaging['totalPage'] ? $this->paginate['page'] + 1 : $this->paginationPaging['totalPage'];
            $this->paginationPaging['prevPage'] = $this->paginate['page'] > 1 ? $this->paginate['page'] - 1 : 1;
    
            $startItem = ($this->paginate['page'] - 1) * $this->paginate['pageSize'] + 1;
            $endItem = min($this->paginate['page'] * $this->paginate['pageSize'], $totalItems);
    
            $this->paginationPaging['startItem'] = $startItem;
            $this->paginationPaging['endItem'] = $endItem;
    
            $paginatedMembers = $data->slice(($this->paginate['page'] - 1) * $this->paginate['pageSize'], $this->paginate['pageSize']);
    
            return $paginatedMembers;
        }

        return $data;
    }
}
