<?php

namespace App\Http\Livewire\Modals;
use Illuminate\Support\Facades\Http;
use App\Http\Livewire\Transactions\Application\CreateApplication;

use Livewire\Component;

class NewApplicationModal extends Component
{
    public $memberlist;
    public $newappmodelkeyword = '';

    public $loantype;
    public $loantypeList;
    public $loantypename = '';

    public function searchExistingMembers($value){
        $this->memberlist = $value;
    }

    public function createIndividualLoan($value, $loanid){
      
        if($value == ''){
            return redirect()->action(
                [CreateApplication::class], ['type' => 'create', 'naID' => '', 'loanTypeID' => $loanid]
            );
        }
        else{
            return redirect()->to('/tranactions/application/create/'.$value);
        }
       
    }

    public function redirectToGroupLoan(){
        return redirect()->to('/tranactions/group/application/create');
    }

    public function mount(){
      
        $getloans = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/LoanTypeDetails');  
        $getloans = $getloans->json(); 
        $loantypeList = collect([]);
        if(count($getloans) > 0){
            foreach($getloans as $getloans){
                $loantypeList[$getloans['loanTypeID']] = ['loanTypeName' => $getloans['loanTypeName'], 'loanTypeID' => $getloans['loanTypeID']];
            }
        }
        $this->loantype = 'LT-01';
        $this->loantypeList = $loantypeList;
        $this->changeLoanType($this->loantype);
        //dd($this->loantypeList);
    }

    public function changeLoanType($loanId){
        if($loanId == 'LT-02'){
            $this->redirectToGroupLoan();
        }
        $this->getLoanTypeName($loanId);
    }

    public function getLoanTypeName($loanId){
        $loantypename = $this->loantypeList->where('loanTypeID', $loanId)->first();
        if($loantypename){
            $this->loantypename = $loantypename['loanTypeName'];
        }
    }

    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/MembershipFilterByFullname', ['fullname' => $this->newappmodelkeyword]);       
        $this->memberlist = $data->json();       
        
        return view('livewire.modals.new-application-modal');
    }
}
