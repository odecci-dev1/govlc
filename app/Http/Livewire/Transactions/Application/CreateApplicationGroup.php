<?php

namespace App\Http\Livewire\Transactions\Application;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;

class CreateApplicationGroup extends Component
{

    use Common;

    public $test = 'hello';
    public $members = [];
    public $memberlist = [];
    public $groupname;
    public $loandetails;
    public $searchkeyword = '';

    public function messages(){
        $messages = [];
        $messages['groupname.required'] = 'Group name is required';        
        $messages['loandetails.loamamount.required'] = 'Loan amount is required';        
        $messages['loandetails.paymentterms.required'] = 'Payment terms is required';        
        $messages['loandetails.purpose.required'] = 'Loan purpose is required';        
        return $messages;
    }

    public function openAddMember(){              
        $data = $this->validate([
            'groupname' => 'required',  
            'loandetails.loamamount' => 'required', 
            'loandetails.paymentterms' => 'required',                                                    
            'loandetails.purpose' => 'required',                                                    
        ]);    
     
        $this->emit('openAddMemberModal', ['data' => '' , 'title' => 'This is the title', 'message' => 'This is the message']);
    }

    public function sessionGroupName(){
        session()->forget('sessgroupname');
        session()->put('sessgroupname', $this->groupname == '' ? null : $this->groupname);
    }

    public function sessionLoanDetails(){
        session()->forget('sessloandetails');
        session()->put('sessloandetails', $this->loandetails);
    }

    public function store(){

        $data = [
                    "member" => session('memdata'),
                    "groupName"=> $this->groupname,
                    "groupId"=> null
                ];
                       
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Group/SaveGroupList', $data);  
        dd($crt);
    }

    public function mount(){  
        $this->groupname = session('sessgroupname') !==null ? session('sessgroupname') : null;
        $loandetails = session('sessloandetails') !==null ? session('sessloandetails') : null; 
        $this->loandetails['loamamount'] = isset($loandetails['loamamount']) ? $loandetails['loamamount'] : '';
        $this->loandetails['paymentterms'] = isset($loandetails['paymentterms']) ? $loandetails['paymentterms'] : '';
        $this->loandetails['purpose'] = isset($loandetails['purpose']) ? $loandetails['purpose'] : '';
    }

    public function render()
    {     
        // session()->forget('memdata');  
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/MembershipFilterByFullname', ['fullname' => '']);       
        $this->memberlist = $data->json();           
     
        if(session('memdata')){
            foreach(session('memdata') as $memdata){
                $this->members[] = $memdata;
            }
        }       
        return view('livewire.transactions.application.create-application-group');
    }
}
