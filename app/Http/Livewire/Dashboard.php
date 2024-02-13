<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;

use Livewire\Component;

class Dashboard extends Component
{
    public $data;
    public $area = [];

    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Dashbaord/DashboaredView');   
        $this->data = isset($data->json()[0]) ? $data->json()[0] : [];

        $getarea =  Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldArea/AreasList');      
        $this->area = $getarea->json();
        return view('livewire.dashboard');
    }
}
