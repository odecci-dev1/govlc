<?php

namespace App\Http\Livewire\Maintenance\LoanTypes;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class LoanTypesList extends Component
{

    public $keyword = '';

    public function render()
    {
        $pageattr = [ 'Loantypename' => $this->keyword, 'page' => 1, 'pageSize' => '20'];
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/LoanTypeDetailsFilterPaginate', $pageattr);  
        $list = $data->json();
        return view('livewire.maintenance.loan-types.loan-types-list', ['list' => $list]);
    }
}
