<?php

namespace App\Http\Livewire\Maintenance\FieldArea;

use App\Models\Area;
use App\Models\FieldOfficer;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class FieldArea extends Component
{

    use Common;

    public $AreaID = '';
    public $keyword = '';
    public $usertype;
        
    public $Area;
    public $FOID;
    public $fullname;
    public $selectedLocations = [];

    public $keywordunassigned = '';  
    public $unassignedLocations = [];
    public $initialSelectedLocations = [];
    
    public $areas;
    public $folist;

    public $searchfokeyword = '';

    public $paginate = [];
    public $paginationPaging = [];

    public $paginateUnassigned = [];
    public $paginationPagingUnassigned = [];

    public function rules()
    {
        $rules = [
            'Area' => 'required|unique:tbl_Area_Model,Area,'.$this->AreaID.',Id',
            'FOID' => 'required',
            'selectedLocations' => 'required',
            'fullname' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'Area.required' => 'Please enter an area name',
            'Area.unique' => 'Area already exist',
            'selectedLocations.required' => 'Please select locations from unassigned',
            'FOID.required' => 'Please select a field officer',
        ];
        
        return $messages;
    }
    
    public function selectArea($AreaID)
    {
        $this->resetFields();

        $area = Area::with('fieldOfficer')->where('AreaID', $AreaID)->first();

        if ($area) {
            $this->AreaID = $area->AreaID;
            $this->Area = $area->Area; 
            $this->FOID = $area->FOID; 

            if ($area->fieldOfficer) {
                $this->fullname = $area->fieldOfficer->Lname . ', ' . $area->fieldOfficer->Fname . ' ' . strtoupper(substr($area->fieldOfficer->Mname , 0, 1)) . '.';
            } else {
                $this->fullname = 'Field Officer Not Assigned';
            }

            $locations = explode('|', $area->City);

            foreach ($locations as $loc) {
                $this->selectedLocations[] = ['City' => $loc, 'Status' => 1];
            }

            $this->initialSelectedLocations = $this->selectedLocations;

        } else {
            session()->flash('mmessage', 'Area not found');
        }
    }

    public function openSearchOfficer()
    {
        $this->emit('openSearchOfficerModal', [
            'data' => '',
            'title' => 'This is the title',
            'message' => 'This is the message',
        ]);
    }

    public function selectFO($FOID, $name)
    {
        $this->FOID = $FOID;
        $this->fullname = $name;
        $this->emit('closeSearchFOModal', ['data' => '' , 'title' => 'This is the title', 'message' => 'This is the message']);
    }

    public function addToSelected($location, $stat)
    {
        $this->selectedLocations = is_array($this->selectedLocations) ? $this->selectedLocations : [];
        $this->unassignedLocations = is_array($this->unassignedLocations) ? $this->unassignedLocations : [];

        $this->selectedLocations[] = ['City' => $location, 'Status' => $stat];

        $this->unassignedLocations = array_filter($this->unassignedLocations, function($unassigned) use ($location) {
            return $unassigned['City'] !== $location;
        });
    }

    public function removeFromSelected($location, $stat)
    {
        $this->selectedLocations = is_array($this->selectedLocations) ? $this->selectedLocations : [];
        $this->unassignedLocations = is_array($this->unassignedLocations) ? $this->unassignedLocations : [];

        $this->unassignedLocations[] = ['City' => $location, 'Status' => $stat];

        $this->selectedLocations = array_filter($this->selectedLocations, function($selected) use ($location) {
            return $selected['City'] !== $location;
        });
    }

    public function resetFields()
    {
        $this->AreaID = '';
        $this->Area = null;
        $this->FOID = null;
        $this->fullname = null;
        $this->selectedLocations = [];
    }

    public function removeAssignedLocations()
    {
        $this->unassignedLocations = array_filter($this->unassignedLocations, function ($loc) {
            return !in_array($loc, $this->selectedLocations);
        });
    }

    public function store()
    {
        $this->validate();


        $locations = array_map('trim', array_column($this->selectedLocations, 'City'));

        $locationsString = implode('|', $locations);

        $area = Area::create([
            'Area' => $this->Area,
            'FOID' => $this->FOID,
            'City' => $locationsString,
            'Status' => 1,
            'DateCreated' => now(),
            'DateUpdated' => NULL,
        ]);

        foreach ($this->selectedLocations as $sel) {
            Area::where('City', $sel['City'])
                ->whereNull('FOID')
                ->delete();
        }

        $this->removeAssignedLocations();

        return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully saved!');
    }

    public function update()
    {
        $this->validate();

        $locations = array_map('trim', array_column($this->selectedLocations, 'City'));
        $locationsString = implode('|', $locations);

        $areaUpdate = Area::where('AreaID', $this->AreaID);

        if ($areaUpdate) {
            $area = Area::where('AreaID', $this->AreaID)->first();

            $currentLocations = array_map('trim', explode('|', $area->City));
            $removedLocations = array_diff($currentLocations, $locations);

            $data = [
                'Area' => $this->Area,
                'FOID' => $this->FOID,
                'City' => $locationsString,
                'Status' => 1,
                'DateCreated' => $area->DateCreated,
                'DateUpdated' => now(),
            ];

            $areaUpdate->update($data);

            foreach ($removedLocations as $removedCity) {
                $existingUnassigned = Area::where('City', $removedCity)
                    ->whereNull('FOID')
                    ->first();

                if (!$existingUnassigned) {
                    Area::create([
                        'Area' => null,
                        'FOID' => null,
                        'City' => $removedCity,
                        'Status' => 1,
                        'DateCreated' => now(),
                        'DateUpdated' => now(),
                    ]);
                }
            }

            foreach ($this->selectedLocations as $sel) {
                Area::where('City', $sel['City'])
                    ->whereNull('FOID')
                    ->delete();
            }

            $this->resetValidation();
            session()->flash('mmessage', 'Field area successfully updated');
        } else {
            session()->flash('mmessage', 'Area not found');
        }

        return redirect()->to('/maintenance/fieldarea');
    }

    // public function trash($AreaID)
    // {
    //     $area = Area::where('AreaID', $AreaID);
    //     $area->update([
    //         'Status' => 2,
    //         'DateUpdated' => now(),
    //     ]);

    //     return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully trashed');   
    // }

    public function trash($AreaID)
    {
        $areaUpdate = Area::where('AreaID', $AreaID);
        $area = Area::where('AreaID', $AreaID)->first();

        if ($area) {
            $areaUpdate->update([
                'Status' => 2,
                'DateUpdated' => now(),
            ]);

            $cities = explode('|', $area->City);
            foreach ($cities as $city) {
                Area::create([
                    'Area' => null,
                    'FOID' => null,
                    'City' => $city,
                    'Status' => 1,
                    'DateCreated' => now(),
                    'DateUpdated' => now(),
                ]);
            }

            // Optional: delete the original Area record if required
            // $areaUpdate->delete();

            return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully trashed and cities unassigned');
        } else {
            return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Area not found');
        }
    }

    public function setPage($page = 1)
    {
        $this->paginate['page'] = $page;
    }

    public function mount()
    {
        $this->usertype = session()->get('auth_usertype');
        $this->selectedLocations = collect([]);

        $unassignedLocations = Area::whereNull('FOID') 
                ->where('Status', 1)->get();

        $this->unassignedLocations = $unassignedLocations->map(function($location) {
            return [
                'City' => $location->City,
                'Status' => $location->Status
            ];
        })->toArray();

        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 10;
        $this->paginate['FilterName'] = '';
        $this->paginationPaging['totalPage'] = 0;
    }

    public function render()
    {                      
        $areasQuery = Area::whereNotNull('FOID')->where('Status', 1);

        if (!empty($this->keyword)) {
            $areasQuery->where('Area', 'like', '%' . $this->keyword . '%');
        }
        
        $areas = $areasQuery->paginate($this->paginate['pageSize'], ['*'], 'page', $this->paginate['page']);

        $this->areas = $areas->items();
        $this->paginationPaging['totalPage'] = $areas->lastPage();
        $this->paginationPaging['currentPage'] = $areas->currentPage();
        $this->paginationPaging['nextPage'] = $areas->currentPage() + 1 > $areas->lastPage() ? $areas->lastPage() : $areas->currentPage() + 1;
        $this->paginationPaging['prevPage'] = $areas->currentPage() - 1 < 1 ? 1 : $areas->currentPage() - 1;

        $fodata = FieldOfficer::doesntHave('area')
            ->where('Status', 1)
            ->where(function ($query) {
            $query->where('Fname', 'like', "%{$this->searchfokeyword}%")
                    ->orWhere('Mname', 'like', "%{$this->searchfokeyword}%")
                    ->orWhere('Lname', 'like', "%{$this->searchfokeyword}%");
        })->get();

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
