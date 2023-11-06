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
        $noti = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Notification/NotificationCount');     
        $noti = $noti->json();

        session()->put('noti_count', $noti); 
        return $noti;
    }
}
