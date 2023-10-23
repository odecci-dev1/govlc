<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use App\Traits\Common;

class Profile extends Component
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
    public $updatePassword = 0;

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
    
    public function mount(){   
        $userid = session()->get('auth_userid');        
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
                $this->updatePassword = 0;
            }           
        }                  
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
                    "status"=> 1,                  
                    "profilePath"=> $this->storeProfileImage(), 
                ];

        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/UpdateUserInformation', $user); 
        return redirect()->to('/profile')->with('message', 'Your profile has successfully updated');         
    }

    public function updatePassword(){
        $this->validate(['password' => ['required', 'confirmed']]);
        $data = [            
            "userId"=> $this->userid,
            "password"=> $this->password      
        ];
        $upt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/ChangePassword', $data);            
        $this->updatePassword = 0;
    }

    
    public function changeUpdatePassword(){
        $this->updatePassword = 1;
    }

    public function closeUpdatePassword(){
        $this->updatePassword = 0;
    }

    public function render()
    {
        return view('livewire.users.profile');
    }
}
