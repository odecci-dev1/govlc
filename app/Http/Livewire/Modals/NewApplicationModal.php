<?php

namespace App\Http\Livewire\Modals;
use Illuminate\Support\Facades\Http;
use App\Http\Livewire\Transactions\Application\CreateApplication;
use App\Http\Livewire\Transactions\Application\CreateApplicationGroup;

use Livewire\Component;

class NewApplicationModal extends Component
{
    public $memberlist;
    public $newappmodelkeyword = '';

    public $loantype;
    public $loanterms;
    public $loantypeList;
    public $loantypename = '';
    public $termsOfPaymentList = [];

    public function messages(){
        $messages = [];
        $messages['loantype.required'] = 'Please select loan type';
        $messages['loanterms.required'] = 'Please select loan terms';
        return $messages;
    }

    public function searchExistingMembers($value){
        $this->memberlist = $value;
    }

    public function createIndividualLoan($value, $loanid){
      
        $this->validate([ 'loantype' => 'required', 'loanterms' => 'required' ]);
        if(in_array($loanid, ['LT-02'])){
            return redirect()->action(
                [CreateApplicationGroup::class], ['type' => 'create', 'loanTypeID' => $loanid, 'loantermsID' => $this->loanterms, 'loantermsName' => $this->termsOfPaymentList[$this->loanterms]['termsofPayment'] ]
            );
        }
        else{
            if($value == ''){
                return redirect()->action(
                    [CreateApplication::class], ['type' => 'create', 'naID' => '', 'loanTypeID' => $loanid, 'loantermsID' => $this->loanterms, 'loantermsName' => $this->termsOfPaymentList[$this->loanterms]['termsofPayment'] ]
                );
            }
            else{          
                // return redirect()->to('/tranactions/application/create/'.$value);
                return redirect()->action(
                    [CreateApplication::class], ['type' => 'create', 'naID' => $value, 'loanTypeID' => $loanid, 'loantermsID' => $this->loanterms, 'loantermsName' => $this->termsOfPaymentList[$this->loanterms]['termsofPayment'] ]
                );
            }
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
        $this->changeLoanType();
        //dd($this->loantypeList);
    }

    public function changeLoanType(){
        // if($loanId == 'LT-02'){
        //     $this->redirectToGroupLoan();
        // }
        $this->loanterms = '';
        $loanId = $this->loantype;
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
        //dd( $data );
        $this->memberlist = $data->json();  

        $loanterms = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Approval/getTermsListByLoanType', ['loantypeid' => $this->loantype]);                  
        $loanterms = $loanterms->json();
       // dd($loanterms);
        if( $loanterms ){
            $this->termsOfPaymentList = [];
            foreach( $loanterms  as  $loanterms ){
                $this->termsOfPaymentList[$loanterms['topId']] = ['topId' => $loanterms['topId'],'termsofPayment' => $loanterms['termsofPayment'],'loanTypeId' => $loanterms['loanTypeId']];   
            }
        }
        //dd($this->loantype);             
        return view('livewire.modals.new-application-modal');
    }
}
