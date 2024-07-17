<?php

namespace App\Http\Livewire\Maintenance\FieldArea;

use App\Models\Area;
use App\Models\FieldOfficer;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;
use Illuminate\Support\Collection;

class FieldArea extends Component
{

    use Common;

    public $AreaID = '';
    public $keyword = '';
    public $usertype;
        
    public $Area;
    public $FOID;
    public $fullname;
    public $selectedLocations;

    public $keywordunassigned = '';  
    public $unassignedLocations;
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
            'Area' => 'required',
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
            'selectedLocations.required' => 'Please select locations from unassigned',
            'FOID.required' => 'Please select a field officer',
        ];
        
        return $messages;
    }

    public function store()
    {
        $this->validate();

        $locations = [];
        if (count($this->selectedLocations) > 0) {
            foreach ($this->selectedLocations as $sel) {
                $locations[] = $sel['City'];
            }
        }

        $locationsString = implode(' | ', $locations);

        $area = Area::create([
            'Area' => $this->Area,
            'FOID' => $this->FOID,
            'City' => $locationsString,
            'Status' => 1,
            'DateCreated' => now(),
            'DateUpdated' => NULL,
        ]);

        foreach ($this->selectedLocations as $sel) {
            Area::where('City', $sel['City'])->update([
                'FOID' => $this->FOID,
                'Status' => 2
            ]);
        }

        foreach ($this->selectedLocations as $sel) {
            Area::where('City', $sel['City'])->delete();
        }

        $this->removeAssignedLocations();

        return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully saved!');
    }

    // public function update()
    // {
    //     $this->validate();

    //     $locations = [];           
    //     if(count($this->selectedLocations) > 0){
    //         foreach($this->selectedLocations as $sel){                    
    //             $locations[] = $sel['City'];
    //         }
    //     } 

    //     $locationsString = implode(' | ', $locations);

    //     $area = Area::where('AreaID', $this->AreaID);
        
    //     if ($area) {
    //         $area->update([
    //             'Area' => $this->Area,
    //             'FOID' => $this->FOID,
    //             'City' => $locationsString,
    //             'Status' => 1,
    //         ]);
    //         $this->removeAssignedLocations();
    //         session()->flash('mmessage', 'Field area successfully updated');
    //     } else {
    //         session()->flash('mmessage', 'Area not found');
    //     }

    //     return redirect()->to('/maintenance/fieldarea');
    // }

    // public function update()
    // {
    //     $this->validate();

    //     $locations = [];
    //     if (count($this->selectedLocations) > 0) {
    //         foreach ($this->selectedLocations as $sel) {
    //             $locations[] = $sel['City'];
    //         }
    //     }

    //     $locationsString = implode(' | ', $locations);

    //     $area = Area::where('AreaID', $this->AreaID)->first();

    //     if ($area) {
    //         // Get the current locations for the area
    //         $currentLocations = explode(' | ', $area->City);

    //         // Find removed locations
    //         $removedLocations = array_diff($currentLocations, $locations);

    //         // Update the area
    //         $area->update([
    //             'Area' => $this->Area,
    //             'FOID' => $this->FOID,
    //             'City' => $locationsString,
    //             'Status' => 1,
    //         ]);

    //         // Update removed locations to be unassigned
    //         Area::whereIn('City', $removedLocations)->update(['FOID' => null]);

    //         // Update selected locations
    //         foreach ($this->selectedLocations as $sel) {
    //             Area::where('City', $sel['City'])->update(['FOID' => $this->FOID]);
    //         }

    //         session()->flash('mmessage', 'Field area successfully updated');
    //     } else {
    //         session()->flash('mmessage', 'Area not found');
    //     }

    //     return redirect()->to('/maintenance/fieldarea');
    // }

    // public function update()
    // {
    //     $this->validate();

    //     $locations = [];
    //     if (count($this->selectedLocations) > 0) {
    //         foreach ($this->selectedLocations as $sel) {
    //             $locations[] = $sel['City'];
    //         }
    //     }

    //     $locationsString = implode(' | ', $locations);

    //     $area = Area::where('AreaID', $this->AreaID)->first();

    //     if ($area) {
    //         // Get the current locations for the area
    //         $currentLocations = explode(' | ', $area->City);

    //         // Find removed locations
    //         $removedLocations = array_diff($currentLocations, $locations);

    //         // Update the area
    //         $area->update([
    //             'Area' => $this->Area,
    //             'FOID' => $this->FOID,
    //             'City' => $locationsString,
    //             'Status' => 1,
    //         ]);

    //         // Create new unassigned location entries for removed locations if not already existing
    //         foreach ($removedLocations as $removedCity) {
    //             $existingUnassigned = Area::where('City', $removedCity)
    //                 ->whereNull('FOID')
    //                 ->first();

    //             if (!$existingUnassigned) {
    //                 Area::create([
    //                     'Area' => null,
    //                     'FOID' => null,
    //                     'City' => $removedCity,
    //                     'Status' => 1,
    //                     'DateCreated' => now(),
    //                     'DateUpdated' => now(),
    //                 ]);
    //             }
    //         }

    //         foreach ($this->selectedLocations as $sel) {
    //             Area::where('City', $sel['City'])->delete();
    //         }

    //         session()->flash('mmessage', 'Field area successfully updated');
    //     } else {
    //         session()->flash('mmessage', 'Area not found');
    //     }

    //     return redirect()->to('/maintenance/fieldarea');
    // }

    public function update()
    {
        $this->validate();

        $locations = [];
        if (count($this->selectedLocations) > 0) {
            foreach ($this->selectedLocations as $sel) {
                $locations[] = trim($sel['City']);
            }
        }

        $locationsString = implode(' | ', $locations);

        $area = Area::where('AreaID', $this->AreaID)->first();

        if ($area) {
            // Get the current locations for the area
            $currentLocations = array_map('trim', explode(' | ', $area->City));

            // Find removed locations
            $removedLocations = array_diff($currentLocations, $locations);


            $data = [
                'Area' => $area->Area,
                'FOID' => $area->FOID,
                'City' => $locationsString,
                'Status' => 1,
                'DateCreated' => $area->DateCreated,
                'DateUpdated' => now(),
            ];

            // dd($data);
            // Update the area with the remaining locations
            $area->update($data);

            // Create new unassigned location entries for removed locations if not already existing
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

            // Update selected locations
            foreach ($this->selectedLocations as $sel) {
                Area::where('City', $sel['City'])->update(['FOID' => $this->FOID]);
            }

            session()->flash('mmessage', 'Field area successfully updated');
        } else {
            session()->flash('mmessage', 'Area not found');
        }

        return redirect()->to('/maintenance/fieldarea');
    }

    public function trash($AreaID)
    {
        $area = Area::where('AreaID', $AreaID);
        $area->update([
            'Status' => 2,
            'DateUpdated' => now(),
        ]);

        return redirect()->to('/maintenance/fieldarea')->with('mmessage', 'Field area successfully trashed');   
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

    public function selectFO($FOID, $name){
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

    // public function resetFields(){
    //     $this->AreaID = '';
    //     $this->Area = null;
    //     $this->FOID = null;
    //     $this->fullname = null;    
    //     $this->selectedLocations = collect([]);
    
    //     if($this->unassignedLocations){
    //         foreach ($this->unassignedLocations as $key => $value) {
    //             if($value['Status'] == 1){
    //                 unset($this->unassignedLocations[$key]);   
    //             }
    //         }
    //     }
    // }

    public function resetFields()
    {
        $this->AreaID = '';
        $this->Area = null;
        $this->FOID = null;
        $this->fullname = null;


        $addedLocations = collect($this->selectedLocations)->diff($this->initialSelectedLocations)->all();

        $addedCityNames = array_map(function ($loc) {
            return $loc['City'];
        }, $addedLocations);

        $this->unassignedLocations = array_merge($this->unassignedLocations, array_filter($addedLocations, function ($loc) use ($addedCityNames) {
            return in_array($loc['City'], $addedCityNames) && $loc['Status'] == 1;
        }));

        $this->selectedLocations = $this->initialSelectedLocations;

        $this->initialSelectedLocations = [];
    }

    public function removeAssignedLocations()
    {
        $this->unassignedLocations = array_filter($this->unassignedLocations, function ($loc) {
            return !in_array($loc, $this->selectedLocations);
        });
    }

    public function setPage($page = 1){
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

        $fodata = FieldOfficer::where('Status', 1)
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
