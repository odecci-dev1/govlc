<?php

namespace App\Http\Livewire\Maintenance\Holiday;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;

class HolidayList extends Component
{
    use Common;
    public $list = [];
    
    public function archive($holid){       
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Holiday/DeleteHoliday', [ 'holidayID' => $holid ]);              
        return redirect()->to('/maintenance/holiday/list')->with(['mmessage'=> 'Holiday has been archived', 'mword'=> 'Success']);    
    }

    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Holiday/HolidayList');  
        $this->list = $data->json();      
        return view('livewire.maintenance.holiday.holiday-list');
    }
}
