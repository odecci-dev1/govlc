<?php

namespace App\Http\Livewire;

use App\Models\Application;
use App\Models\CollectionAreaMember;
use App\Models\LoanDetails;
use App\Models\Members;
use App\Models\Settings;
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
                'activeMemberCount' => $d['activeMemberCount'],
                'totalLoanBalance' => $d['totalLoanBalance'],
                'totalInterest' => $d['totalInterest'],   
                'totalLoanCollection' => $d['totalLoanCollection'],
                'totalAdvancePayment' => $d['totalAdvancePayment'],
                'totalOtherDeductions' => $d['totalOtherDeductions'],
                'totalActiveStanding' => $d['totalActiveStanding'], 
                'totalFullPayment' => $d['totalFullPayment'],    
                'totalCR' => $d['totalCR'],             
                'totalEndingActiveMember' => $d['totalEndingActiveMember'],
                'totalSavingsOutstanding' => $d['totalSavingsOutstanding'],
                'totalDailyOverallCollection' => $d['totalDailyOverallCollection'],
                'totalNewAccountsOverall' => $d['totalNewAccountsOverall'],
                'totalApplicationforApproval' => $d['totalApplicationforApproval'],
                'totalIncome' => $d['totalIncome'],
                'totalIncomePercentage' => $d['totalIncomePercentage'],
                'totalDailyCollection' => $d['totalDailyCollection'],
                'totalDaysLeft' => $d['totalDaysLeft'],
                'totalPercentOfLastEntry' => $d['totalPercentOfLastEntry'],
                'targetStatus' => $d['targetStatus'],
                'activeMember' => $d['activeMember'],
                'totalLapsesArea' => $d['totalLapsesArea'],
                'topCollectiblesAreas' => $d['topCollectiblesAreas'],
                'areaActiveCollection' => $d['areaActiveCollection'],
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
        // dd($data->json());

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

        $members = Members::all();
        $collectionAreaMember = CollectionAreaMember::all();
        $loanDetails = LoanDetails::all();
        $application = Application::all();
        $settings = Settings::all()->first();

        // dd($settings);

        $activeMemberCount = $members->where('Status', 1)->count();

        $totalCollected = $collectionAreaMember->sum('CollectedAmount');
        $totalAmount = $loanDetails->sum('ApprovedLoanAmount');
        $totalLoanBalance =  $totalAmount - $totalCollected;
        
        $totalInterest = $loanDetails->sum('ApproveedInterest');
        $totalLoanCollection = $totalCollected;
        $totalAdvancePayment = $collectionAreaMember->sum('AdvancePayment');

        $totalNotarialFee = $loanDetails->sum('ApprovedNotarialFee');

        $totalOtherDeductions = $totalInterest + $totalNotarialFee;
        $totalActiveStanding = 0;
        $totalFullPayment = $collectionAreaMember->where('CollectedAmount', 0.00)->count();
        $totalCR = 0;
        $totalEndingActiveMember = 0;

        $totalSavingsOutstanding = $totalLoanBalance;
        $totalDailyOverallCollection = $loanDetails->sum('ApproveedDailyAmountDue');
        $totalNewAccountsOverall = $application->where('Status', 7)->count();
        $totalApplicationforApproval = $application->where('Status', 9)->count();
        $totalIncome = $settings->MonthlyTarget;
        $totalIncomePercentage = 0;
        $totalDailyCollection = 0;
        $totalDaysLeft = 0;
        $totalPercentOfLastEntry = 0;
        $targetStatus = 0;
        $activeMember = 0;
        $totalLapsesArea = 0;
        $topCollectiblesAreas = 0;
        $areaActiveCollection = 0;

        
        $data[] = [
            'activeMemberCount' => $activeMemberCount,
            'totalLoanBalance' => $totalLoanBalance,
            'totalInterest' => $totalInterest,
            'totalLoanCollection' => $totalLoanCollection,
            'totalAdvancePayment' => $totalAdvancePayment,
            'totalOtherDeductions' => $totalOtherDeductions,
            'totalActiveStanding' => $totalActiveStanding,
            'totalFullPayment' => $totalFullPayment,
            'totalCR' => $totalCR,
            'totalEndingActiveMember' => $totalEndingActiveMember,
            'totalSavingsOutstanding' => $totalSavingsOutstanding,
            'totalDailyOverallCollection' => $totalDailyOverallCollection,
            'totalNewAccountsOverall' => $totalNewAccountsOverall,
            'totalApplicationforApproval' => $totalApplicationforApproval,
            'totalIncome' => $totalIncome,
            'totalIncomePercentage' => $totalIncomePercentage,
            'totalDailyCollection' => $totalDailyCollection,
            'totalDaysLeft' => $totalDaysLeft,
            'totalPercentOfLastEntry' => $totalPercentOfLastEntry,
            'targetStatus' => $targetStatus,
            'activeMember' => $activeMember,
            'totalLapsesArea' => $totalLapsesArea,
            'topCollectiblesAreas' => $topCollectiblesAreas,
            'areaActiveCollection' => $areaActiveCollection,
        ];

        // array:1 [▼ 
        //     0 => array:24 [▼
        //         "activeMemberCount" => 111
        //         "totalLoanBalance" => 980309
        //         "totalInterest" => 8600
        //         "totalLoanCollection" => 860
        //         "totaolAdvancePayment" => 860
        //         "totalOtherDeductions" => 9819
        //         "totalActiveStanding" => 0
        //         "totalFullPayment" => 0
        //         "totalCR" => 0
        //         "totalEndingActiveMember" => null
        //         "totalSvaingsOutstanding" => 151834
        //         "totalDailyOverallCollection" => 860
        //         "totalNewAccountsOverall" => 7
        //         "totalApplicationforApproval" => 0
        //         "totalIncome" => 200000
        //         "totalIncomePercentage" => 207.7875
        //         "totalDailyCollection" => 415575
        //         "totalDaysLeft" => null
        //         "totalPercentOfLastEntry" => null
        //         "targetStatus" => null
        //         "activeMember" => 111
        //         "totalLapsesArea" => null
        //         "topCollectiblesAreas" => null
        //         "areaActiveCollection" => null
        //     ]
        // ]
        return $data;
    }
}
