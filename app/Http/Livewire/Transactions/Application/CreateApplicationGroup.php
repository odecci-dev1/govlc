<?php

namespace App\Http\Livewire\Transactions\Application;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CreateApplicationGroup extends Component
{

    public $test = 'hello';
    public $members = [];

    public function mount(){
       
        // session(['fname' => 'test']);
        // $this->members[] = ['fname' => ];
    }

    public function store(){
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/SaveAll', session('memdata'));  
    }

    public function render()
    {
        // session()->forget('memdata');             
        if(session('memdata')){
            foreach(session('memdata') as $memdata){
                $this->members[] = $memdata;
            }
        }
        return view('livewire.transactions.application.create-application-group');
    }
}
