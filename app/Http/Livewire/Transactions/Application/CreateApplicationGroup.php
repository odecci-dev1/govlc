<?php

namespace App\Http\Livewire\Transactions\Application;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Request;

use App\Traits\Common;

class CreateApplicationGroup extends Component
{

    use Common;

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
            'loandetails.topId' => 'required',                                                              
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
        //dd(session('sessloandetails') !==null ? session('sessloandetails') : null);
    }

    public function store(){

        $data = [
                    "member" => session('memdata'),
                    "groupName"=> $this->groupname,
                    "groupId"=> "string"
                ];
                       
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Group/SaveGroupList', $data);  
        dd($crt);
    }

    public function mount(Request $request, $groupId = ''){         
        if($groupId != ''){
            session()->put('sessgroupId', $groupId);
            $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Group/FilterByGroupID', ['groupID' => $groupId]);       
            $data = $data->json();          
            if($data){

            }
        }
        else{
            if(session('memdata')){
                foreach(session('memdata') as $memdata){
                    $this->members[] = $memdata;
                }
            }       
          
            $this->groupname = session('sessgroupname') !==null ? session('sessgroupname') : null;
            $loandetails = session('sessloandetails') !==null ? session('sessloandetails') : null; 
            $this->loandetails['loamamount'] = isset($loandetails['loamamount']) ? $loandetails['loamamount'] : '';
            $this->loandetails['paymentterms'] = isset($request->loantermsName) ? $request->loantermsName : (isset($loandetails['paymentterms']) ? $loandetails['paymentterms'] : '');
            $this->loandetails['topId'] = isset($request->loantermsID) ? $request->loantermsID : (isset($loandetails['topId']) ? $loandetails['topId'] : '');
            $this->loandetails['loanTypeID'] = isset($request->loanTypeID) ? $request->loanTypeID : (isset($loandetails['loanTypeID']) ? $loandetails['loanTypeID'] : '');
            $this->loandetails['purpose'] = isset($loandetails['purpose']) ? $loandetails['purpose'] : '';              
        }    
    }

    public function render()
    {     
        // session()->forget('memdata');  
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/MembershipFilterByFullname', ['fullname' => $this->searchkeyword]);       
        //dd( $data );
        $this->memberlist = $data->json();   
        //dd($this->members);        
           
        return view('livewire.transactions.application.create-application-group');
    }
}
