<?php

namespace App\Http\Livewire\Maintenance\LoanTypes;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;

class LoanTypesList extends Component
{

    use Common;
    public $keyword = '';

    public function render()
    {
        $pageattr = [ 'Loantypename' => $this->keyword, 'page' => 1, 'pageSize' => '50'];
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/LoanTypeDetailsFilterPaginate', $pageattr);       
        //dd( $data);
        $list = $data->json();
       
        return view('livewire.maintenance.loan-types.loan-types-list', ['list' => $list]);
    }
}
