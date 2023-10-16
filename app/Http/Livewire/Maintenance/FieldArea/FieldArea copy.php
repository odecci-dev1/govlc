<?php

namespace App\Http\Livewire\Maintenance\FieldArea;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;

class FieldArea extends Component
{

    use Common;

    public $unassigned = [];
    public $chkunassigned = [];
    public $selectedlocations = [];
    public $list = [];
    public $folist = [];

    public $areaName;
    public $foid;
    public $fullname;
    public $keyword = '';
    public $keywordunassigned = '';

    public $searchfokeyword = '';

    public function rules(){
        $rules = [];
        $rules['areaName'] = ['required'];       
        $rules['foid'] = ['required'];
        $rules['selectedlocations'] = ['required'];
        $rules['fullname'] = ['required'];
        return $rules;
    }

    public function messages(){
        $messages = [];
        $messages['areaName.required'] = 'Please enter area name';     
        $messages['selectedlocations.required'] = 'Please select locations from unassigned';     
        $messages['areaName.foid'] = 'Please field officer';        
        return $messages;
    }

    public function selectArea($AreaID = ''){
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldArea/GetAreaDetails', ['AreaID' => $AreaID]);          
        $data = $data->json();
        $inp = $data[0];     
        $this->areaName = $inp['areaName'];
        $this->location = $inp['location'];
        $this->foid = $inp['foid'];
        $this->fullname = $inp['fullname'];
    }

    public function removeSelUnassigned($mkey){
        //dd($key = array_search($mkey, $this->chkunassigned));
        //unset($this->chkunassigned['2']);
        //dd($this->chkunassigned[$this->selectedlocations[$mkey]['value']]);
        //unset($this->chkunassigned[$this->selectedlocations[$mkey]['value']]);  
        //dd($this->chkunassigned);
        if (($key = array_search($mkey, $this->chkunassigned)) !== false) {        
            //dd($key);   
            unset($this->chkunassigned[$key]);
        }
        //dd($this->chkunassigned);
        $this->selectedlocations->forget($mkey);        
    }

    public function store(){
        $this->validate();        
        $locations = [];           
        if(count($this->chkunassigned) > 0){
            foreach($this->chkunassigned as $selun){                    
                $locations[] = $this->unassigned[$selun];
            }
        }     
        $data = [
                    'areaName' => $this->areaName,
                    'location' => $locations,
                    'foid' => $this->foid,
                ];
        //dd( $data );             
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldArea/AssigningFieldArea', $data);          
        //dd( $data );   
        return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully saved');    
    }

    public function openSearchOfficer(){                 
        $this->emit('openSearchOfficerModal', ['data' => '' , 'title' => 'This is the title', 'message' => 'This is the message']);
    }

    public function selectFO($foid, $name){
        $this->foid = $foid;
        $this->fullname = $name;
        $this->emit('closeSearchFOModal', ['data' => '' , 'title' => 'This is the title', 'message' => 'This is the message']);
    }

    
    public function mount(){
        $this->selectedlocations = collect([]);
        
    }

    public function render()
    {      
        $this->getUnassigned();   
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldArea/AreaFilter', ['areaName' => $this->keyword]);  
        // dd($data);
        $this->list = $data->json();    
        // dd($this->list);
        
        $fodata = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/FieldOfficerFilterbyFullname', ['fullname' => $this->searchfokeyword]);  
        $this->folist = $fodata->json();    
        return view('livewire.maintenance.field-area.field-area');
    }

    public function setLocation(){         
        $this->selectedlocations = collect([]);
        $cnt = 0;
        if(count($this->chkunassigned) > 0){
            foreach($this->chkunassigned as $chk){
                $cnt = $cnt + 1;
                $this->selectedlocations[$cnt] = ['key' => $cnt, 'value' => $chk];
            }
        }
        
    }

    public function getUnassigned(){       
        $this->unassigned = [];       
        $munassigned = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldArea/UnAssignedLocationListPaginate', ['Areaname' => $this->keywordunassigned, 'page' => 1, 'pageSize' => 50]);               
        $munassigned = $munassigned->json();          
   
        if($munassigned){
            foreach($munassigned as $unass){               
                $this->unassigned[] = $unass['location'];
            }
        }       
    }
}
