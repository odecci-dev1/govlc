<?php

namespace App\Http\Livewire\Maintenance\LoanTypes;

use App\Models\LoanType;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;

class LoanTypesList extends Component
{

    use Common;
    public $keyword = '';
    public $usertype;
    public $paginate = [];
    public $paginationPaging = [];

    public function archive($loantypeID){       
        $loantype = LoanType::where('LoanTypeID', $loantypeID)->first();

        $loantype->update([
            'Status' => 2,
            'DateUpdated' => now(),
        ]);

        return redirect()->to('/maintenance/loantypes/list')->with('mmessage', 'Loan type has been trashed!');    
    }

    public function setPage($page = 1){
        $this->paginate['page'] = $page;
    }

    public function mount(){
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 10;
        $this->paginate['FilterName'] = '';        
        $this->paginationPaging['totalPage'] = 0;  
        $this->paginationPaging['totalRecord'] = 0;  
        $this->usertype = session()->get('auth_usertype'); 
    }

    public function render()
    {
        $query = LoanType::with('terms');

        if ($this->keyword) {
            $query->where('LoanTypeName', 'like', '%' . $this->keyword . '%');
        }

        $query->where('Status', 1);

        $totalRecord = $query->count();
        $totalPage = ceil($totalRecord / $this->paginate['pageSize']);
        $currentPage = $this->paginate['page'];
        $nextPage = $currentPage < $totalPage ? $currentPage + 1 : $totalPage;
        $prevPage = $currentPage > 1 ? $currentPage - 1 : 1;

        $list = $query->paginate($this->paginate['pageSize'], ['*'], 'page', $currentPage);

        $this->paginationPaging = [
            'totalPage' => $totalPage,
            'totalRecord' => $totalRecord,
            'currentPage' => $currentPage,
            'nextPage' => $nextPage,
            'prevPage' => $prevPage,
        ];

        return view('livewire.maintenance.loan-types.loan-types-list', ['list' => $list]);
    }
}
