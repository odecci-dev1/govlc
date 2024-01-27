<?php

namespace App\Http\Livewire\Members;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class MemberList extends Component
{
    
    public $keyword = '';
    public $list = [];

    public $status = '';
    public $loantype = '';
    public $loantypeList;
    public $usertype;
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
  
    public function render()
    {
        $inputs = [
                    'page' => $this->paginate['page'],
                    'pageSize' => $this->paginate['pageSize'],
                    'FilterName' => $this->keyword,
                    'status' => $this->status,
                    'module' => $this->paginate['module'],
                  ];
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Pagination/DisplayListPaginate', $inputs);                 
        $this->list = $data->json()['items'];  
        //dd($data->json());          
        if( $data->json()['totalPage'] ){
            $this->paginationPaging['totalPage'] = $data->json()['totalPage'];
            $this->paginationPaging['totalRecord'] = $data->json()['totalRecord'];
            $this->paginationPaging['currentPage'] = $data->json()['currentPage'];
            $this->paginationPaging['nextPage'] = $data->json()['nextPage'] < $data->json()['totalPage'] ?  $data->json()['nextPage'] : $data->json()['totalPage'];
            $this->paginationPaging['prevPage'] = $data->json()['prevPage'] > 0 ? $data->json()['prevPage'] : 1;
        }
        
        return view('livewire.members.member-list');
    }
}
