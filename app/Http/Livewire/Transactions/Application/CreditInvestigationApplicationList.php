<?php

namespace App\Http\Livewire\Transactions\Application;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CreditInvestigationApplicationList extends Component
{
    public $keyword = '';

    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/GlobalFilter/FilterSearch', ['loanType' => 'Individual',  'fullname' => $this->keyword, 'status' => 8, 'page' => 1, 'pageSize' => 30,  'from' => '0', 'to' => '0']);  
        $list = $data->json();           
        return view('livewire.transactions.application.credit-investigation-application-list', ['list' => $list]);
    }
}
