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
use App\Models\SavingsRunningBalance;
use App\Models\Settings;
use App\Models\TermsOfPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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

    public $selectedMonth;
    public $monthsTransaction;

    public $totalPercent=0;

    public function mount()
    {
        // $this->data = Cache::remember('dashboard_data', 1, function () {
        //     return $this->prepareData();
        // });
     
        
        $this->activeCollectionData();
        //  dd($this->topcollectibles);
        $this->topcollectibles = $this->computeTopValues('Collectibles');
        $this->toplapses = $this->computeTopValues('LapsePayment');
        $this->data = $this->prepareData();
        $this->activecollections = $this->activeCollectionData();

  

        return $this->data;
        //return $this->prepareData();
       
    }

   

    public function render()
    {
        // TODO: In-progress
        // $activecollections =  Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Dashbaord/ActiveCollection');      
        // $this->activecollections = $activecollections->json();   
        $this->monthsTransaction = Application::select(
            DB::raw("FORMAT(DateCreated, 'yyyy-MM') as new_date"), 
            DB::raw('YEAR(DateCreated) as year'), 
            DB::raw('MONTH(DateCreated) as month')
        )
        ->groupBy(DB::raw("FORMAT(DateCreated, 'yyyy-MM')"), DB::raw('YEAR(DateCreated)'), DB::raw('MONTH(DateCreated)'))
        ->orderBy(DB::raw('YEAR(DateCreated)'), 'DESC') // Order by year descending
        ->orderBy(DB::raw('MONTH(DateCreated)'), 'DESC') // Order by month descending
        ->get();
        $this->area = Area::where('Status',1)->whereNotNull('Area')->get();      
        $this->activeCollectionData();
        $this->data = $this->prepareData();



        return view('livewire.dashboard');
    }


 
    private function prepareData()
    {
   
        if($this->selectedMonth != "0"){
            $thisMonth = Carbon::now();
     
            $monthYear = is_null($this->selectedMonth) ?  $thisMonth->format('Y-m'):$this->selectedMonth; // Example input
    
            $startDate = Carbon::createFromFormat('Y-m', $monthYear)->startOfMonth();
            $endDate = Carbon::createFromFormat('Y-m', $monthYear)->endOfMonth();
    
            $totalActiveMember = Members::select('id', 'Status')->where('Status', 1)->whereBetween('DateCreated', [$startDate, $endDate])->get();  
            $collectionAreaMembers = CollectionAreaMember::select('DateCollected', 'CollectedAmount', 'AdvancePayment','UsedAdvancePayment','LapsePayment')->whereNotNull('Area_RefNo')->whereBetween('DateCollected', [$startDate, $endDate])->get();
            $loanDetails = LoanDetails::select('ApprovedLoanAmount', 'ApproveedInterest', 'ApprovedNotarialFee','ApprovedDailyAmountDue','TermsOfPayment')->whereIn('Status',[14,9,15])->whereBetween('DateCreated', [$startDate, $endDate])->get();
            $totalMemberSavings = SavingsRunningBalance::select('Savings')->whereBetween('Date', [$startDate, $endDate])->get();
            $application = Application::select('Status')->whereBetween('DateCreated', [$startDate, $endDate])->get();
            
            //$currentDate = Carbon::now();
            $startDay = $startDate;
            $endDay = $endDate;
           
                $currentMonth = is_null($this->selectedMonth) ? $thisMonth->format('Y-m'):$monthYear;
                $previousMonth = is_null($this->selectedMonth) ? $thisMonth->subMonth()->format('Y-m'): Carbon::createFromFormat('Y-m',  $monthYear)->subMonth()->format('Y-m');
           
        }else{
            $totalActiveMember = Members::select('id', 'Status')->where('Status', 1)->get();  
            $collectionAreaMembers = CollectionAreaMember::select('DateCollected', 'CollectedAmount', 'AdvancePayment','UsedAdvancePayment','LapsePayment')->whereNotNull('Area_RefNo')->get();
            $loanDetails = LoanDetails::select('ApprovedLoanAmount', 'ApproveedInterest', 'ApprovedNotarialFee','ApprovedDailyAmountDue','TermsOfPayment')->whereIn('Status',[14,9,15])->get();
            $totalMemberSavings = SavingsRunningBalance::select('Savings')->get();
            $application = Application::select('Status')->get();

            $currentDate = Carbon::now();
        
            $startDay = $currentDate->copy()->startOfDay();
            $endDay = $currentDate->copy();
            $currentMonth = $currentDate->format('Y-m');
            $previousMonth = $currentDate->subMonth()->format('Y-m');
      
        }
    
     
        $members = Members::select('id', 'Status')->where('Status', 1)->get();  
        $loanHistory = LoanHistory::select('OutstandingBalance')->get();
        $settings = Settings::select('MonthlyTarget')->first();

        
    //   $currentDate = Carbon::now();
        
    //         $startDay = $currentDate->copy()->startOfDay();
    //         $endDay = $currentDate->copy();
    //         $currentMonth = $currentDate->format('Y-m');
    //         $previousMonth = $currentDate->subMonth()->format('Y-m');
        
        $activeMemberCount = $members->count();
        $monthlyActiveMember = $totalActiveMember->count(); 
        $totalLoanInsurance =0;
        $totalLifeInsurance = 0;
        
        $totalOfNewAccounts = 0;
       
        foreach($members as $member){
            $appCount = Application::where('MemId',$member->id)->where('Status','=',14)->get()->count();
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
       
        // $dailyCollections = $collectionAreaMembers
        //     ->whereBetween('DateCollected', [$startDay, $endDay])
        //     ->groupBy(function ($item) {
        //         return $item->DateCollected->format('Y-m-d');
        //     })
        //     ->map(function ($group) {
        //         return $group->sum('CollectedAmount');
        //     });

        $monthlyCollection = $collectionAreaMembers
           
            ->groupBy(function ($item) {
                return Carbon::parse($item->DateCollected)->format('Y-m');
            })
            ->map(function ($group) {
                return $group->sum('CollectedAmount');
            });
   
        $previousMonthCollected = $monthlyCollection[$previousMonth] ?? 0;
        $totalCollected = $monthlyCollection[$currentMonth] ?? 0;
       // dd($totalCollected );
        $totalAmount = $loanDetails->sum('ApprovedLoanAmount')+ $loanDetails->sum('ApproveedInterest');
        $totalLoanBalance =$loanHistory->sum('OutstandingBalance');
        
        

        $totalInterest = $loanDetails->sum('ApproveedInterest');
        $lapses = $collectionAreaMembers->sum('LapsePayment') - $collectionAreaMembers->sum('UsedAdvancePayment');
        $totalAdvancePayment = $collectionAreaMembers->sum('AdvancePayment') -  $collectionAreaMembers->sum('UsedAdvancePayment')  ;
        $totalNotarialFee = $loanDetails->sum('ApprovedNotarialFee');
        $totalOtherDeductions = $totalLoanInsurance + $totalLifeInsurance + $totalNotarialFee;
    
        $totalSavingsOutstanding = $totalMemberSavings->sum('Savings');
        $totalDailyOverallCollection = $loanDetails->sum('ApprovedDailyAmountDue');
       
        $totalNewAccountsOverall = $totalOfNewAccounts;
        $totalApplicationforApproval = $application->where('Status', 9)->count();
        $totalCurrentReleased = $application->where('Status', 14)->count();
        $totalIncome = $settings->MonthlyTarget;
        
      

        $currentDate = Carbon::now();
        $totalIncomePercentage = $totalIncome ? $totalCollected : 0;
        $endOfMonth = clone $currentDate;
        $endOfMonth->modify('last day of this month');
        $interval = $currentDate->diff($endOfMonth);
        $totalDaysLeft = $interval->days;
        $this->totalPercent = $totalIncome ? ($totalCollected / $totalIncome) * 100 : 0;

       // $totalIncomePercentage = $totalIncome ? ($totalCollected / $totalIncome) * 100 : 0;
       

        $targetStatus = $previousMonthCollected >= $totalIncome;

        //$targetStatus = $totalCollected >= $totalIncome;

     
        return  [
            'activeMemberCount' => $activeMemberCount,
            'totalLoanBalance' => $totalLoanBalance,
            'totalInterest' => $totalInterest,
            'totalLoanCollection' => $totalCollected,
            'totalAdvancePayment' => ($totalAdvancePayment < 0) ? 0:$totalAdvancePayment,
            'totalOtherDeductions' => $totalOtherDeductions,
            'totalActiveStanding' => 0,
            'totalFullPayment' => $totalFullPayments,
            'totalCR' => $totalCurrentReleased,
            'totalEndingActiveMember' => $monthlyActiveMember,
            'totalSavingsOutstanding' => $totalSavingsOutstanding,
            'totalDailyOverallCollection' => $totalDailyOverallCollection,
            'totalNewAccountsOverall' => $totalNewAccountsOverall,
            'totalApplicationforApproval' => $totalApplicationforApproval,
            'totalIncome' => $totalIncome,
            'totalIncomePercentage' => $totalIncomePercentage,
            'totalDailyCollection' => 0,
            'totalDaysLeft' => $totalDaysLeft,
            'totalPercentOfLastEntry' => $this->totalPercent,
            'targetStatus' => $targetStatus,
            'activeMember' => 0,
            'totalLapsesArea' => 0,
            'topCollectiblesAreas' => 0,
            'areaActiveCollection' => 0,
            'currentMonth'=>$currentDate->format('m'),
         

        
        ];
    }

    private function activeCollectionData()
    {
        // $activeAreas = Area::with(['collectionAreas'])
        //     ->where('Status', 1)
        //     ->whereNotNull('FOID')
        //     ->get();
        $collectionArea=[];
        $result=[];
        $detailResult=[];
        $activeAreas = Area::with(['collectionAreas'])
            ->where('Status', 1)
            ->whereNotNull('FOID')
            ->get();
           
     
        foreach($activeAreas as $area) {
            $details=[];
            $sumCollectedAmount =0;
            $totalNewAccount = 0;
            $totalPastDueCollection = 0;
            $locations = explode('|',$area->City);
            foreach($locations as $location){
                        $address = explode(",",$location);
                        $barangay = trim($address[0],' ');
                        $city = trim($address[1],' ');
                        $members = Members::where([['Barangay','LIKE','%'.$barangay.'%'],['City','LIKE','%'.$city.'%'],['Status','=',1]])->get();
        
                        foreach($members as $member){
                            $application = Application::where('MemID',$member->Id)->with('detail')->with('loanhistory')->first();
                            $sumCollectedAmount += ($application->loanhistory->Penalty != 0) ? $application->loanhistory->OutstandingBalance:$application->detail->ApprovedDailyAmountDue;
                        }
                        $getApplicationCount = Application::where('MemId',$member->Id)->get()->count();
                        //add filter based on month
                        if( $getApplicationCount == 1){
                                     $totalNewAccount += 1;
                         }
                         $loanhistory = LoanHistory::where('NAID',$application->NAID)->first();
                         if($loanhistory){
                            $totalPastDueCollection += ($loanhistory->Penalty) ? $loanhistory->OutstandingBalance:0;
                         }
            }
         
            $areaNoPayment =0;
            $collectionArea = CollectionArea::where('AreaID',$area->AreaID)->get();
                foreach($collectionArea as $col){
                    $collections = CollectionAreaMember::where('Area_RefNo', $col->Area_RefNo)->where('Payment_Status',2)->where('UsedAdvancePayment',0)->get();
                    // add filter based on month
                    $areaNoPayment += $collections->count();
            }
            $detailResult[] = $areaNoPayment;
            $details['area'] = $area->Area;
            $details['activeCollection'] = $sumCollectedAmount;
            $details['newAccount'] =$totalNewAccount;
            $details['noPayment'] = $areaNoPayment;
            $details['pastDueCollection'] = $totalPastDueCollection;
            $result[]= $details;
        }

        return $result;
    }
 

      // Area	   Active Collection	New Account	  # NPS	  Past Due Collection
    // Next is get activeCollection from the sum of the OutstandingBalance of member per Area. And then count the newAccount from the Application with a Status of 7 meaning new application. And then for the numberOfNoPayment count the CollectionArea that has Collection_Status of 2 meaning no payment from the CollectionArea. Next is PastDueCollection you can get it from LoanHistory OutstandingBalance and the multiply it by 20% + the Outstanding Balance. All this should be is monthly data per Area.
     private function getTransactionMonths(){
       
    }
    private function computeTopValues($sumType)
    {
        $activeAreas = Area::where('Status', 1)
            ->whereNotNull('FOID')
            ->get();

        $topValues = [];
        foreach ($activeAreas as $area) {
            if($sumType == 'Collectibles'){
          
                    $locations = explode('|',$area->City);
                    $sumAmount =0;
                    foreach($locations as $location){
                        $address = explode(",",$location);
                        $barangay = trim($address[0],' ');
                        $city = trim($address[1],' ');
                        $members = Members::where([['Barangay','LIKE','%'.$barangay.'%'],['City','LIKE','%'.$city.'%'],['Status','=',1]])->get();
                        foreach($members as $member){
                            $application = Application::where('MemID',$member->Id)->with('detail')->with('loanhistory')->first();
                            $sumAmount += ($application->loanhistory->Penalty != 0) ? $application->loanhistory->OutstandingBalance:$application->detail->ApprovedDailyAmountDue;
                        }
                     

                    }
            }
            if($sumType == 'LapsePayment'){
                      $sumAmount = CollectionArea::where('AreaID', $area->AreaID)
                    ->where('Collection_Status', 7)
                    ->with('areaMembers')
                    //add filter by month collected
                    ->get()
                    ->sum(function($collectionArea) use ($sumType) {
                        return  $collectionArea->areaMembers->sum($sumType)  - $collectionArea->areaMembers->sum('UsedAdvancePayment') ;
                    });
            }
       
            if ($sumAmount > 0) {
                $topValues[] = [
                    'areaName' => $area->Area,
                    'amount' => $sumAmount,
                ];
            }
        }
        //dd($tops);
        usort($topValues, function ($a, $b) {
            return $b['amount'] <=> $a['amount'];
        });

        return $topValues;
    }



}
