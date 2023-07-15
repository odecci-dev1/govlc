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
    public $userTypeID;
    public $status;
    public $password_confirmation;

    public function render()
    {
        return view('livewire.users.user-register');
    }

    public function register(){
        $user = [                    
                    "fname"=> $this->fname,
                    "lname"=> $this->lname,
                    "mname"=> $this->mname,
                    "suffix"=> $this->suffix,
                    "username"=> $this->username,
                    "password"=> $this->password,
                    "cno"=> $this->cno,
                    "address"=> $this->address,
                    "userTypeID"=> 0,
                    "status"=> 0
                ];

        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/SaveUser', $user);        
        
    }
}
