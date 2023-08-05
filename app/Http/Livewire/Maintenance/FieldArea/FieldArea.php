<?php

namespace App\Http\Livewire\Maintenance\FieldArea;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class FieldArea extends Component
{
    public $unassigned = [];
    public $selectedunassigned = [];

    public function removeSelUnassigned($mkey){
        $key = array_search($mkey, $this->selectedunassigned);
        if ($key !== false) {
            unset($this->selectedunassigned[$key]);
        }

        // // dd($this->selectedunassigned); 
        // if (($key = array_search($mkey, $this->selectedunassigned)) !== false) {   
        //     // dd($key);     
        //     unset($this->selectedunassigned[$key]); 
        // }     
       
    }

    public function mount(){
        // $this->selectedunassigned = collect([]);
    }

    public function render()
    {      
        $this->getUnassigned();          
        return view('livewire.maintenance.field-area.field-area');
    }

    public function getUnassigned(){
        $unassigned = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldArea/UnAssignedLocationList');  
        $unassigned = $unassigned->json();  
        if($unassigned){
            foreach($unassigned as $unass){
                $this->unassigned[$unass['areaID']] = $unass['areaName'];
            }
        }
    
    }
}
