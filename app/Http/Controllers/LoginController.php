<?php

namespace App\Http\Controllers;

use App\Models\CollectionArea;
use App\Models\Modules;
use App\Models\Notification;
use App\Models\User;
use App\Models\Area;
use App\Models\UserModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = [
                    'username' => $request['username'],
                    'password' => $request['password']
                ];
      
        $user = User::where('Username', $request['username'])->first();

        if (!$user) {
            # code...    return redirect('/')->with('message', 'You are not yet assigned to any areas or dont have remittance to view.');  
            return redirect('/')->with('message', 'Invalid Credential');  
        }
        // $user = User::where('Username', $request['username'])->where('Password', Hash::check($request['password'],))->first();

        if(Hash::check($request['password'], $user->Password)){
         
            // $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/PostUserSearching', [ ['column' => 'username', 'values' =>  $request['username']] ]); 
            // $data = $crt->json();           
             $usermodules = [];
           
            if($data){
                                  
                session()->put('auth_usertype', $user->UTID); 
                session()->put('auth_username', $user->Username); 
                session()->put('auth_name', $user->Lname . ', ' . $user->Fname .' '. mb_substr($user->Mname,0,1) . '.');       
                session()->put('auth_userid', $user->UserId); 
                session()->put('auth_id', $user->Id);     
                session()->put('auth_remittance_only', 0);             
                session()->put('auth_profile', $user->ProfilePath);  
                
                // $noti = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Notification/NotificationCount', ['userid' => session()->get('auth_userid')]);     
                $noti = Notification::where('isRead', 1)->where('UserId', $user->UserId)->count();
                // dd( $noti );
                // $noti = $noti->json();
                

                session()->put('noti_count', $noti); 
                //dd(session()->get('noti_count')) ;
                            
                if(in_array($user->UTID, [1,2])){                    
                    // $modules = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/UserRegistration/GetModuleList'); 
                    $modules = Modules::all(); 

                    foreach($modules as $mdl){
                        $usermodules[] = $mdl['module_code'];
                    }
                } else {
                    // $modules = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/GetUserModuleByUserID', ['UserId' => $user->UserId]); 
                    $modules = UserModule::where('user_id', $user->UserId)->get();
     
                    foreach($modules as $mdl){
                        $usermodules[] = $mdl['module_code'];
                    }
                }
                session()->put('auth_usermodules', $usermodules);               
            }   
            
            if(!empty($user->FOID)){
                // dd($user->FOID);
                session()->put('auth_remittance_only', 1);           
                
                $getArea = Area::where('FOID',$user->FOID)->first();
                $getColletionArea = CollectionArea::where('AreaId',$getArea->AreaID)->first();
                // $arealist = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/GetAreaReferenceNo', [ 'FOID' => $user['foid'] ]);  
                $areaRefNo =  $getColletionArea->Area_RefNo;  
                $areaID =  $getColletionArea->AreaId;    
                if(!empty($areaRefNo)){             
                    return redirect('/collection/remittance/'.$user->FOID.'/'.$areaRefNo.'/'.$areaID);
                }
                else{
                    //return redirect('/logout')->with('message', 'You dont have remittance to view.'); 
                    $request->session()->flush();
                    return redirect('/')->with('message', 'You are not yet assigned to any areas or dont have remittance to view.');       
                }
            } else {       
                $modules = session()->get('auth_usermodules');
                // dd($modules);
                if(in_array('Module-018', $modules)){
                    return redirect('/dashboard');
                }
                else{
                    return redirect('/profile');
                }
               
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
