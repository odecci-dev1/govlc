<?php

namespace App\Http\Livewire\Transactions\Application;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CreditInvestigationApplicationList extends Component
{
    public $keyword = '';

    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Credit/CreditFilterFullname', ['fullname' => $this->keyword]);  
        $list = $data->json();           
        return view('livewire.transactions.application.credit-investigation-application-list', ['list' => $list]);
    }
}
