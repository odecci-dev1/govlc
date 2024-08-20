<?php

namespace App\Http\Livewire\Users;

use App\Models\FieldOfficer;
use App\Models\Modules;
use App\Models\User;
use App\Models\UserModule;
use App\Models\UserType;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use File;
use App\Traits\Common;
use Illuminate\Support\Facades\Hash;

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
    public $others;

    public $modules = [];
    public $modulelist;

    public $searchfokeyword = '';
    public $folist = [];
    public $foid = '';

    public function rules(){                
        $rules = []; 
        $rules['fname'] = 'required';  
        $rules['lname'] = 'required';  
        $rules['mname'] = 'required';  
        $rules['suffix'] = '';  
        $rules['username'] = ['required',
            function ($attribute, $value, $fail) {
                $user = User::whereRaw('LOWER(Username) = ?', [strtolower($value)])
                                    ->where('UserId', '!=', $this->userid)
                                    ->first();
                if ($user) {
                    $fail('A username already exists.');
                }
            }
        ]; 
        $rules['password'] = $this->mid !='' ? '' : ['required', 'confirmed'];   
        $rules['password_confirmation'] = '';   
        $rules['cno'] = 'required';   
        $rules['usertype'] = 'required';      
        $rules['address'] = 'required';      
        $rules['foid'] = '';      
        $rules['imgprofile'] = ['nullable', function($attribute, $value, $fail) {
            if (!$this->imgprofile && !$this->profilePath) {
                $fail('User profile is required.');
            }
        }]; 
        return $rules;
    }

    public function messages(){
        $messages = [];
        $messages['fname'] = 'First name is required';   
        $messages['lname'] = 'Last name is required';  
        $messages['mname'] = 'Middle name is required'; 
        $messages['usertype'] = 'Please select user level'; 
        $messages['imgprofile'] = 'User profile is required'; 
        $messages['address'] = 'Address number is required'; 
        $messages['cno'] = 'Contact number is required'; 
        return $messages;
    }

    
    public function mount($userid = ""){
        $this->modulelist = collect([]);
        $this->modules = [];
        if($userid != ''){
            $user = User::where('UserId', $userid)->first();
            if($user){    
                $this->mid = $user['Id'];            
                $this->username = $user['Username'];            
                $this->fname = $user['Fname'];
                $this->lname = $user['Lname'];
                $this->mname = $user['Mname'];         
                $this->suffix = $user['Suffix'];        
                $this->cno = $user['Cno'];          
                $this->address = $user['Address'];   
                $this->profilePath = $user['ProfilePath'];  
                $this->usertype = $user['UTID'];     
                $this->foid = $user['FOID'];                   

                $userModules = UserModule::where('user_id', $userid)->get();

                if($userModules){
                    foreach($userModules as $userModule){
                        $this->modules[] = $userModule['module_code'];
                    }
                }

                $this->updatePassword = 0;
            }           
        }           
        $getmodules = Modules::all();     

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

        $user = User::where('UserId', $this->userid); 

        $user->update([
            "password"=> Hash::make($this->password)      
        ]);
        // dd($user);

        // $upt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/ChangePassword', $data);                   
        session()->flash('sessmword', 'Password Updated'); 
        session()->flash('sessmessage', 'Please logout if user was change'); 
        $this->updatePassword = 0;
    }

    public function storeProfileImage(){           
        $profilename = '';
        if($this->imgprofile){
            $deletefiles = [];
            if(isset($profilePath)){
                $deletefiles[] = 'users_profile/'.$this->profilePath;
            }
            Storage::delete($deletefiles);       
            
            $time = time();          
            $profilename = 'users_profile_'.$time.'.'.$this->imgprofile->getClientOriginalExtension();         
            $this->imgprofile->storeAs('users_profile', $profilename);    
        }
        else{
            $profilename = $this->profilePath;  
        }  
        return $profilename;
    }

    public function register(){      
        $this->validate();
        $modules = [];

        if( $this->mid == '' ) {

            $user = User::create([
                "Id"=> $this->mid == '' ? '0' : $this->mid,        
                "Fname"=> $this->fname,
                "Lname"=> $this->lname,
                "Mname"=> $this->mname,
                "Suffix"=> $this->suffix,
                "Username"=> $this->username,
                "Password"=> $this->password,
                "Cno"=> $this->cno,
                "Address"=> $this->address,                    
                "ProfilePath"=> $this->storeProfileImage(),
                "FOID"=> $this->foid,     
                "UTID"=> $this->usertype,
                "Status"=> 1,
                "DateCreated"=> now(),
                "usermodule"=> $modules
            ]);

            $latestUser = User::latest()->first();
            $UserId = $latestUser->UserId;

            return redirect()->to('/user/view/'.$UserId)->with(['sessmword'=> 'Success', 'sessmessage'=> 'User successfully saved']); 
        }      
        else{
            $user = User::where('Id', $this->mid)->update([
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

            UserModule::where('user_id', $this->mid)->delete();

            if(count($this->modules) > 0){
                foreach($this->modules as $mdl){
                    $modules[] = [
                        "id"=> $this->mid == '' ? '0' : $this->mid,
                        "user_id"=> "string",
                        "module_code"=> $mdl,
                        "created_by"=> "ADMIN",
                        "module_category"=> "string"
                    ];
                    
                    UserModule::create([
                        "user_id"=> $this->mid == '' ? '0' : $this->mid,
                        "module_code"=> $mdl,
                        "created_by"=> session()->get('auth_userid'),
                    ]);
                }
            }
            

            return redirect()->to('/user/view/'.$this->userid)->with(['sessmword'=> 'Success', 'sessmessage'=> 'Please relogin to refresh current user session.']); 
        }     
        
    }

    public function openSearchOfficer(){                 
        $this->emit('openSearchOfficerModal', ['data' => '' , 'title' => 'This is the title', 'message' => 'This is the message']);
        $this->searchFO();
    }

    public function searchFO()
    {
       $fieldofficers = FieldOfficer::get();
    //    dd($fieldofficers);
        // $fodata = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/FieldOfficerFilterbyFullname', ['fullname' => $this->searchfokeyword]);  
        $this->folist = $fieldofficers;  
    }

    public function selectFO($foid, $fname, $mname, $lname){
        $this->foid = $foid;
        $this->fname = $fname;
        $this->mname = $mname;
        $this->lname = $lname;
        $this->emit('closeSearchFOModal', ['data' => '' , 'title' => 'This is the title', 'message' => 'This is the message']);
    }

    public function removeFO(){
        $this->foid = '';
        $this->fname = '';
        $this->mname = '';
        $this->lname = '';
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
