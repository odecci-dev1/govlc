<?php

namespace App\Http\Livewire\Maintenance\LoanTypes;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;

class LoanTypesList extends Component
{

    use Common;
    public $keyword = '';

    public function archive($loantypeID){       
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/DeleteLoanType', [ 'loanTypeID' => $loantypeID ]);                     
        return redirect()->to('/maintenance/loantypes/list')->with('mmessage', 'Loan type has been trashed');    
    }

    public function render()
    {
        $pageattr = [ 'Loantypename' => $this->keyword, 'page' => 1, 'pageSize' => '50'];
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/LoanTypeDetailsFilterPaginate', $pageattr);             
        $list = $data->json();

        return view('livewire.maintenance.loan-types.loan-types-list', ['list' => $list]);
    }
}
