<?php

namespace App\Http\Livewire\Transactions\Application;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Common;
use App\Models\Application;
use App\Models\LoanType;
use Carbon\Carbon;

class ApplicationList extends Component
{    
    use Common;
    public $usertype;
    public $keyword = ''; 
    public $loantypeList;
    public $loantype;
    public $loanAmountFrom = 0;
    public $loanAmountTo = 0;

    public function mount(){
        $this->usertype = session()->get('auth_usertype'); 
        $getloans = LoanType::where('Status',1)->get();
       
         
        $loantypeList = collect([]);
        if(count($getloans) > 0){
            foreach($getloans as $getloans){
                $loantypeList[$getloans['Id']] = ['loanTypeName' => $getloans['LoanTypeName'], 'loanTypeID' => $getloans['Id']];
            }
        }
       
        $this->loantypeList = $loantypeList; 
        $this->loantype = '';
    }

    public function archive($naID){        
        Application::where('NAID',$naID)->update([
            'Status' => 2,
            'DeclineDate'=>Carbon::now(),
             'DeclinedBy'=>session()->get('auth_usertype'),
        ]) ;                                           
        return redirect()->to('/tranactions/application/list')->with('mmessage', 'Application has been deleted');  
    }
    
    public function render()
    {
        // $filter = ['loanType' => $this->loantype, 'fullname' => $this->keyword, 'statusid' => [[ 'status' => 7 ]], 'page' => 1, 'pageSize' => 10000,  'from' => ($this->loanAmountFrom == '' ? '0' : strval($this->loanAmountFrom)), 'to' => ($this->loanAmountTo == '' ? '0' : strval($this->loanAmountTo))];
        // $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/GlobalFilter/FilterSearch', $filter);                    
        // $this->list = $data->json();          

        $list = Application::with('member')->with('comaker')->with('detail')->with('loantype')->whereHas('member', function (Builder $query) {
                    $query->where('Fname', 'like', '%'.$this->keyword.'%')->orWhere('Lname', 'like', '%'.$this->keyword.'%')->orWhere('Mname', 'like', '%'.$this->keyword.'%');
                })                
                ->where('Status', 7)->paginate(50);       

        return view('livewire.transactions.application.application-list', ['list' => $list]);
    }
}
