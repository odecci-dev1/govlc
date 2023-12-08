<?php

namespace App\Http\Livewire\Reports\CollectionReport;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CollectionReport extends Component
{
    public $datestart;
    public $dateend;
    public $res;

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
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Reports/Reports_CollectionList', $input);  
        $this->res = collect($data->json());        
        return view('livewire.reports.collection-report.collection-report');
    }
}
