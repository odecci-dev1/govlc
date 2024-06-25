<?php

namespace App\Http\Livewire\Maintenance\FieldOfficer;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;
use App\Models\TblFieldOfficer;

class FieldOfficerlist extends Component
{

    use Common;
    public $usertype;
    public $list = [];
    public $keyword = '';
    public $paginate = [];
    public $paginationPaging = [];

    public function archive($foid){       
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/DeleteFO', [ 'foid' => $foid ]);                    
        return redirect()->to('/maintenance/fieldofficer/list')->with(['mmessage'=> 'Filed officer has been archived', 'mword'=> 'Success']);    
    }

    
    public function mount(){
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 25;
        $this->paginate['FilterName'] = '';        
        $this->paginationPaging['totalPage'] = 0;  
        $this->paginationPaging['totalRecord'] = 0;  
        $this->usertype = session()->get('auth_usertype'); 
    }

    public function setPage($page = 1){
        $this->paginate['page'] = $page;
    }
    
    public function render()
    { 
        // $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldOfficer/FieldOfficerFilterPaginate', ['fullname' => $this->keyword, 'page' => 1, 'pageSize' => 10000]);  
        // // dd($data);
        // $this->list = $data->json();        
        // //dd($this->list);

        $this->list = TblFieldOfficer::paginate(25);     
        // $inputs = [
        //              'page' => $this->paginate['page'],
        //              'pageSize' => $this->paginate['pageSize'],
        //              'FilterName' => $this->keyword,
        //              'status' => 'Active',
        //              'module' => 'FieldOfficer',
        //           ];
     
        // $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Pagination/DisplayListPaginate', $inputs);                 
        // $this->list = $data->json()['items'];  
        // if( $data->json()['totalPage'] ){
        //     $this->paginationPaging['totalPage'] = $data->json()['totalPage'];
        //     $this->paginationPaging['totalRecord'] = $data->json()['totalRecord'];
        //     $this->paginationPaging['currentPage'] = $data->json()['currentPage'];
        //     $this->paginationPaging['nextPage'] = $data->json()['nextPage'] < $data->json()['totalPage'] ?  $data->json()['nextPage'] : $data->json()['totalPage'];
        //     $this->paginationPaging['prevPage'] = $data->json()['prevPage'] > 0 ? $data->json()['prevPage'] : 1;
        // }


        return view('livewire.maintenance.field-officer.field-officerlist');
    }
}
