<?php

namespace App\Http\Livewire\Maintenance\FieldArea;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;

class FieldArea extends Component
{

    use Common;

    public $areaID = '';
    public $keyword = '';

    public $areaName;
    public $foid;
    public $fullname;
    public $selectedLocations;

    public $keywordunassigned = '';  
    public $unassignedLocations;
    
    public $searchfokeyword = '';

    public function rules(){
        $rules = [];
        $rules['areaName'] = ['required'];       
        $rules['foid'] = ['required'];
        $rules['selectedLocations'] = ['required'];
        $rules['fullname'] = ['required'];
        return $rules;
    }

    public function messages(){
        $messages = [];
        $messages['areaName.required'] = 'Please enter area name';     
        $messages['selectedLocations.required'] = 'Please select locations from unassigned';     
        $messages['areaName.foid'] = 'Please field officer';        
        return $messages;
    }

    public function store(){
        $this->validate();     
        $locations = [];           
        if(count($this->selectedLocations) > 0){
            foreach($this->selectedLocations as $sel){                    
                $locations[] = $sel['location'];
            }
        }     
        $data = [
                    'areaName' => $this->areaName,
                    'location' => $locations,
                    'foid' => $this->foid,
                ];               
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldArea/AssigningFieldArea', $data);                 
        return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully saved');       
    }

    public function update(){
        $this->validate();     
        $locations = [];           
        if(count($this->selectedLocations) > 0){
            foreach($this->selectedLocations as $sel){                    
                $locations[] = $sel['location'];
            }
        }     
        $data = [
                    'areaID' => $this->areaID,
                    'areaName' => $this->areaName,
                    'location' => $locations,
                    'foid' => $this->foid,
                ];     

        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldArea/UpdateArea', $data);                        
        return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully updated');    
    }

    public function trash($areaID){
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldArea/DeleteAreas', ["areaID" => $areaID]);                              
        return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully trashed');   
    }

    public function selectArea($AreaID = ''){
        $this->resetFields();
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldArea/GetAreaDetails', ['AreaID' => $AreaID]);          
        $data = $data->json();
        if(isset($data[0])){
            $inp = $data[0]; 
            //dd($inp);    
            $this->areaID = $inp['areaID'];
            $this->areaName = $inp['areaName'];            
            $this->foid = $inp['foid'];
            $this->fullname = $inp['fullname'];
            
            $locations = $inp['location'];
            if($locations){
                foreach($locations as $loc){
                    $this->selectedLocations[$loc['location']] = ['location' => $loc['location'], 'stat' => 1]; 
                }
            }
        }
        else{
            //session
        }
    }

    public function openSearchOfficer(){                 
        $this->emit('openSearchOfficerModal', ['data' => '' , 'title' => 'This is the title', 'message' => 'This is the message']);
    }

    public function selectFO($foid, $name){
        $this->foid = $foid;
        $this->fullname = $name;
        $this->emit('closeSearchFOModal', ['data' => '' , 'title' => 'This is the title', 'message' => 'This is the message']);
    }

    public function removeFromSelected($location, $stat){
        $this->selectedLocations->forget($location);     
        $this->unassignedLocations[$location] = ['location' => $location, 'stat' => $stat];  
    }

    public function addToSelected($location, $stat){
        $this->selectedLocations[$location] = ['location' => $location, 'stat' => $stat]; 
        $this->unassignedLocations->forget($location);      
    }

    public function resetFields(){
        $this->areaID = '';
        $this->areaName = null;
        $this->foid = null;
        $this->fullname = null;    
        $this->selectedLocations = collect([]);

        if($this->unassignedLocations){
            foreach ($this->unassignedLocations as $key => $value) {
                if($value['stat'] == 1){
                    $this->unassignedLocations->forget($key);   
                }
            }
        }
        
    }

    public function mount(){
        $this->unassignedLocations = collect([]);
        $this->selectedLocations = collect([]);
        $munassigned = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldArea/UnAssignedLocationListPaginate', ['Areaname' => 'c', 'page' => 1, 'pageSize' => 50]);                
        // dd($munassigned);
        $unassignedLocations = $munassigned->json();    
        if(isset($unassignedLocations)){
            foreach($unassignedLocations as $unassignedLocations){
                $this->unassignedLocations[$unassignedLocations['location']] = ['location' => $unassignedLocations['location'], 'stat' => 0]; 
            }
        }        
    }

    public function render()
    {                      
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldArea/AreaFilter', ['areaName' => $this->keyword]);          
        $this->list = $data->json();    

        $fodata = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/FieldOfficerFilterbyFullname', ['fullname' => $this->searchfokeyword]);  
        $this->folist = $fodata->json();         
        return view('livewire.maintenance.field-area.field-area');
    }


}
