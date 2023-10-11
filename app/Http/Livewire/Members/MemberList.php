<?php

namespace App\Http\Livewire\Members;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class MemberList extends Component
{
    
    public $keyword = '';
    public $list = [];

    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/GlobalFilter/FilterSearch', ['loanType' => 'Individual',  'fullname' => $this->keyword, 'statusid' => [[ 'status' => 14 ]], 'page' => 1, 'pageSize' => 30,  'from' => '0', 'to' => '0']);          
        // dd( $data );
        $this->list = $data->json();  
        return view('livewire.members.member-list');
    }
}
