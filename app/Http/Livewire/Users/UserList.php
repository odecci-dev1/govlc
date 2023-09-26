<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class UserList extends Component
{
    public $list = [];
    public $keyword = '';
    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/PostUserSearching', [ ['column' => 'lname', 'values' => $this->keyword], ['column' => 'fname', 'values' => $this->keyword], ['column' => 'username', 'values' => $this->keyword] ]);  
        // dd(['column' => 'lname', 'values' => $this->keyword], ['column' => 'fname', 'values' => $this->keyword], ['column' => 'username', 'values' => $this->keyword]);
        $this->list = $data->json();            
        return view('livewire.users.user-list');
    }
}
