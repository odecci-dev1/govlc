<?php

namespace App\Http\Livewire\Maintenance\LoanTypes;

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
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/DeleteLoanType', [ 'loanTypeID' => $loantypeID ]);                     
        return redirect()->to('/maintenance/loantypes/list')->with('mmessage', 'Loan type has been trashed');    
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
        // $pageattr = [ 'Loantypename' => $this->keyword, 'page' => 1, 'pageSize' => '10000'];
        // $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/LoanTypeDetailsFilterPaginate', $pageattr);             
        // $list = $data->json();
        //dd( $list );

        $inputs = [
            'page' => $this->paginate['page'],
            'pageSize' => $this->paginate['pageSize'],
            'FilterName' => $this->keyword,
            'status' => 'Active',
            'module' => 'LoanType',
          ];

        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Pagination/DisplayListPaginate', $inputs);                      
        $list = $data->json()['items'];  
     
        if( $data->json()['totalPage'] ){
            $this->paginationPaging['totalPage'] = $data->json()['totalPage'];
            $this->paginationPaging['totalRecord'] = $data->json()['totalRecord'];
            $this->paginationPaging['currentPage'] = $data->json()['currentPage'];
            $this->paginationPaging['nextPage'] = $data->json()['nextPage'] < $data->json()['totalPage'] ?  $data->json()['nextPage'] : $data->json()['totalPage'];
            $this->paginationPaging['prevPage'] = $data->json()['prevPage'] > 0 ? $data->json()['prevPage'] : 1;
        }
     
        return view('livewire.maintenance.loan-types.loan-types-list', ['list' => $list]);
    }
}
