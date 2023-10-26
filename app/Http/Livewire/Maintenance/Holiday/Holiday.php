<?php

namespace App\Http\Livewire\Maintenance\Holiday;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;

class Holiday extends Component
{

    use Common;

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

    public function messages(){
        $messages = [];
        $messages['date.required'] = 'Select date';  
        return $messages;
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
        // dd( $crt ); asd
        $getlast = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Holiday/GetLastHolidayList');        
        $getlast = $getlast->json(); 
        return redirect()->to('/maintenance/holiday/view/'.(isset($getlast['holidayID']) ? $getlast['holidayID'] : ''))->with(['mmessage'=> 'Holiday has been saved', 'mword'=> 'Success']);    
    }

    public function update(){   
        try {                  
            $input = $this->validate(); 
            $data = [
                'holidayName' => $input['name'],
                'date' => date('Y-m-d', strtotime($this->date)),
                'location' => $input['location'],
                'repeatYearly' => $input['repeat'],
                'holidayID' => $this->holid,                  
            ];

            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Holiday/UpdateHolidayDetails', $data);           
            // dd( $crt ); 
            return redirect()->to('/maintenance/holiday/view/'.$this->holid)->with(['mmessage'=> 'Holiday has been updated', 'mword'=> 'Success']);      
        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function archive($holid){       
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Holiday/DeleteHoliday', [ 'holidayID' => $holid ]);              
        return redirect()->to('/maintenance/holiday/list')->with('message', 'Holiday has been archived');    
    }

    public function mount($holid = ""){
        if($holid != ''){
            $this->holid = $holid;
            $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Holiday/HolidayViewFilter', [ 'holidayID' => $this->holid ]);     
            $res = $data->json();
            $res = $res[0];
            $this->name = $res['holidayName'];
            $this->date = date('m/d/Y', strtotime($res['date']));
            $this->day = date('d (l)', strtotime($res['date']));
            $this->month = date('m', strtotime($res['date']));
            $this->year = date('Y', strtotime($res['date']));
            $this->location = $res['location'];
            $this->repeat = $res['repeatYearly'] == 'True' ? 1 : 0;  
        }
    }

    public function render()
    {            
        return view('livewire.maintenance.holiday.holiday');
    }
}
