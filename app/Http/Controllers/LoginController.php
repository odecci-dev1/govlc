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
                session()->put('auth_usertype', $data['userTypeId']); 
                session()->put('auth_username', $data['username']); 
                session()->put('auth_name', $data['lname'] . ', ' . $data['fname'] .' '. mb_substr($data['mname'],0,1) . '.');       
                session()->put('auth_userid', $data['userId']); 
                session()->put('auth_id', $data['id']);     
                session()->put('auth_profile', $data['profilePath']);  
                
                $noti = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Notification/NotificationCount', ['userid' => session()->get('auth_userid')]);     
                // dd( $noti );
                $noti = $noti->json();
                

                session()->put('noti_count', $noti);  
                            
                if(in_array($data['userTypeId'], [1,2])){                    
                    $modules = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/UserRegistration/GetModuleList'); 
                }
                else{
                    $modules = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/GetUserModuleByUserID', ['userID' => $data['userId']]); 
                }
                session()->forget('auth_usermodules');
                $modules = $modules->json();              
                if($modules){
                    foreach($modules as $mdl){
                        $usermodules[] = $mdl['module_code'];
                    }
                }
                session()->put('auth_usermodules', $usermodules);               
            }   
            
            if(!empty($data['foid'])){
                session()->put('auth_remittance_only', 1);                   
                $arealist = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/GetAreaReferenceNo', [ 'FOID' => $data['foid'] ]);  
                $areaRefNo = $arealist->json()[0]['areaRefNo'] ??= '';  
                $areaID = $arealist->json()[0]['areaID'] ??= '';    
                if(!empty($areaRefNo)){             
                    return redirect('/collection/remittance/'.$data['foid'].'/'.$areaRefNo.'/'.$areaID);
                }
                else{
                    return redirect('/logout')->with('message', 'You dont have remittance to view.'); 
                }
            } 
            else{       
                return redirect('/dashboard');
            }
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
