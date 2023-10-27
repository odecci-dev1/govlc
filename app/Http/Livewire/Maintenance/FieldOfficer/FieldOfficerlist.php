<?php

namespace App\Http\Livewire\Maintenance\FieldOfficer;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;

class FieldOfficerlist extends Component
{

    use Common;
    public $usertype;
    public $list = [];
    public $keyword = '';

    public function archive($foid){       
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/DeleteFO', [ 'foid' => $foid ]);              
        return redirect()->to('/maintenance/fieldofficer/list')->with(['mmessage'=> 'Filed officer has been archived', 'mword'=> 'Success']);    
    }

    public function mount(){
        $this->usertype = session()->get('auth_usertype'); 
    }
    
    public function render()
    { 
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldOfficer/FieldOfficerFilterPaginate', ['fullname' => $this->keyword, 'page' => 1, 'pageSize' => 10000]);  
        // dd($data);
        $this->list = $data->json();        
        //dd($this->list);
        return view('livewire.maintenance.field-officer.field-officerlist');
    }
}
