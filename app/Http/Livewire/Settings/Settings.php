<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;
use App\Models\Settings as Setting;

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

        
        // $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Settings/UpdateSettings', $data);        
        // $apiresp = $crt->getStatusCode();        
        
        $update = Setting::where('Id',1)->update([
            "MonthlyTarget" =>  $this->monthly_target,
            "DisplayReset" =>  $this->display_reset,
            "CompanyCno" =>  $this->company_number,
            "CompanyAddress" => $this->company_address,
            "CompanyEmail" => $this->company_email
            
        ]);
        if($update){     
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
        // $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Settings/SettingList'); 
        
        // $this->data = $data->json();     
        // if(isset($this->data[0])){
            //dd($this->data[0]);

            $settings = Setting::where('Id',1)->first();
            $this->monthly_target = $settings->MonthlyTarget;
            $this->company_address = $settings->CompanyAddress;
            $this->company_number = $settings->CompanyCno;
            $this->company_email = $settings->CompanyEmail;
            $this->display_reset = $settings->DisplayReset;
            $this->company_name = 'Gold One Victory';
        //}      
    }

    public function render()
    {
        
        return view('livewire.settings.settings');
    }
}
