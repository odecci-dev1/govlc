<?php

namespace App\Http\Livewire;

use App\Models\Members;
use Illuminate\Support\Facades\Http;

use Livewire\Component;

class Dashboard extends Component
{
    public $data;
    public $area = [];
    public $selectarea = '';
    public $selectdays = 30;
    public $activemembers = [];

    public $topcollectibles = [];
    public $toplapses = [];
    public $activecollections = [];

    public function mount()
    {
        $data = $this->getData();
        
        $mountData = collect($data)->map(function ($d) {
            return [
                'activeMemberCount' => $d['members']->count(),
                // TODO: In-progress
                'totalLoanBalance' => 0,
                'totalInterest' => 0,   
                'totalLoanCollection' => 0,
                'totalAdvancePayment' => 0,
                'totalOtherDeductions' => 0,
                'totalActiveStanding' => 0, 
                'totalFullPayment' => 0,    
                'totalCR' => 0,             
                'totalEndingActiveMember' => 0
            ];
        })->first(); 

        $this->data = $mountData;


        // dd($this->data);
    }

    public function render()
    {
        // TODO: In-progress
        // $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Dashbaord/DashboaredView');   
        // $this->data = isset($data->json()[0]) ? $data->json()[0] : [];

        $getarea =  Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldArea/AreasList');      
        $this->area = $getarea->json();      
        
        $topcollectibles =  Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Dashbaord/TopCollectibles');      
        $this->topcollectibles = $topcollectibles->json();  
        
        $toplapses =  Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Dashbaord/TotalLapsesAreas');      
        $this->toplapses = $toplapses->json();  

        $activecollections =  Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Dashbaord/ActiveCollection');      
        $this->activecollections = $activecollections->json();         

        return view('livewire.dashboard');
    }

    public function getData()
    {
        // TODO: In-progress

        $members = Members::query()->where('Status', 1)->get();
        $data[] = [
            'members' => $members,
            'totalSample' => 50,
        ];

        return $data;
    }
}
