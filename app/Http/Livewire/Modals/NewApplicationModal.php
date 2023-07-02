<?php

namespace App\Http\Livewire\Modals;
use Illuminate\Support\Facades\Http;

use Livewire\Component;

class NewApplicationModal extends Component
{
    public $memberlist;
    public $newappmodelkeyword;

    public function searchExistingMembers($value){
        $this->memberlist = $value;
    }

    public function render()
    {
        //$data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/PostMemberSearching', ['Fname' => 'test']);
        //$this->res = $this->newappmodelkeyword;
        //$this->memberlist = $data->json();         
        return view('livewire.modals.new-application-modal');
    }
}
