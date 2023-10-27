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

    public function mount(){
        $this->usertype = session()->get('auth_usertype'); 
    }

    public function render()
    {
        $getloans = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/LoanTypeDetails');  
        $getloans = $getloans->json();       
        $loantypeList = collect([]);
        if(count($getloans) > 0){
            foreach($getloans as $getloans){
                $loantypeList[$getloans['loanTypeID']] = ['loanTypeName' => $getloans['loanTypeName'], 'loanTypeID' => $getloans['loanTypeID']];
            }
        }       
        $this->loantypeList = $loantypeList; 
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/GlobalFilter/FilterSearch', ['loanType' => 'LT-01',  'fullname' => $this->keyword, 'statusid' => [[ 'status' => 14 ], [ 'status' => 7 ], [ 'status' => 8 ], [ 'status' => 9 ], [ 'status' => 10 ], [ 'status' => 15 ]], 'page' => 1, 'pageSize' => 30,  'from' => '0', 'to' => '0']);                 
        $this->list = $data->json();  
        //dd( $this->list);
        return view('livewire.members.member-list');
    }
}
