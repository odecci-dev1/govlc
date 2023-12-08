<?php

namespace App\Http\Livewire\Reports\ReleaseReport;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ReleaseReport extends Component
{
    public $datestart;
    public $dateend;
    public $data;

    public function mount(){
        $this->dateend = date('Y-m-d');      
        $this->datestart = date('Y-m-d', strtotime("-6 days"));
    }

    public function render()
    {      
        $input = [
                    'page' => 1,
                    'pageSize' => 1000,
                    'datefrom' => $this->datestart,
                    'dateto' => $this->dateend,
                 ];
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Reports/Reports_ReleasingList', $input);  
        $this->data = $data->json();     
        //dd($this->data); 
        return view('livewire.reports.release-report.release-report');
    }
}
