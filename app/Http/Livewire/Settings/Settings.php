<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Settings extends Component
{
    public $monthly_target;
    public $company_number;
    public $company_name;
    public $company_address;
    public $company_email;
    public $display_reset;

    public $data;

    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Settings/SettingList'); 
        
        $this->data = $data->json();
        // "monthlyTarget" => "200000"
        // "displayReset" => "1"
        // "companyCno" => "1"
        // "companyAddress" => "1"
        // "companyEmail" => "1"
        //dd($this->data);
        if(isset($this->data[0])){
            $this->monthly_target = $this->data[0]['monthlyTarget'];
            $this->company_address = $this->data[0]['companyEmail'];
            $this->company_number = $this->data[0]['companyCno'];
            $this->company_email = $this->data[0]['companyAddress'];
            $this->display_reset = $this->data[0]['displayReset'];
            $this->company_name = '';
        }      
        return view('livewire.settings.settings');
    }
}
