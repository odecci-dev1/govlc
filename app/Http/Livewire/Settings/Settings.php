<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Settings extends Component
{
    public $monthly_target;
    public $company_number;
    public $company_address;
    public $company_email;

    public function render()
    {
        // $modules = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/UserRegistration/GetModuleList'); 
        
        // $modules = $modules->json();
        // dd($modules);      
        return view('livewire.settings.settings');
    }
}
