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
        $this->area = Area::where('Status',1)->whereNotNull('Area')->get();      
        $this->activeCollectionData();



        return view('livewire.dashboard');
    }

    private function prepareData()
    {
       
        $members = Members::select('id', 'Status')->where('Status', 1)->get();
        $collectionAreaMembers = CollectionAreaMember::select('DateCollected', 'CollectedAmount', 'AdvancePayment','UsedAdvancePayment','LapsePayment')->whereNotNull('Area_RefNo')->get();
        $loanDetails = LoanDetails::select('ApprovedLoanAmount', 'ApproveedInterest', 'ApprovedNotarialFee','ApprovedDailyAmountDue','TermsOfPayment')->whereIn('Status',[14,9,15])->get();
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
       // dd($totalCollected );
        $totalAmount = $loanDetails->sum('ApprovedLoanAmount')+ $loanDetails->sum('ApproveedInterest');
        $totalLoanBalance =$loanHistory->sum('OutstandingBalance');
        
        

        $totalInterest = $loanDetails->sum('ApproveedInterest');
        $lapses = $collectionAreaMembers->sum('LapsePayment') - $collectionAreaMembers->sum('UsedAdvancePayment');
        $totalAdvancePayment = $collectionAreaMembers->sum('AdvancePayment') -  $collectionAreaMembers->sum('UsedAdvancePayment') -$lapses ;
        $totalNotarialFee = $loanDetails->sum('ApprovedNotarialFee');
        $totalOtherDeductions = $totalLoanInsurance + $totalLifeInsurance + $totalNotarialFee;
    
        $totalSavingsOutstanding = $totalMemberSavings->sum('TotalSavingsAmount');
        $totalDailyOverallCollection = $loanDetails->sum('ApprovedDailyAmountDue');
       
        $totalNewAccountsOverall = $totalOfNewAccounts;
        $totalApplicationforApproval = $application->where('Status', 9)->count();
        $totalCurrentReleased = $application->where('Status', 14)->count();
        $totalIncome = $settings->MonthlyTarget;

       // $totalIncomePercentage = $totalIncome ? ($totalCollected / $totalIncome) * 100 : 0;
        $totalIncomePercentage = $totalIncome ? $totalCollected : 0;
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
            'totalCR' => $totalCurrentReleased,
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
            foreach( $activeAreas as $activeArea ){
                $collectionArea = CollectionArea::where('AreaID',$activeArea->AreaID)->get();
            }
        $newAccounts = Application::with(['collectionareamember', 'loanhistory'])
            ->where('Status', 7)
            ->get();
        //$result = $activeAreas->map(function ($area) use ($newAccounts) {
        //dd($collectionArea);
        // if(empty($collectionArea)){
        //     $details['area'] = '';
        //     $details['activeCollection'] = '';
        //     $details['newAccount'] = '';
        //     $details['noPayment'] = '';
        //     $details['pastDueCollection'] = 0;
        //     $detailResult= $details;
        // }

        //dd($activeAreas);
        $activeAreas = Area::where('Status', 1)
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
                        $member = Members::where('Barangay', $barangay)->where('City',$city)->first();
                        $application = Application::where('MemID',$member->Id)->with('detail')->with('loanhistory')->first();
                     
                        $sumCollectedAmount += ($application->loanhistory->Penalty != 0) ? $application->loanhistory->OutstandingBalance:$application->detail->ApprovedDailyAmountDue;
                        $getApplicationCount = Application::where('MemId',$member->Id)->get()->count();
                        if( $getApplicationCount == 1){
                                     $totalNewAccount += 1;
                         }
                         $loanhistory = LoanHistory::where('NAID',$application->NAID)->first();
                         if($loanhistory){
                            $totalPastDueCollection += ($loanhistory->Penalty) ? $loanhistory->OutstandingBalance:0;
                         }
                       

            }
            // Sum collected amounts for the area
            // $getArea = Area::where('AreaID', $area->AreaId)->first();
            // $collections = CollectionAreaMember::where('Area_RefNo', $area->Area_RefNo)->get();
            // $sumCollectedAmount =0;
            // $totalNewAccount = 0;
            // $totalPastDueCollection = 0;
            // foreach( $collections as $collection ) {
            //     $dailyCollectible = LoanDetails::where('NAID',$collection->NAID)->first();
            //     $loanhistory = LoanHistory::where('NAID',$collection->NAID)->first();
            //     //$sumCollectedAmount += $collections->sum('CollectedAmount');
            //     $sumCollectedAmount += ($loanhistory->Penalty == 0 ) ? $dailyCollectible->ApprovedDailyAmountDue:$loanhistory->OutstandingBalance;
            //     $totalPastDueCollection += ($loanhistory->Penalty == 0 ) ? 0:$loanhistory->OutstandingBalance;
            //     $getMember = Application::where('NAID',$collection->NAID)->first();
            //     $getApplicationCount = Application::where('MemId',$getMember->MemId)->get()->count();
            //     if( $getApplicationCount == 1){
            //         $totalNewAccount += 1;
            //     }
             //}
            


           
    
            // // Count new accounts for the area
            // $newAccountsCount = $newAccounts->filter(function ($account) use ($area) {
            //   //  dd($area->Area_RefNo);
            //     // dd($area->collectionAreas->pluck('Area_RefNo'));

            //     // return $account->collectionareamember->Area_RefNo === $area->collectionAreas->Area_RefNo;
            // })->count();

        

            $noPayment =0;
            $collections = CollectionAreaMember::where('Area_RefNo', $area->Area_RefNo)->get();
            foreach( $collections as $collection) {
                if($collection->Payment_Status == 2){
                    $noPayment += 1;
                }
            }
           // return [
            
            $details['area'] = $area->Area;
            $details['activeCollection'] = $sumCollectedAmount;
            $details['newAccount'] =$totalNewAccount;
            $details['noPayment'] = $noPayment;
            $details['pastDueCollection'] = $totalPastDueCollection;
            $result[]= $details;
        }
        //$result[] =  $detailResult;
        //});
        //dd( $result);
        return $result;
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
            if($sumType == 'Collectibles'){
          
                    $locations = explode('|',$area->City);
                    $sumAmount =0;
                    foreach($locations as $location){
                        $address = explode(",",$location);
                        $barangay = trim($address[0],' ');
                        $city = trim($address[1],' ');
                        $member = Members::where('Barangay', $barangay)->where('City',$city)->first();
                        $application = Application::where('MemID',$member->Id)->with('detail')->with('loanhistory')->first();
                        $sumAmount += ($application->loanhistory->Penalty != 0) ? $application->loanhistory->OutstandingBalance:$application->detail->ApprovedDailyAmountDue;

                    }
            }
            if($sumType == 'LapsePayment'){
                      $sumAmount = CollectionArea::where('AreaID', $area->AreaID)
                    ->where('Collection_Status', 7)
                    ->with('areaMembers')
                    ->get()
                    ->sum(function($collectionArea) use ($sumType) {
                        return  $collectionArea->areaMembers->sum($sumType)  - $collectionArea->areaMembers->sum('AdvancePayment') ;
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
