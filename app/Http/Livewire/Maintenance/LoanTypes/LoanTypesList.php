<?php

namespace App\Http\Livewire\Maintenance\LoanTypes;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;

class LoanTypesList extends Component
{

    use Common;
    public $keyword = '';
    public $usertype;

    public function archive($loantypeID){       
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/DeleteLoanType', [ 'loanTypeID' => $loantypeID ]);                     
        return redirect()->to('/maintenance/loantypes/list')->with('mmessage', 'Loan type has been trashed');    
    }

    public function mount(){
        $this->usertype = session()->get('auth_usertype'); 
    }

    public function render()
    {
        $pageattr = [ 'Loantypename' => $this->keyword, 'page' => 1, 'pageSize' => '10000'];
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/LoanTypeDetailsFilterPaginate', $pageattr);             
        $list = $data->json();
        //dd( $list );
        return view('livewire.maintenance.loan-types.loan-types-list', ['list' => $list]);
    }
}
