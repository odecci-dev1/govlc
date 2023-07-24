<?php

namespace App\Http\Livewire\Maintenance\FieldOfficer;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class FieldOfficerlist extends Component
{
    public $list = [];
    public $keyword = '';

    public function render()
    {
        // $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldOfficer/OfficerList');  
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/FieldOfficerFilter', ['fullname' => $this->keyword]);  
        $this->list = $data->json();       
        return view('livewire.maintenance.field-officer.field-officerlist');
    }
}
