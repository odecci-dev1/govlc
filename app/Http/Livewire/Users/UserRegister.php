<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;

use App\Traits\Common;

class UserRegister extends Component
{

    use Common;
    use WithFileUploads;

    public $fname;
    public $lname;
    public $mname;
    public $suffix;
    public $profile;
    public $profilePath;
    public $username;
    public $password;
    public $cno;
    public $address;
    public $usertype = [];
    public $status;
    public $password_confirmation;
    public $userid = '';
    public $mid = '';
    public $updatePassword = 1;

    public $modules = [];
    public $modulelist;

    public function rules(){                
        $rules = []; 
        $rules['fname'] = 'required';  
        $rules['lname'] = 'required';  
        $rules['mname'] = 'required';  
        $rules['suffix'] = '';  
        $rules['username'] = 'required'; 
        $rules['password'] = $this->mid !='' ? '' : ['required', 'confirmed'];   
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
        $this->modulelist = collect([]);
        $this->modules = [];
        if($userid != ''){
            $this->userid = $userid;
            $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/FilterUserInfoByUID', [ 'userID' => $this->userid ]);     
          
            $res = $data->json();  
            if(isset($res[0])){    
                $res = $res[0];       
                $this->mid = $res['id'];            
                $this->username = $res['username'];            
                $this->fname = $res['fname'];
                $this->lname = $res['lname'];
                $this->mname = $res['mname'];         
                $this->suffix = $res['suffix'];        
                $this->cno = $res['cno'];          
                $this->address = $res['address'];   
                $this->profilePath = $res['profilePath'];       
                $this->usertype = 1;    

                $usemodules = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/GetUserModuleByUserID', [ 'userID' => $this->userid ]);     
                $usemodules = $usemodules->json();
                
                if($usemodules){
                    foreach($usemodules as $usemodules){
                        $this->modules[] = $usemodules['module_code'];
                    }
                }
               
                $this->updatePassword = 0;
            }           
        }           
        $getmodules = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/UserRegistration/GetModuleList');     
        $getmodules = $getmodules->json();
        if($getmodules){
            foreach($getmodules as $getmodules){
                $this->modulelist[$getmodules['module_code']] = ['module_code' => $getmodules['module_code'], 'module_name' => $getmodules['module_name'], 'module_category' => $getmodules['module_category']];
            }
        }        
    }

    public function register(){      
        $data = $this->validate();
        $modules = [];
        if(count($this->modules) > 0){
            foreach($this->modules as $mdl){
                $modules[] = [
                                "id"=> $this->mid == '' ? '0' : $this->mid,
                                "user_id"=> "string",
                                "module_code"=> $mdl,
                                "created_by"=> "ADMIN",
                                "module_category"=> "string"
                            ];
            }
        }

        $profilename = '';
        if(isset($this->profile)){
            $time = time();
            $profilename = 'user_profile_'.$time;
            $this->profile->storeAs('public/user_profile', $profilename);                               
        }  
        
        $user = [            
                    "id"=> $this->mid == '' ? '0' : $this->mid,        
                    "fname"=> $this->fname,
                    "lname"=> $this->lname,
                    "mname"=> $this->mname,
                    "suffix"=> $this->suffix,
                    "username"=> $this->username,
                    "password"=> $this->password,
                    "cno"=> $this->cno,
                    "address"=> $this->address,
                    "userTypeID"=> $this->usertype,
                    "profilePath"=> $profilename,
                    "status"=> 1,
                    "usermodule"=> $modules
                ];


        if( $this->mid == '' ){
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/SaveUser', $user); 
            $getlast = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/UserRegistration/GetLastUserList');       
            $getlast =  $getlast->json();
            return redirect()->to('/user/view/'.$getlast['userId'])->with('message', 'User successfully saved'); 
        }      
        else{
            // dd($user);
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/UpdateUserInfo', $user); 
           
            return redirect()->to('/user/view/'.$this->userid)->with('message', 'User successfully updated'); 
        }  
                 
        // $crtmodules = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/SaveUserModule', $user);         

      
       
        
    }

    public function changeUpdatePassword(){
        $this->updatePassword = 1;
    }

    public function closeUpdatePassword(){
        $this->updatePassword = 0;
    }

    public function render()
    {
       
        return view('livewire.users.user-register');
    }
}
