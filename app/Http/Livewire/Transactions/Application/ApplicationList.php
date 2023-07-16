<?php

namespace App\Http\Livewire\Transactions\Application;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ApplicationList extends Component
{

    public $list = [];

    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Member/MemberList');  
        $this->list = $data->json();
        // foreach($list->json() as $d){
        //     echo $d['fname'] . '<br>';
        // }    
        return view('livewire.transactions.application.application-list');
    }
}
