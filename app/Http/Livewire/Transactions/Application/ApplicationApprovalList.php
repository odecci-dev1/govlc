<?php

namespace App\Http\Livewire\Transactions\Application;

use App\Models\Application;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;
use Illuminate\Database\Eloquent\Builder;

class ApplicationApprovalList extends Component
{
    use Common;
    public $keyword = '';    
    public $loantypeList;
    public $loantype;
    public $loanAmountFrom = 0;
    public $loanAmountTo = 0;

    // public function mount(){
      
    //     $getloans = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/LoanTypeDetails');  
    //     $getloans = $getloans->json();       
    //     $loantypeList = collect([]);
    //     if(count($getloans) > 0){
    //         foreach($getloans as $getloans){
    //             $loantypeList[$getloans['loanTypeID']] = ['loanTypeName' => $getloans['loanTypeName'], 'loanTypeID' => $getloans['loanTypeID']];
    //         }
    //     }
       
    //     $this->loantypeList = $loantypeList; 
    //     $this->loantype = '';
    // }
    
    public function render()
    {
        // $filter = ['loanType' => $this->loantype, 'fullname' => $this->keyword, 'statusid' => [[ 'status' => 9 ]], 'page' => 1, 'pageSize' => 10000,  'from' => ($this->loanAmountFrom == '' ? '0' : strval($this->loanAmountFrom)), 'to' => ($this->loanAmountTo == '' ? '0' : strval($this->loanAmountTo))];
        // $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/GlobalFilter/FilterSearch', $filter);   $list = $data->json();           
        // //dd( $filter);
        // $list = $data->json();     
        //dd($list);
        $list = Application::with('member')->with('comaker')->with('detail')->with('loantype')->with('termsofpayment')->whereHas('member', function (Builder $query) {
            $query->where('Fname', 'like', '%'.$this->keyword.'%')->orWhere('Lname', 'like', '%'.$this->keyword.'%')->orWhere('Mname', 'like', '%'.$this->keyword.'%');
        })                
        ->where('Status', 9)->paginate(50);   
        return view('livewire.transactions.application.application-approval-list', ['list' => $list]);
    }
}
