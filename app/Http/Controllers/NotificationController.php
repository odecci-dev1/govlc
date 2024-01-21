<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function notifications(){      
        $noti = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Notification/NotificationListFilterbyUserId', ['userid' => session()->get('auth_userid')]);     
        $noti = $noti->json();
        return view('notifications', ['noti' => $noti]);
    }

    public function getnoticount(){
        $noti = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Notification/NotificationCount', ['userid' => session()->get('auth_userid')]);     
        $noti = $noti->json();

        session()->put('noti_count', $noti); 
        return $noti;
    }

    public function viewNotification(Request $request){   
        $noticount = session()->get('noti_count');    
        $noti = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Notification/UpdateReadNotification', ['id' => $request['id']]);             
        session()->put('noti_count', $noticount - 1); 
        return redirect()->to('/tranactions/application/view/'.$request['reference']);
    }

    public function markNotification(Request $request){          
        $noticount = session()->get('noti_count');    
        $noti = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Notification/UpdateReadNotification', ['id' => $request['notiid']]);             
        session()->put('noti_count', $noticount - 1);        
    }
}
