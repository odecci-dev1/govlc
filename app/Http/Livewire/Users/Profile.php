<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use App\Traits\Common;
use Illuminate\Support\Facades\Hash;

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
    public $foid;
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
            
            
            $data = User::where('UserId', $this->userid)->first();     
          
            $res = $data;  
            if(isset($res)){    
                $this->mid = $res['Id'];            
                $this->username = $res['Username'];            
                $this->fname = $res['Fname'];
                $this->lname = $res['Lname'];
                $this->mname = $res['Mname'];         
                $this->suffix = $res['Suffix'];        
                $this->cno = $res['Cno'];          
                $this->address = $res['Address'];   
                $this->profilePath = $res['ProfilePath'];       
                $this->usertype = $res['UTID'];                                   
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

    public function update(){      
        $this->validate();               
        User::where('UserId', $this->userid)->update([      
            'Username' => $this->username,
            'Fname' => $this->fname,
            'Mname' => $this->mname,
            'Lname' => $this->lname,
            'Cno' => $this->cno,
            'Address' => $this->address,
            'DateUpdated' => now(),
            'UTID' => $this->usertype,
            'ProfilePath' => $this->storeProfileImage(), 
        ]);

        return redirect()->to('/profile')->with('sessmessage', 'Your profile has successfully updated');         
    }

    public function updatePassword(){
        $this->validate(['password' => ['required', 'confirmed']]);
        User::where('UserId', $this->userid)->update([            
            "password"=> Hash::make($this->password)
        ]);

        session()->flash('sessmword', 'Password Updated'); 
        session()->flash('sessmessage', 'Please logout if user was change'); 
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
