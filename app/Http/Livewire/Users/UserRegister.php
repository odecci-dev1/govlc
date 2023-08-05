<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class UserRegister extends Component
{

    public $fname;
    public $lname;
    public $mname;
    public $suffix;
    public $username;
    public $password;
    public $cno;
    public $address;
    public $usertype = [];
    public $status;
    public $password_confirmation;
    public $userid;

    public function rules(){                
        $rules = []; 
        $rules['fname'] = 'required';  
        $rules['lname'] = 'required';  
        $rules['mname'] = 'required';  
        $rules['suffix'] = '';  
        $rules['username'] = 'required'; 
        $rules['password'] = ['required', 'confirmed'];   
        $rules['password_confirmation'] = '';   
        $rules['cno'] = '';   
        $rules['usertype'] = 'required';      
        $rules['address'] = '';      
        return $rules;
    }

    public function messages(){
        $messages = [];
        $messages['fname'] = 'First name is required';   
        $messages['lname'] = 'Last name is required';  
        $messages['mname'] = 'Middle name is required'; 
        $messages['usertype'] = 'Please select user level'; 
        return $messages;
    }

    
    public function mount($userid = ""){
        if($userid != ''){
            $this->userid = $userid;
        }     
    }


    public function render()
    {
        if(isset($this->userid)){
            $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/PostUserSearching', [ 'type' => 'Username', 'values' => $this->userid ]);     
            $res = $data->json();
            $res = $res[0];        
            $this->username = $res['username'];            
            $this->fname = $res['fname'];
            $this->lname = $res['lname'];
            $this->mname = $res['mname'];         
            $this->suffix = $res['suffix'];        
            $this->cno = $res['cno'];          
            $this->address = $res['address'];          
            $this->usertype = 1;                               
        }
        return view('livewire.users.user-register');
    }

    public function register(){
        $data = $this->validate();
        $user = [                    
                    "fname"=> $this->fname,
                    "lname"=> $this->lname,
                    "mname"=> $this->mname,
                    "suffix"=> $this->suffix,
                    "username"=> $this->username,
                    "password"=> $this->password,
                    "cno"=> $this->cno,
                    "address"=> $this->address,
                    "userTypeID"=> $this->usertype,
                    "status"=> 1
                ];


        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/SaveUser', $user);  
        // $crtmodules = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/SaveUserModule', $user);         
        return redirect()->to('/users')->with('message', 'User successfully saved'); 
        
    }
}
