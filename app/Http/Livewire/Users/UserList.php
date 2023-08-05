<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class UserList extends Component
{
    public $list = [];
    public $keyword;
    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/UserRegistration/UserList');  
        $this->list = $data->json();         
        return view('livewire.users.user-list');
    }
}
