<?php

namespace App\Http\Livewire;

use App\Models\Application;
use App\Models\Area;
use App\Models\CollectionArea;
use App\Models\CollectionAreaMember;
use App\Models\LoanDetails;
use App\Models\LoanHistory;
use App\Models\Members;
use App\Models\MembersSavings;
use App\Models\Settings;
use App\Models\TermsOfPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
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
        // $this->data = Cache::remember('dashboard_data', 1, function () {
        //     return $this->prepareData();
        // });
     
        
        $this->activeCollectionData();
        //  dd($this->topcollectibles);
        $this->topcollectibles = $this->computeTopValues('CollectedAmount');
        $this->toplapses = $this->computeTopValues('LapseAmount');
        $this->data = $this->prepareData();
        return $this->data;
        //return $this->prepareData();
       
    }

    public function render()
    {
        // TODO: In-progress
        // $activecollections =  Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Dashbaord/ActiveCollection');      
        // $this->activecollections = $activecollections->json();   
        $this->area = Area::where('Status',1)->whereNotNull('Area')->get();      
        $this->activeCollectionData();



        return view('livewire.dashboard');
    }

    private function prepareData()
    {
       
        $members = Members::select('id', 'Status')->where('Status', 1)->get();
        $collectionAreaMembers = CollectionAreaMember::select('DateCollected', 'CollectedAmount', 'AdvancePayment')->get();
        $loanDetails = LoanDetails::select('ApprovedLoanAmount', 'ApproveedInterest', 'ApprovedNotarialFee','ApprovedDailyAmountDue','TermsOfPayment')->where('Status','=',14)->get();
        $totalMemberSavings = MembersSavings::select('TotalSavingsAmount')->get();
        
        $loanHistory = LoanHistory::select('OutstandingBalance')->get();
        $application = Application::select('Status')->get();
        $settings = Settings::select('MonthlyTarget')->first();

        $currentDate = Carbon::now();
        $startDay = $currentDate->copy()->startOfDay();
        $endDay = $currentDate->copy();
        $currentMonth = $currentDate->format('Y-m');
        $previousMonth = $currentDate->subMonth()->format('Y-m');

        $activeMemberCount = $members->count();
        $totalLoanInsurance =0;
        $totalLifeInsurance = 0;
        
        $totalOfNewAccounts = 0;
       
        foreach($members as $member){
            $appCount = Application::where('MemId',$member->id)->where('Status','!=',11)->get()->count();
            if($appCount == 1){
                $totalOfNewAccounts += 1;
            }
        }
    
        foreach($loanDetails as $loanDetail){
             $termsOfPayment = TermsOfPayment::where('Id',$loanDetail->TermsOfPayment)->first();
             $totalLoanInsurance += $termsOfPayment->LoanInsuranceAmountType == 1 ? $termsOfPayment->LoanInsuranceAmount * $loanDetail->ApprovedLoanAmount:$termsOfPayment->LoanInsuranceAmount;
             $totalLifeInsurance += $termsOfPayment->LifeInsuranceAmountType == 1 ? $termsOfPayment->LifeInsuranceAmount * $loanDetail->ApprovedLoanAmount:$termsOfPayment->LifeInsuranceAmount;
        }
        $totalFullPayments = 0;
        foreach($loanHistory as $history){
            if($history->OutstandingBalance == 0){
                $totalFullPayments += 1;
            }
        }
       
        $dailyCollections = $collectionAreaMembers
            ->whereBetween('DateCollected', [$startDay, $endDay])
            ->groupBy(function ($item) {
                return $item->DateCollected->format('Y-m-d');
            })
            ->map(function ($group) {
                return $group->sum('CollectedAmount');
            });

        $monthlyCollection = $collectionAreaMembers
            ->groupBy(function ($item) {
                return Carbon::parse($item->DateCollected)->format('Y-m');
            })
            ->map(function ($group) {
                return $group->sum('CollectedAmount');
            });
       
        $previousMonthCollected = $monthlyCollection[$previousMonth] ?? 0;
        $totalCollected = $monthlyCollection[$currentMonth] ?? 0;

        $totalAmount = $loanDetails->sum('ApprovedLoanAmount')+ $loanDetails->sum('ApproveedInterest');
        $totalLoanBalance =$loanHistory->sum('OutstandingBalance');
        
        

        $totalInterest = $loanDetails->sum('ApproveedInterest');
        $totalAdvancePayment = $collectionAreaMembers->sum('AdvancePayment');
        $totalNotarialFee = $loanDetails->sum('ApprovedNotarialFee');
        $totalOtherDeductions = $totalLoanInsurance + $totalLifeInsurance + $totalNotarialFee;
    
        $totalSavingsOutstanding = $totalMemberSavings->sum('TotalSavingsAmount');
        $totalDailyOverallCollection = $loanDetails->sum('ApprovedDailyAmountDue');
       
        $totalNewAccountsOverall = $totalOfNewAccounts;
        $totalApplicationforApproval = $application->where('Status', 9)->count();
        $totalIncome = $settings->MonthlyTarget;

        $totalIncomePercentage = $totalIncome ? ($totalCollected / $totalIncome) * 100 : 0;
        $totalDaysLeft = Carbon::now()->endOfMonth()->diffInDays($currentDate);
        $totalPercentOfLastEntry = $totalIncome ? ($totalCollected / $totalIncome) * 100 : 0;
        $targetStatus = $previousMonthCollected >= $totalIncome;
     
        return  [
            'activeMemberCount' => $activeMemberCount,
            'totalLoanBalance' => $totalLoanBalance,
            'totalInterest' => $totalInterest,
            'totalLoanCollection' => $totalCollected,
            'totalAdvancePayment' => $totalAdvancePayment,
            'totalOtherDeductions' => $totalOtherDeductions,
            'totalActiveStanding' => 0,
            'totalFullPayment' => $totalFullPayments,
            'totalCR' => 0,
            'totalEndingActiveMember' => 0,
            'totalSavingsOutstanding' => $totalSavingsOutstanding,
            'totalDailyOverallCollection' => $totalDailyOverallCollection,
            'totalNewAccountsOverall' => $totalNewAccountsOverall,
            'totalApplicationforApproval' => $totalApplicationforApproval,
            'totalIncome' => $totalIncome,
            'totalIncomePercentage' => $totalIncomePercentage,
            'totalDailyCollection' => 0,
            'totalDaysLeft' => $totalDaysLeft,
            'totalPercentOfLastEntry' => $totalPercentOfLastEntry,
            'targetStatus' => $targetStatus,
            'activeMember' => 0,
            'totalLapsesArea' => 0,
            'topCollectiblesAreas' => 0,
            'areaActiveCollection' => 0,

        
        ];
    }

    private function activeCollectionData()
    {
        $activeAreas = Area::with(['collectionAreas'])
            ->where('Status', 1)
            ->whereNotNull('FOID')
            ->get();
        
        $newAccounts = Application::with(['collectionareamember', 'loanhistory'])
            ->where('Status', 7)
            ->get();

        $result = $activeAreas->map(function ($area) use ($newAccounts) {
            // Sum collected amounts for the area
            $collections = CollectionAreaMember::where('Area_RefNo', $area->Area_RefNo)->get();
            $sumCollectedAmount = $collections->sum('CollectedAmount');
    
            // Count new accounts for the area
            $newAccountsCount = $newAccounts->filter(function ($account) use ($area) {
              //  dd($area->Area_RefNo);
                // dd($area->collectionAreas->pluck('Area_RefNo'));

                // return $account->collectionareamember->Area_RefNo === $area->collectionAreas->Area_RefNo;
            })->count();
            // dd($newAccounts);
    
            return [
                'areaName' => $area->Area,
                'activeCollection' => $sumCollectedAmount,
                'newAccounts' => $newAccountsCount,
            ];
        });

        return $result->all();
    }


      // Area	   Active Collection	New Account	  # NPS	  Past Due Collection
    // Next is get activeCollection from the sum of the OutstandingBalance of member per Area. And then count the newAccount from the Application with a Status of 7 meaning new application. And then for the numberOfNoPayment count the CollectionArea that has Collection_Status of 2 meaning no payment from the CollectionArea. Next is PastDueCollection you can get it from LoanHistory OutstandingBalance and the multiply it by 20% + the Outstanding Balance. All this should be is monthly data per Area.

    private function computeTopValues($sumType)
    {
        $activeAreas = Area::where('Status', 1)
            ->whereNotNull('FOID')
            ->get();

        $topValues = [];

        foreach ($activeAreas as $area) {
            $sumAmount = CollectionArea::where('AreaID', $area->AreaID)
                ->where('Collection_Status', 7)
                ->with('areaMembers')
                ->get()
                ->sum(function($collectionArea) use ($sumType) {
                    return $collectionArea->areaMembers->sum($sumType);
                });

            if ($sumAmount > 0) {
                $topValues[] = [
                    'areaName' => $area->Area,
                    'amount' => $sumAmount,
                ];
            }
        }

        usort($topValues, function ($a, $b) {
            return $b['amount'] <=> $a['amount'];
        });

        return $topValues;
    }

}
