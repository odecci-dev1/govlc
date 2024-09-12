<?php

namespace App\Http\Livewire\Modals;
use Illuminate\Support\Facades\Http;
use App\Http\Livewire\Transactions\Application\CreateApplication;
use App\Http\Livewire\Transactions\Application\CreateApplicationGroup;

use Livewire\Component;
use App\Models\LoanType;
use App\Models\Members;
use App\Models\TermsOfPayment;
class NewApplicationModal extends Component
{
    public $memberlist;
    public $newappmodelkeyword = '';
    public $selectedMemberId = null;
    public $selectedMember = null;

    public $loantype;
    public $loanterms;
    public $loantypeList;
    public $loantypename = '';
    public $termsOfPaymentList = [];

    public function messages()
    {
        $messages = [];
        $messages['loantype.required'] = 'Please select loan type';
        $messages['loanterms.required'] = 'Please select loan terms';
        return $messages;
    }

    public function searchExistingMembers($value)
    {
        $this->memberlist = $value;
    }

    public function selectMember($memid, $loanid, $loanterms)
    {
        if (empty($this->loanterms)) {
            $this->deselectMember();
            $this->validate([ 
                'loanterms' => 'required' 
            ]);
        }
        $this->selectedMemberId = $memid;
        $this->selectedMember = Members::where('MemId', $memid)->first();
        $this->memberlist = collect([$this->selectedMember]);
    }

    public function deselectMember()
    {
        $this->selectedMemberId = null;
        $this->selectedMember = null;
        $this->getmemberList();
    }

    public function createIndividualLoan($value, $loanid)
    {
        if (empty($this->loanterms)) {
            $this->deselectMember();
            $this->validate([ 
                'loanterms' => 'required' 
            ]);
        }

        $this->validate([ 
            'loantype' => 'required', 
            'loanterms' => 'required' 
        ]);

        
        if(in_array($loanid, ['LT-02'])){          
            return redirect()->action(
                [CreateApplicationGroup::class], ['type' => 'create', 'loanTypeID' => $loanid, 'loanTypeName' => $this->loantypeList[$loanid]['loanTypeName'], 'loantermsID' => $this->loanterms, 'loantermsName' => $this->termsOfPaymentList[$this->loanterms]['termsofPayment'] ]
            );
        }
        else{
            if($value == ''){              
                return redirect()->action(
                    [CreateApplication::class], ['type' => 'create', 'naID' => '', 'loanTypeID' => $loanid, 'loanTypeName' => $this->loantypeList[$loanid]['loanTypeName'], 'loantermsID' => $this->loanterms, 'loantermsName' => $this->termsOfPaymentList[$this->loanterms]['termsofPayment'] ]
                );
            }
            else{          
                return redirect()->action(
                    [CreateApplication::class], ['type' => 'create', 'naID' => $value, 'loanTypeID' => $loanid, 'loanTypeName' => $this->loantypeList[$loanid]['loanTypeName'], 'loantermsID' => $this->loanterms, 'loantermsName' => $this->termsOfPaymentList[$this->loanterms]['termsofPayment'] ]
                );
            }
        }
    }

    public function redirectToGroupLoan()
    {
        return redirect()->to('/tranactions/group/application/create');
    }

    public function mount()
    {
        $getloans = LoanType::where('Status',1)->get();
        $loantypeList = collect([]);
        if(count($getloans) > 0){
            foreach($getloans as $getloans){
                $loantypeList[$getloans['Id']] = ['loanTypeName' => $getloans['LoanTypeName'], 'loanTypeID' => $getloans['Id']];
            }
        }
        $this->loantype = 1;
        $this->loantypeList = $loantypeList;
        
        $this->changeLoanType();
        $this->getmemberList();
    }

    public function changeLoanType()
    {
        // if($loanId == 'LT-02'){
        //     $this->redirectToGroupLoan();
        // }
        $this->loanterms = '';
        $loanId = $this->loantype;
        $this->getLoanTypeName($loanId);
        $this->getLoanTerms();
        $this->getmemberList();
    }

    public function changeTerms()
    {
        $this->getmemberList(); 
    }

    public function getLoanTypeName($loanId){
        $loantypename = $this->loantypeList->where('loanTypeID', $loanId)->first();
        if($loantypename){
            $this->loantypename = $loantypename['loanTypeName'];
        }
    }

    public function getLoanTerms()
    {
        $loanterms = TermsOfPayment::where('LoanTypeId',$this->loantype)->get();
 
        if( $loanterms ){
            $this->termsOfPaymentList = [];
            foreach( $loanterms  as  $loanterms ){
                $this->termsOfPaymentList[$loanterms['Id']] = ['topId' => $loanterms['Id'],'termsofPayment' => $loanterms['NameOfTerms'],'loanTypeId' => $loanterms['Id']];   
            }
        }
    }


    public function updatedNewappmodelkeyword()
    {
        $this->getmemberList();
        $this->deselectMember();
    }


    public function getmemberList()
    {
        $this->memberlist = Members::where(function ($query) {
                $query->where('Fname', 'like', '%' . $this->newappmodelkeyword . '%')
                      ->orWhere('Lname', 'like', '%' . $this->newappmodelkeyword . '%')
                      ->orWhere('Mname', 'like', '%' . $this->newappmodelkeyword . '%');
            })
            ->get();
    }


    public function render()
    {       
        return view('livewire.modals.new-application-modal');
    }
}
