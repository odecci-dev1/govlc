<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;

class UserList extends Component
{
    use Common;
    
    public $list = [];
    public $keyword = '';

    public function archive($userid){       
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/DeleteUser', [ 'id' => $userid ]);              
        return redirect()->to('/users')->with(['mmessage'=> 'User has been archived', 'mword'=> 'Success']);    
    }
    

    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/UserRegistration/GetUserListFilter', [ 'page' => 1, 'pageSize' => 100, 'fullname' => $this->keyword ]);          
        // dd(['column' => 'lname', 'values' => $this->keyword], ['column' => 'fname', 'values' => $this->keyword], ['column' => 'username', 'values' => $this->keyword]);       
        $this->list = $data->json();            
        return view('livewire.users.user-list');
    }
}
