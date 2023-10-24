<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

class Settings extends Component
{
    public $monthly_target;
    public $company_number;
    public $company_address;
    public $company_email;

    public function render()
    {
        return view('livewire.settings.settings');
    }
}
