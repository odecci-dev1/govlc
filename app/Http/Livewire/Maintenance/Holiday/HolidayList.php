<?php

namespace App\Http\Livewire\Maintenance\Holiday;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;

class HolidayList extends Component
{
    use Common;
    public $list = [];
    public $usertype;
    public $keyword = '';
    public $paginate = [];
    public $paginationPaging = [];

    public function archive($holid){       
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Holiday/DeleteHoliday', [ 'holidayID' => $holid ]);              
        return redirect()->to('/maintenance/holiday/list')->with(['mmessage'=> 'Holiday has been archived', 'mword'=> 'Success']);    
    }
    
    public function setPage($page = 1){
        $this->paginate['page'] = $page;
    }

    public function mount(){
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 25;
        $this->paginate['FilterName'] = '';        
        $this->paginationPaging['totalPage'] = 0;  
        $this->paginationPaging['totalRecord'] = 0;  
        $this->usertype = session()->get('auth_usertype'); 
    }

    public function render()
    {
        // $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Holiday/HolidayList');  
        // $this->list = $data->json();      

        $inputs = [
            'page' => $this->paginate['page'],
            'pageSize' => $this->paginate['pageSize'],
            'FilterName' => $this->keyword,
            'status' => 'Active',
            'module' => 'Holiday',
          ];

        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Pagination/DisplayListPaginate', $inputs);                 
        $this->list = $data->json()['items'];  
        if( $data->json()['totalPage'] ){
            $this->paginationPaging['totalPage'] = $data->json()['totalPage'];
            $this->paginationPaging['totalRecord'] = $data->json()['totalRecord'];
            $this->paginationPaging['currentPage'] = $data->json()['currentPage'];
            $this->paginationPaging['nextPage'] = $data->json()['nextPage'] < $data->json()['totalPage'] ?  $data->json()['nextPage'] : $data->json()['totalPage'];
            $this->paginationPaging['prevPage'] = $data->json()['prevPage'] > 0 ? $data->json()['prevPage'] : 1;
        }

        return view('livewire.maintenance.holiday.holiday-list');
    }
}
