<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Notifications extends Component
{
    public function render()
    {
        $notice = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Notification/NotificationListFilterbyUserId', [ 'userid' =>  session()->get('auth_userid') ]);     
        $notice = $notice->json();
        return view('livewire.notifications.notifications', ['notice' => $notice]);
    }
}
