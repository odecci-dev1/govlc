<?php

namespace App\Http\Livewire\Maintenance\FieldArea;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class FieldArea extends Component
{
    public $unassigned = [];
    public $selectedunassigned = [];
    public $list = [];

    public $areaName;
    public $location;
    public $foid;
    public $fullname;
    public $keyword;
    public $keywordunassigned;

    public function removeSelUnassigned($mkey){
        $key = array_search($mkey, $this->selectedunassigned);
        if ($key !== false) {
            unset($this->selectedunassigned[$key]);
        }
        $this->setLocationName();           
    }

    public function store(){
        $data = [
                    'areaName' => $this->areaName,
                    'location' => $this->location,
                    'foid' =>  $this->foid,
                    'fullname' => $this->fullname,
                    'status' => '1'
                ]; 
           
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldArea/AssigningFieldArea', $data);   
        dd($crt);      
    }

    public function mount(){
        // $this->selectedunassigned = collect([]);
    }

    public function render()
    {      
        $this->getUnassigned();          
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldArea/AreaFilter', ['areaName' => $this->keyword]);  
        $this->list = $data->json();            
        return view('livewire.maintenance.field-area.field-area');
    }

    public function setLocationName(){     
        $location = '';
        $cntun = 1;
        if(count($this->selectedunassigned) > 0){
            foreach($this->selectedunassigned as $selun){
                if($cntun == count($this->selectedunassigned)){
                    $location .= $this->unassigned[$selun];
                }
                else{
                    $location .= $this->unassigned[$selun] . ', ';
                }
                $cntun = $cntun + 1;
            }
        }           
        $this->location =  $location;       
    }

    public function getUnassigned(){       
        $this->unassigned = [];       
        $unassigned = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldArea/UnAssignedFilter', ['location' => $this->keywordunassigned]);  
        $unassigned = $unassigned->json();  
        if($unassigned){
            foreach($unassigned as $unass){
                $this->unassigned[$unass['areaID']] = $unass['areaName'];
            }
        }       
    }
}
