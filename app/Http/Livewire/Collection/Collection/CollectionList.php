<?php

namespace App\Http\Livewire\Collection\Collection;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class CollectionList extends Component
{
    public $list;
    public $check = 0;
    public $displayrecent = false;
    public $keyword = '';
    public $paginate = [];
    public $paginationPaging = [];

    public function mount(){
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 25;
        $this->paginate['FilterName'] = '';        
        $this->paginationPaging['totalPage'] = 0;  
        $this->paginationPaging['totalRecord'] = 0;       
        $this->displayrecent = true; 
    }

    public function setToFalse(){
        $this->displayrecent = null;
        // dd('asd');
    }

    public function setPage($page = 1){
        $this->paginate['page'] = $page;
    }

    public function render()
    {
        // $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/Areas');  
        // $data = $data->json();
        // $mlist = collect($data);        
        // $date = date('m/d/Y').' 12:00:00 AM';        
        // if($this->displayrecent){           
        //     $t = strtotime("-7 days");
        //     $get7days = date('m/d/Y', $t);
        //     $this->list = $mlist->filter(function ($item) use ($get7days) {
        //         return (data_get($item, 'dateCreated') > $get7days.' 12:00:00 AM' );
        //     });
        // }
        // else{
        //     $this->list = $mlist;
        // }     
        // $this->check = $this->list->where('dateCreated', $date)->first();   
        
        $date = date('m/d/Y').' 12:00:00 AM';
        
        if( $this->displayrecent ){
            $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/Areas', ['showprev' => 'true']);               
            $this->list =  collect($data->json());  
        }
        else{

        
            $inputs = [
                        'page' => $this->paginate['page'],
                        'pageSize' => $this->paginate['pageSize'],
                        'FilterName' => $this->keyword,
                        'status' => 'Active',
                        'module' => 'Collection',
                    ];

            $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Pagination/DisplayListPaginate', $inputs);                 
        
            $this->list =  collect($data->json()['items']);  
                    
            $this->check = $this->list->where('dateCreated', $date)->first();       

            if( $data->json()['totalPage'] ){
                $this->paginationPaging['totalPage'] = $data->json()['totalPage'];
                $this->paginationPaging['totalRecord'] = $data->json()['totalRecord'];
                $this->paginationPaging['currentPage'] = $data->json()['currentPage'];
                $this->paginationPaging['nextPage'] = $data->json()['nextPage'] < $data->json()['totalPage'] ?  $data->json()['nextPage'] : $data->json()['totalPage'];
                $this->paginationPaging['prevPage'] = $data->json()['prevPage'] > 0 ? $data->json()['prevPage'] : 1;
            }
        }

        return view('livewire.collection.collection.collection-list');
    }
}
