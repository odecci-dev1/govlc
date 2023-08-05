<?php

namespace App\Http\Livewire\Maintenance\Holiday;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class HolidayList extends Component
{
    public $list = [];
    
    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Holiday/HolidayList');  
        $this->list = $data->json();      
        return view('livewire.maintenance.holiday.holiday-list');
    }
}
