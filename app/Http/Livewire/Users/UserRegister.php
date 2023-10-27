<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use File;
use App\Traits\Common;

class UserRegister extends Component
{

    use Common;
    use WithFileUploads;

    public $fname;
    public $lname;
    public $mname;
    public $suffix;
    public $profilePath;
    public $imgprofile;
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
    public $maintenance;
    public $collection;
    public $transactions;
    public $reports;

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
                $this->usertype = $res['userTypeId'];             

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

    public function checkAll($catname,$cat){      
        if($this->$catname){
            $getmodules = $this->modulelist->whereIn('module_category', $cat);           
            if($getmodules){
                foreach($getmodules as $mdl){
                    $this->modules[] = $mdl['module_code'];
                }
            }
        }
    }

    public function updatePassword(){
        $this->validate(['password' => ['required', 'confirmed']]);
        $data = [            
            "userId"=> $this->userid,
            "password"=> $this->password      
        ];
        $upt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/ChangePassword', $data);                   
        session()->flash('sessmword', 'Password Updated'); 
        session()->flash('sessmessage', 'Please logout if user was change'); 
        $this->updatePassword = 0;
    }

    public function storeProfileImage(){           
        $profilename = '';
        if($this->imgprofile){
            $deletefiles = [];
            if(isset($profilePath)){
                $deletefiles[] = 'public/users_profile/'.$this->profilePath;
            }
            Storage::delete($deletefiles);       
            
            $time = time();          
            $profilename = 'users_profile_'.$time.'.'.$this->imgprofile->getClientOriginalExtension();         
            $this->imgprofile->storeAs('public/users_profile', $profilename);    
        }
        else{
            $profilename = $this->profilePath;  
        }  
        return $profilename;
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
                    "profilePath"=> $this->storeProfileImage(),
                    "status"=> 1,
                    "usermodule"=> $modules
                ];


        if( $this->mid == '' ){
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/SaveUser', $user); 
            $getlast = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/UserRegistration/GetLastUserList');       
            $getlast =  $getlast->json();
            return redirect()->to('/user/view/'.$getlast['userId'])->with(['sessmword'=> 'Success', 'sessmessage'=> 'User successfully saved']); 
        }      
        else{
            // dd($user);
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/UpdateUserInfo', $user);            
            return redirect()->to('/user/view/'.$this->userid)->with(['sessmword'=> 'Success', 'sessmessage'=> 'Please relogin to refresh current user session.']); 
        }     
        
    }

    public function archive($userid){       
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/DeleteUser', [ 'id' => $userid ]);              
        return redirect()->to('/users')->with(['mmessage'=> 'User has been archived', 'mword'=> 'Success']);    
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
