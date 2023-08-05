<?php

namespace App\Http\Livewire\Maintenance\Holiday;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Holiday extends Component
{

    public $name;
    public $day;
    public $month;
    public $year;
    public $location;
    public $repeat;
    public $date;
    public $holid;

    public function rules(){
        $rules = [];
        $rules['name'] = 'required';  
        $rules['date'] = 'required';  
        $rules['day'] = '';  
        $rules['month'] = '';  
        $rules['year'] = '';  
        $rules['location'] = 'required';  
        $rules['repeat'] = 'required';  
        return $rules;
    }

    public function setDate($date, $month, $dayAndWeekday, $year){
        $this->date = $date;
        $this->month = $month;
        $this->day = $dayAndWeekday;
        $this->year = $year;
    }

    public function store(){      
        $input = $this->validate();

        $data = [
                    'holidayName' => $input['name'],
                    'date' => date('Y-m-d', strtotime($this->date)),
                    'location' => $input['location'],
                    'repeatYearly' => $input['repeat'],                  
                ];

        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Holiday/AddNewHoliday', $data);         
        dd($crt);
    }

    public function mount($holid = ""){
        if($holid != ''){
            $this->holid = $holid;
        }
    }

    public function render()
    {     
        if(isset($this->holid)){
            $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Holiday/HolidayViewFilter', [ 'holidayID' => $this->holid ]);     
            $res = $data->json();
            $this->name;
            $this->day;
            $this->month;
            $this->year;
            $this->location;
            $this->repeat;
            $this->date;
        }
        return view('livewire.maintenance.holiday.holiday');
    }
}
