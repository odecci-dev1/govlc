<?php

namespace App\Http\Livewire\Reports\DeclinedApplications;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class DeclinedApplications extends Component
{
    public $keyword = '';
    public $paginate = [];
    public $paginationPaging = [];

    public $data = [];

    
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

        $inputs = [
                        'page' => $this->paginate['page'],
                        'pageSize' => $this->paginate['pageSize'],
                        'FilterName' => $this->keyword,
                        'status' => '',
                        'module' => $this->paginate['module'],
                  ];

        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Pagination/DisplayListPaginate', $inputs);                 
        $this->data = $data->json()['items'];  
        //dd($data->json());          
        if( $data->json()['totalPage'] ){
            $this->paginationPaging['totalPage'] = $data->json()['totalPage'];
            $this->paginationPaging['totalRecord'] = $data->json()['totalRecord'];
            $this->paginationPaging['currentPage'] = $data->json()['currentPage'];
            $this->paginationPaging['nextPage'] = $data->json()['nextPage'] < $data->json()['totalPage'] ?  $data->json()['nextPage'] : $data->json()['totalPage'];
            $this->paginationPaging['prevPage'] = $data->json()['prevPage'] > 0 ? $data->json()['prevPage'] : 1;
        }
        
        return view('livewire.reports.declined-applications.declined-applications');
    }
}
