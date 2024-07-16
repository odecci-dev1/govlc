<?php

namespace App\Http\Livewire\Maintenance\FieldArea;

use App\Models\Area;
use App\Models\FieldOfficer;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;

class FieldArea extends Component
{

    use Common;

    public $Id = '';
    public $areaID = '';
    public $keyword = '';
    public $usertype;
        
    public $areaName;
    public $foid;
    public $fullname;
    public $selectedLocations;

    public $keywordunassigned = '';  
    public $unassignedLocations;
    
    public $areas;
    public $folist;

    public $searchfokeyword = '';

    public $paginate = [];
    public $paginationPaging = [];

    public $paginateUnassigned = [];
    public $paginationPagingUnassigned = [];

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

    // public function store(){
    //     $this->validate();     
    //     $locations = [];           
    //     if(count($this->selectedLocations) > 0){
    //         foreach($this->selectedLocations as $sel){                    
    //             $locations[] = $sel['location'];
    //         }
    //     }     
    //     $data = [
    //                 'areaName' => $this->areaName,
    //                 'location' => $locations,
    //                 'foid' => $this->foid,
    //             ];    
    //     //dd( $data );                   
    //     $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldArea/AssigningFieldArea', $data);                        
    //     return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully saved');       
    // }

    public function store(){
        $this->validate();

        // $locations = $this->selectedLocations->map(function($sel) {
        //     return $sel['location'];
        // })->toArray();

        $locations = [];           
        if(count($this->selectedLocations) > 0){
            foreach($this->selectedLocations as $sel){                    
                $locations[] = $sel['location'];
            }
        }   

        // $locationsString = implode(', ', $locations);

        $area = Area::create([
            'Area' => $this->areaName,
            'FOID' => $this->foid,
            'City' => $locations,
            'Status' => 1,
        ]);

        return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully saved!');
    }

    // public function update(){
    //     $this->validate();     
    //     $locations = [];           
    //     if(count($this->selectedLocations) > 0){
    //         foreach($this->selectedLocations as $sel){                    
    //             $locations[] = $sel['location'];
    //         }
    //     }     

    //     $area = Area::find($this->Id); 
    //     dd($area);

    //     if ($area) {
    //         $area->update([
    //             'Area' => $this->areaName,
    //             'FOID' => $this->foid,
    //             'City' => $locations, // Store as plain comma-separated string
    //             'Status' => 1,
    //         ]);
    //     }

    //     return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully updated');    
    // }

    public function update()
    {
        $this->validate();

        $locations = collect($this->selectedLocations)->pluck('location')->toArray();

        $area = Area::find($this->Id);
        dd($area);
        if ($area) {
            $area->update([
                'Id' => $this->Id,
                'Area' => $this->areaName,
                'FOID' => $this->foid,
                'City' => implode(', ', $locations),
                'Status' => 1,
            ]);

            session()->flash('mmessage', 'Field area successfully updated');
        } else {
            session()->flash('mmessage', 'Area not found');
        }

        return redirect()->to('/maintenance/fieldarea');
    }

    public function trash($areaID){
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldArea/DeleteAreas', ["areaID" => $areaID]);                              
        return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully trashed');   
    }

    // public function selectArea($AreaID = ''){
    //     $this->resetFields();
    //     $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldArea/GetAreaDetails', ['AreaID' => $AreaID]);          
    //     $data = $data->json();
    //     //dd( $data );
    //     if(isset($data[0])){
    //         $inp = $data[0]; 
    //         //dd($inp);    
    //         $this->areaID = $inp['areaID'];
    //         $this->areaName = $inp['areaName'];            
    //         $this->foid = $inp['foid'];
    //         $this->fullname = $inp['fullname'];
            
    //         $locations = $inp['location'];
    //         if($locations){
    //             foreach($locations as $loc){
    //                 $this->selectedLocations[$loc['location']] = ['location' => $loc['location'], 'stat' => 1]; 
    //             }
    //         }
    //     }
    //     else{
    //         //session
    //     }
    // }

    // public function selectArea($Id = null)
    // {
    //     $this->resetFields();

    //     if ($Id) {
    //         // Fetch the area by Id as a string
    //         $area = Area::where('Id', $Id)->first();

