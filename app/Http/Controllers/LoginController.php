<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = [
                    'username' => $request['username'],
                    'password' => $request['password']
                ];
      
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/LogIn', $data);    
        $res = $crt->getReasonPhrase();
      
        if($res == 'OK'){
            return redirect('/dashboard');
        }
        else{
            return redirect('/')->with('message', 'Username and password does not matched. Login Failed.'); 
        }
    }
}
