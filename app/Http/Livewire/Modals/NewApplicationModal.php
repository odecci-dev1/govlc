<?php

namespace App\Http\Livewire\Modals;
use Illuminate\Support\Facades\Http;

use Livewire\Component;

class NewApplicationModal extends Component
{
    public $memberlist;
    public $newappmodelkeyword = '';

    public $loantype;

    public function searchExistingMembers($value){
        $this->memberlist = $value;
    }

    public function createIndividualLoan($value){
        return redirect()->to('/tranactions/application/create/'.$value.'/1');
    }

    public function redirectToGroupLoan(){
        return redirect()->to('/tranactions/application/group/create');
    }

    public function mount(){
        $this->loantype = 'Individual Loan';
    }

    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/MembershipFilterByFullname', ['fullname' => $this->newappmodelkeyword]);       
        $this->memberlist = $data->json();       
        
        return view('livewire.modals.new-application-modal');
    }
}