    //         if ($area) {
    //             // Populate your component properties
    //             $this->Id = $area->Id; // Adjust this based on your actual model attribute
    //             $this->areaName = $area->Area; // Adjust based on your model attribute
    //             $this->foid = $area->FOID; // Adjust based on your model attribute
    //             $this->fullname = ''; // Adjust based on your model attribute

    //             // Assuming 'City' is stored as a comma-separated string
    //             $locations = explode(', ', $area->City);

    //             foreach ($locations as $loc) {
    //                 $this->selectedLocations[] = ['location' => $loc, 'stat' => 1];
    //             }
    //         } else {
    //             session()->flash('mmessage', 'Area not found');
    //         }
    //     }
    // }

    public function selectArea($Id = null)
    {
        dd($Id);
        $this->resetFields();

        if ($Id) {
            // Fetch the area by Id as an integer
            $area = Area::where('Id', $Id)->first();

            if ($area) {
                // Populate your component properties
                $this->Id = $area->Id; // Adjust this based on your actual model attribute
                $this->areaName = $area->Area; // Adjust based on your model attribute
                $this->foid = $area->FOID; // Adjust based on your model attribute
                $this->fullname = ''; // Adjust based on your model attribute

                // Assuming 'City' is stored as a comma-separated string
                $locations = explode(', ', $area->City);

                foreach ($locations as $loc) {
                    $this->selectedLocations[] = ['location' => $loc, 'stat' => 1];
                }
            } else {
                session()->flash('mmessage', 'Area not found');
            }
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
                //dito edit mo
            }
        }
        
    }

    // public function mount(){
    //     $this->usertype = session()->get('auth_usertype'); 
    //     $this->unassignedLocations = collect([]);
    //     $this->selectedLocations = collect([]);
        // $munassigned = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldArea/UnAssignedLocationListPaginate', ['Areaname' => '', 'page' => 1, 'pageSize' => 10000]);                
    //     dd($munassigned);
    //     $unassignedLocations = $munassigned->json();    
    //     if(isset($unassignedLocations)){
    //         foreach($unassignedLocations as $unassignedLocations){
    //             $this->unassignedLocations[$unassignedLocations['location']] = ['location' => $unassignedLocations['location'], 'stat' => 0]; 
    //         }
    //     }        

    //     $this->paginate['page'] = 1;
    //     $this->paginate['pageSize'] = 10;
    //     $this->paginate['FilterName'] = '';
    //     $this->paginationPaging['totalPage'] = 0;          
    // }

    public function mount()
    {
        $this->usertype = session()->get('auth_usertype');

        // Fetch unassigned locations directly from Eloquent if applicable
        // $this->unassignedLocations = Location::where('assigned', false)->get()->pluck('location', 'id');

        // Prepare pagination and initial states
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 10;
        $this->paginate['FilterName'] = '';
        $this->paginationPaging['totalPage'] = 0;
    }


    public function setPage($page = 1){
        $this->paginate['page'] = $page;
    }

    public function render()
    {                      
        $areasQuery = Area::query();
        if (!empty($this->keyword)) {
            $areasQuery->where('Area', 'like', '%' . $this->keyword . '%');
        }
        
        $areas = $areasQuery->paginate($this->paginate['pageSize'], ['*'], 'page', $this->paginate['page']);
        // dd($areas);

        $this->areas = $areas->items();
        $this->paginationPaging['totalPage'] = $areas->lastPage();
        $this->paginationPaging['currentPage'] = $areas->currentPage();
        $this->paginationPaging['nextPage'] = $areas->currentPage() + 1 > $areas->lastPage() ? $areas->lastPage() : $areas->currentPage() + 1;
        $this->paginationPaging['prevPage'] = $areas->currentPage() - 1 < 1 ? 1 : $areas->currentPage() - 1;


        $fodata = FieldOfficer::where('Fname', 'like', "%{$this->searchfokeyword}%")
            ->orWhere('Mname', 'like', "%{$this->searchfokeyword}%")
            ->orWhere('Lname', 'like', "%{$this->searchfokeyword}%")
            ->get();

        $this->folist = $fodata->map(function ($officer) {
            return [
                'FOID' => $officer->FOID,
                'Fname' => $officer->Fname,
                'Mname' => $officer->Mname,
                'Lname' => $officer->Lname,
            ];
        });     

        return view('livewire.maintenance.field-area.field-area');
    }


}
