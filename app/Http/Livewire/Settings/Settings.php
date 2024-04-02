<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;

class Settings extends Component
{
    use Common;
    public $monthly_target;
    public $company_number;
    public $company_name;
    public $company_address;
    public $company_email;
    public $display_reset;

    public $data;

    public function update(){
        $data = [
                    "id" => "1",
                    "monthlyTarget" =>  $this->monthly_target,
                    "displayReset" =>  $this->display_reset,
                    "companyCno" =>  $this->company_number,
                    "companyAddress" => $this->company_address,
                    "companyEmail" => $this->company_email
                ];
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Settings/UpdateSettings', $data);        
        $apiresp = $crt->getStatusCode();                
        if($apiresp == 200){     
            return redirect()->to('/settings')->with('mmessage', 'Settings successfully updated');    
        }
        else{
            $this->resetValidation();         
            session()->flash('erroraction', 'update');
            session()->flash('errormessage', 'Operation Failed. Retry ?');                                
            $this->emit('EMIT_ERROR_ASKING_DIALOG');
        }            
    }

    public function mount(){
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Settings/SettingList'); 
        
        $this->data = $data->json();     
        if(isset($this->data[0])){
            //dd($this->data[0]);
            $this->monthly_target = $this->data[0]['monthlyTarget'];
            $this->company_address = $this->data[0]['companyAddress'];
            $this->company_number = $this->data[0]['companyCno'];
            $this->company_email = $this->data[0]['companyEmail'];
            $this->display_reset = $this->data[0]['displayReset'];
            $this->company_name = '';
        }      
    }

    public function render()
    {
        
        return view('livewire.settings.settings');
    }
}
