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
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/PostUserSearching', [ ['column' => 'username', 'values' =>  $request['username']] ]); 
            $data = $crt->json();
            $usermodules = [];

            if($data){
                $data = $data[0];  
                //dd( $data );              
                session()->put('auth_usertype', $data['userTypeId']); 
                session()->put('auth_username', $data['username']); 
                session()->put('auth_name', $data['lname'] . ', ' . $data['fname'] .' '. mb_substr($data['mname'],0,1) . '.');       
                session()->put('auth_userid', $data['userId']); 
                session()->put('auth_id', $data['id']);                                
                $modules = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/GetUserModuleByUserID', ['userID' => $data['userId']]); 
              
                $modules = $modules->json();
                //dd($modules);
                if($modules){
                    foreach($modules as $mdl){
                        $usermodules[] = $mdl['module_code'];
                    }
                }
                session()->put('auth_usermodules', $usermodules);
                //dd(session()->get('auth_usermodules'));
            }           
            return redirect('/dashboard');
        }
        else{
            return redirect('/')->with('message', 'Username and password does not matched. Login Failed.'); 
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/')->with('message', 'You have been logout');       
    }
}
