<?php

namespace App\Http\Livewire\Transactions\Application;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ApplicationList extends Component
{

    public $list = [];

    public function render()
    {
        // $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Application/ApplicationList');     
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/GlobalFilter/FilterSearch', ['loanType' => 'Individual',  'fullname' => '', 'status' => 7, 'page' => 1, 'pageSize' => 50,  'from' => '0', 'to' => '0']);          
        // dd($data);
        $this->list = $data->json();   
        dd($this->list); 
        return view('livewire.transactions.application.application-list');
    }
}
