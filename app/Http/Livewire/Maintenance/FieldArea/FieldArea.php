<?php

namespace App\Http\Livewire\Maintenance\FieldArea;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;

class FieldArea extends Component
{

    use Common;

    public $unassigned = [];
    public $selectedunassigned = [];
    public $list = [];
    public $folist = [];

    public $areaName;
    public $location;
    public $foid;
    public $fullname;
    public $keyword = '';
    public $keywordunassigned = '';

    public $searchfokeyword = '';

    public function rules(){
        $rules = [];
        $rules['areaName'] = ['required'];
        $rules['location'] = ['required'];
        $rules['foid'] = ['required'];
        $rules['fullname'] = ['required'];
        return $rules;
    }

    public function messages(){
        $messages = [];
        $messages['areaName.required'] = 'Please enter area name';
        $messages['areaName.location'] = 'Please select unassigned locations';
        $messages['areaName.foid'] = 'Please field officer';
        $messages['areaName.foid'] = 'Please field officer';
        return $messages;
    }

    public function removeSelUnassigned($mkey){
        $key = array_search($mkey, $this->selectedunassigned);
        if ($key !== false) {
            unset($this->selectedunassigned[$key]);
        }
        $this->setLocationName();           
    }

    public function store(){
        $this->validate(); 
        $data = [];
        if(count($this->selectedunassigned) > 0){
            foreach($this->selectedunassigned as $selun){                    
                $data[] = [
                    'areaName' => $this->areaName,
                    'location' => $this->unassigned[$selun],
                    'foid' =>  $this->foid,         
                ]; 
            }
        }     
        //dd( $data );             
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldArea/AssigningFieldArea', $data);          
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
        // $this->selectedunassigned = collect([]);
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
                $this->unassigned[$unass['areaID']] = $unass['location'];
            }
        }       
    }
}
