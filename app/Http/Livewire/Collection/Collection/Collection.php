<?php

namespace App\Http\Livewire\Collection\Collection;

use App\Models\Application;
use App\Models\Collection as Col;
use App\Models\CollectionArea;
use App\Models\CollectionAreaMember;
use App\Models\CollectionStatus;
use App\Models\LoanHistory;
use App\Models\MembersSavings;
use App\Models\SavingsRunningBalance;
use Carbon\Carbon;
use App\Models\Area;
use App\Models\Members;
use App\Models\FieldOfficer;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class Collection extends Component
{

    public $areas = [];

    public $areastatus;
    public $areaID = '';
    public $areaRefNo = '';
    public $countDetails =0;
    public $foid = '';
    public $folist=[];
    public $colrefNo = '';

    public $areaDetails = [];    
    public $areaDetailsFooter = [];
    public $infoFooter;

    //cash denominations
    public $cashDenominations;
    public $totalDenomination = 0;

    //reject
    public $rejectReason;

    public function getTotalDenomination(){
        $cd1 = isset($this->cashDenominations['cd1']) ? (is_numeric($this->cashDenominations['cd1']) ? $this->cashDenominations['cd1'] : 0) : 0;
        $cd5 = isset($this->cashDenominations['cd5']) ? (is_numeric($this->cashDenominations['cd5']) ? $this->cashDenominations['cd5'] : 0) : 0;
        $cd10 = isset($this->cashDenominations['cd10']) ? (is_numeric($this->cashDenominations['cd10']) ? $this->cashDenominations['cd10'] : 0) : 0;
        $cd20 = isset($this->cashDenominations['cd20']) ? (is_numeric($this->cashDenominations['cd20']) ? $this->cashDenominations['cd20'] : 0) : 0;
        $cd50 = isset($this->cashDenominations['cd50']) ? (is_numeric($this->cashDenominations['cd50']) ? $this->cashDenominations['cd50'] : 0) : 0;
        $cd100 = isset($this->cashDenominations['cd100']) ? (is_numeric($this->cashDenominations['cd100']) ? $this->cashDenominations['cd100'] : 0) : 0;
        $cd200 = isset($this->cashDenominations['cd200']) ? (is_numeric($this->cashDenominations['cd200']) ? $this->cashDenominations['cd200'] : 0) : 0;
        $cd500 = isset($this->cashDenominations['cd500']) ? (is_numeric($this->cashDenominations['cd500']) ? $this->cashDenominations['cd500'] : 0) : 0;
        $cd1000 = isset($this->cashDenominations['cd1000']) ? (is_numeric($this->cashDenominations['cd1000']) ? $this->cashDenominations['cd1000'] : 0) : 0;
        $this->totalDenomination = ($cd1 * 1) + ($cd5 * 5) + ($cd10 * 10) + ($cd20 * 20) + ($cd50 * 50) + ($cd100 * 100) + ($cd200 * 200) + ($cd500 * 500) + ($cd1000 * 1000);
    }

    public function resetDenominations(){
        $this->cashDenominations['cd1'] = null;
        $this->cashDenominations['cd5'] = null;
        $this->cashDenominations['cd10'] = null;
        $this->cashDenominations['cd20'] = null;
        $this->cashDenominations['cd50'] = null;
        $this->cashDenominations['cd100'] = null;
        $this->cashDenominations['cd200'] = null;
        $this->cashDenominations['cd500'] = null;
        $this->cashDenominations['cd1000'] = null;
        $this->totalDenomination = 0;
    }

    public function approveDenominations(){
        $sumDetails = $this->areaDetails->where('areaID', $this->areaID)->sum('collectedAmount'); 
        $total_savings =  $this->areaDetailsFooter->where('areaID', $this->areaID)->first();  
       
        if(round($this->totalDenomination != round($sumDetails + $total_savings['total_savings'], 2), 2)){    
            session()->flash('RESPONSE_NOT_EQUAL_DENOMINATIONS_MODAL', 'Denominations is not equal to total collected amount');
        }
        else{
            $cd1 = isset($this->cashDenominations['cd1']) ? (is_numeric($this->cashDenominations['cd1']) ? $this->cashDenominations['cd1'] : 0) : 0;
            $cd5 = isset($this->cashDenominations['cd5']) ? (is_numeric($this->cashDenominations['cd5']) ? $this->cashDenominations['cd5'] : 0) : 0;
            $cd10 = isset($this->cashDenominations['cd10']) ? (is_numeric($this->cashDenominations['cd10']) ? $this->cashDenominations['cd10'] : 0) : 0;
            $cd20 = isset($this->cashDenominations['cd20']) ? (is_numeric($this->cashDenominations['cd20']) ? $this->cashDenominations['cd20'] : 0) : 0;
            $cd50 = isset($this->cashDenominations['cd50']) ? (is_numeric($this->cashDenominations['cd50']) ? $this->cashDenominations['cd50'] : 0) : 0;
            $cd100 = isset($this->cashDenominations['cd100']) ? (is_numeric($this->cashDenominations['cd100']) ? $this->cashDenominations['cd100'] : 0) : 0;
            $cd200 = isset($this->cashDenominations['cd200']) ? (is_numeric($this->cashDenominations['cd200']) ? $this->cashDenominations['cd200'] : 0) : 0;
            $cd500 = isset($this->cashDenominations['cd500']) ? (is_numeric($this->cashDenominations['cd500']) ? $this->cashDenominations['cd500'] : 0) : 0;
            $cd1000 = isset($this->cashDenominations['cd1000']) ? (is_numeric($this->cashDenominations['cd1000']) ? $this->cashDenominations['cd1000'] : 0) : 0;
            $denomstring = '1:'.$cd1.'|'.'5:'.$cd5.'|'.'10:'.$cd10.'|'.'20:'.$cd20.'|'.'50:'.$cd50.'|'.'100:'.$cd100.'|'.'200:'.$cd200.'|'.'500:'.$cd500.'|'.'1000:'.$cd1000;
            $data = [
                "areaID"=> $this->areaID,
                "denomination"=> $denomstring,   
                "areaRefno" => $this->areaRefNo,      
            ];
            //dd($data);

            CollectionArea::where('Area_RefNo',$this->areaRefNo)->update([
                'Denomination'=>$denomstring,
                'Collection_Status'=>7,
            ]);

            $getCollections =  CollectionAreaMember::where('Area_RefNo',$this->areaRefNo)->get();
            if($getCollections){
                foreach($getCollections as $getCollection){
                    //Update Oustanding Balance
                    $currentOutStanding = LoanHistory::where('NAID', $getCollection->NAID)->first()->OutstandingBalance;
                    $collectedAmount = ($getCollection->CollectedAmount) ? $getCollection->CollectedAmount:0;
                    $collectedAdvancePayment=($getCollection->AdvancePayment) ? $getCollection->AdvancePayment:0;
                    $usedAdvancePayment=($getCollection->UsedAdvancePayment) ? $getCollection->UsedAdvancePayment:0;

                    $newOutStaingBalance = $currentOutStanding - ($usedAdvancePayment+ $collectedAmount + $collectedAdvancePayment); 
                    LoanHistory::where('NAID', $getCollection->NAID)->update([
                        'OutstandingBalance'=>$newOutStaingBalance,
                    ]);
                    //Update Member Savings
                    $application = Application::where('NAID',$getCollection->NAID)->with('member')->first();
                    $currentSavings = MembersSavings::where('MemId',$application->member->MemId)->first()->TotalSavingsAmount;
                    $collectedSavings =$getCollection->Savings;
                    $newSavings = $currentSavings + $collectedSavings;
                    MembersSavings::where('MemId',$application->member->MemId)->update([
                        'TotalSavingsAmount' => $newSavings,
                        'DateUpdated'=>Carbon::now(),
                        'UpdatedFrom'=>'Updated from loan application '.$getCollection->NAID,
                    ]);
                    SavingsRunningBalance::create([
                        'MemId'=>$application->MemId,
                        'Savings'=>$newSavings,
                        'Note'=> 'New savings added from loan application '.$getCollection->NAID,
                        'Date'=> Carbon::now(),
                        'Updated_By'=>session()->get('auth_userid'),

                    ]);


                }
            }

            //dd($getCollections);
            //$collect = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/Collect', $data);               
            //dd($collect);
            $this->emit('RESPONSE_CLOSE_DENOMINATIONS_MODAL', ['url' => URL::to('/').'/collection/view/'.$this->colrefNo.'/'.$this->areaID]);            
            $this->resetDenominations();          
        }       
    }

    public function reject(){
        $this->validate(['rejectReason' => 'required']);
        $data = [
                    "areaID"=> $this->areaID,
                    "areaRefno"=> $this->areaRefNo,
                    "remarks" => $this->rejectReason,  
                    "foid" => $this->foid,                             
                ];

        CollectionAreaMember::where("Area_RefNo",$this->areaRefNo)->update([
            'AdvancePayment' => NULL,
            'LapsePayment' => NULL,
            'CollectedAmount' => NULL,
            'Savings' => NULL,
            'Payment_Status' => 2,
            'Payment_Method' => NULL,
            'DateCollected' => NULL,
            'UsedAdvancePayment' => NULL,
        ]);
        CollectionArea::where("Area_RefNo",$this->areaRefNo)->update([
            'Collection_Status' => NULL,
            'Remarks' => $this->rejectReason,
        ]);
        //$collect = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/Reject', $data);         
        $this->emit('RESPONSE_CLOSE_REJECTION_MODAL', ['url' => URL::to('/').'/collection/view/'.$this->colrefNo]);            
    }

    public function print($areaRefNo = ''){   
      

        
        if($areaRefNo == ''){  
            $area = CollectionArea::where('AreaId',$this->areaID)->whereNotNull('Area_RefNo')->count();
            $collectionCount = Col::get()->count();
            $areaReference = $this->areaID.date_format(Carbon::now(),'Ymd').'-0'.$area;
            $colRefNo = '';
            if($this->colrefNo != ''){
                $colRefNo = $this->colrefNo;
            }else{
                $colRefNo = Col::create([
                    'RefNo' => 'COL-'.date_format(Carbon::now(),'Ymd').'-'.$collectionCount,
                    'DateCreated' => date_format(Carbon::now(),'Y-m-d')
                ]);
            }
            $collectionArea= CollectionArea::create([
                'AreaId'=>$this->areaID,
                'Area_RefNo'=> $areaReference,
                'Printed_Status'=> 5,
                'CollectionRefNo'=>  $colRefNo,
                ]);
                foreach ($this->areaDetails as $detail) {
            
                    CollectionAreaMember::create([
                        'NAID'=>$detail['naid'],
                        'Area_RefNo'=> $collectionArea->Area_RefNo,
                        'AdvanceStatus'=> 0,
                        'Payment_Status'=> 2,
                    ]);
                    
                }
          

                   
            $this->emit('openUrlPrintingStub', ['url' => URL::to('/').'/collection/print/area/'.$this->areaID.'/'.$areaReference]);        
            return redirect()->to('/collection/view/'. $colRefNo.'/'.$this->areaID);       
        }
        else{                         
            $this->emit('openUrlPrintingStub', ['url' => URL::to('/').'/collection/print/area/'.$this->areaID.'/'.$areaRefNo]);        
            return redirect()->to('/collection/view/'.$this->colrefNo.'/'.$this->areaID);  
        }
       
        
    }
    
    public function getCollectionDetails($areaID = '', $foid = '', $areaRefNo = '', $force = 0){     
        $this->folist = FieldOfficer::where('Status',1)->get()->sortBy('Lname');
        $this->areaDetails = collect([]);
        $this->areaDetailsFooter = collect([]);
       
        if($this->areaID == ''){
            $this->areaID = $areaID;       
            $this->foid = $foid;
            $this->areaRefNo = $areaRefNo;
        }
        else{
            if($force == 0){
                if($this->areaID == $areaID){
                    $this->areaID = '';  
                    $this->foid = '';     
                    $this->areaRefNo = '';
                }
                else{
                    $this->areaID = $areaID;    
                    $this->foid = $foid;      
                    $this->areaRefNo = $areaRefNo;             
                }
            }
            else{
                $this->areaID = $areaID;    
                $this->foid = $foid;  
                $this->areaRefNo = $areaRefNo;       
            }
        }    
   
       $this->areaRefNo = $this->areaRefNo == 'PENDING' ? '' : $this->areaRefNo;
  
        if($areaID != ''){
                $this->areaID = $areaID;

                $collectionAreaMembers = CollectionAreaMember::where('Area_RefNo',$areaRefNo)->get();
                
                 $details=[];
                 //Get Area Applications
                 $collectibles=0;
                 $loanHistory=0;
                 $totalSavings=0;
                 $applicationData=[];
                 $details['totalCollectible']= 0;
                    $details['total_Balance']= 0;
                    $details['total_savings']=   0;
                    $details['total_advance']= 0;
                    $applicationData['lapsePayment']= 0;
                    $details['total_collectedAmount']= 0;
                    $details['total_FieldExpenses']= 0;
                    $details['daily_savings']= 0;
                 foreach($collectionAreaMembers as $collectionAreaMember){
              
                    $application= Application::where('NAID',$collectionAreaMember->NAID)->where('Status',14)->with('member')->with('termsofpayment')->with('detail')->with('loanhistory')->first();
                    $savings= MembersSavings::where('MemId',$application->member->MemId)->first();
                 
                    
              ;
                    if(!is_null($application)) {
                        if($application->loanhistory->OutstandingBalance != 0){
                        $AreaRefNo= CollectionAreaMember::where('Area_RefNo',$areaRefNo)->where('NAID',$application->NAID)->first();
                        $paymentStatus = ($AreaRefNo) ? CollectionStatus::where('Id',$AreaRefNo->Payment_Status)->first()->Status:'Pending';
                        $CollectionArea = CollectionArea::where('Area_RefNo',$areaRefNo)->first();
                        $collectionStatus =  ($CollectionArea) ? CollectionStatus::where('Id',$CollectionArea->Collection_Status)->first():'';
                        $PrintedStatus =  ($CollectionArea) ? CollectionStatus::where('Id',$CollectionArea->PrintedStatus)->first():'';
                        /// Get area total Collected Amount
                        $collectionAreaMembersCollectedAmounts = CollectionAreaMember::where('Area_RefNo',$areaRefNo)->get();
                        $totalCollectedAmount=0;
                        $totalAreaLapses=0;
                        $totalAreaAdvance=0;
                        $totalAreaUsedAdvance=0;
                        $totalAreaSavings=0;
                        if($collectionAreaMembersCollectedAmounts){
                               foreach($collectionAreaMembersCollectedAmounts as $collectionAreaMember){
                                $totalCollectedAmount += $collectionAreaMember->CollectedAmount;
                                $totalAreaLapses += $collectionAreaMember->LapsePayment;
                                $totalAreaAdvance += $collectionAreaMember->AdvancePayment;
                                $totalAreaSavings += $collectionAreaMember->Savings;
                                
                            }
                        }
                        /// Get Member total Lapses and Advance
                        $collectionAreaMembersAdvanceLapses = CollectionAreaMember::where('NAID',$application->NAID)->get();
                        $totalApplicationLapses=0;
                        $totalApplicationAdvance=0;
                        $totalApplicationUsedAdvance=0;
                        if($collectionAreaMembersAdvanceLapses){
                            foreach($collectionAreaMembersAdvanceLapses as $collectionAreaMember){
                                $totalApplicationUsedAdvance += $collectionAreaMember->UsedAdvancePayment;
                                $totalApplicationLapses += $collectionAreaMember->LapsePayment - $collectionAreaMember->UsedAdvancePayment;
                                $totalApplicationAdvance += $collectionAreaMember->AdvancePayment;
                            }
                        }
                    

                       //dd($totalAreaSavings);
                           //
                        
                        $collectibles +=  $application->detail->ApprovedDailyAmountDue;
                        $loanHistory +=  $application->loanhistory->OutstandingBalance;
                        $totalSavings +=  ( $savings) ? $savings->TotalSavingsAmount:0;
                        $details['totalCollectible']= $collectibles;
                        $details['total_Balance']= $loanHistory;
                        $details['total_savings']=   $totalAreaSavings;
                        $details['total_advance']= $totalAreaAdvance - $totalAreaUsedAdvance;
                        $details['total_lapses']= $totalAreaLapses - $totalAreaAdvance;
                        $details['total_collectedAmount']= $totalCollectedAmount;
                        $details['total_FieldExpenses']= ($CollectionArea) ? $CollectionArea->FieldExpenses:0;
                        $details['daily_savings']= 0;
                        $details['penalty']= 0;
                        $applicationData['areaID'] = $areaID;
                        $memfiles = $application->member->fileuploads;
                        if($memfiles){
                            foreach($memfiles as $memfile){
                                if($memfile->Type == 1){
                                    $applicationData['filePath'] = $memfile->FilePath;
                                }  
                            }
      
                        } 
                        $applicationData['dailyCollectibles'] = $application->detail->ApprovedDailyAmountDue;
                        $applicationData['collectedAmount'] = ($AreaRefNo) ? $AreaRefNo->CollectedAmount:0;
                        $applicationData['amountDue'] = $application->loanhistory->OutstandingBalance;
                        $applicationData['pastDue'] = 0;
                        $applicationData['totalSavingsAmount'] = ( $savings) ? $savings->TotalSavingsAmount:0;
                        $applicationData['payment_Status'] = ($paymentStatus) ? $paymentStatus:0;
                        $applicationData['collection_Status'] = ($collectionStatus) ? $collectionStatus->Status:'';
                        //Expaded table data
                        $applicationData['borrower'] = $application->member->FullName;
                        $applicationData['cno'] = $application->member->Cno;
                        $applicationData['co_Borrower'] = $application->member->comaker->FullName;
                        $applicationData['co_Cno'] = $application->member->comaker->Cno;
                        $applicationData['releasingDate'] = $application->loanhistory->DateReleased ;
                        $applicationData['dueDate'] = $application->loanhistory->DueDate;
                        $applicationData['loanPrincipal'] = $application->detail->ApprovedLoanAmount ;
                        $applicationData['typeOfCollection'] = $application->termsofpayment->collectionType->TypeOfCollection ;
                        $applicationData['naid'] = $application->NAID;
                        $applicationData['dailySavings'] = $application->termsofpayment->loantype->Savings;
                        $applicationData['lapsePayment'] = $totalApplicationLapses;
                        $applicationData['advancePayment'] = $totalApplicationAdvance - $totalApplicationUsedAdvance;
                        $applicationData['interestAmount'] = $application->detail->ApproveedInterest ;
                        $this->areaDetails[] = $applicationData; 
                    }

                    }
                 }
               
                        $this->areaDetailsFooter[$this->areaID] = [               
                                                        'areaID' => $this->areaID,                                                        
                                                        'totalCollectible' => $details['totalCollectible'],
                                                        'expectedCollection' => $details['totalCollectible'],
                                                        'total_Balance' => $details['total_Balance'],
                                                        'total_savings' => $details['total_savings'],
                                                        'total_advance' => $details['total_advance'],
                                                        'total_lapses' => $applicationData['lapsePayment'],
                                                        'total_collectedAmount' => $details['total_collectedAmount'],
                                                        'total_FieldExpenses' => $details['total_FieldExpenses'],
                                                        'total_daily_savings' => $details['daily_savings'],
                                                        //'total_daily_savings' => collect($details['collection'])->sum('dailySavings'),
                                                     ];    
        }
    }

    public function mount(){       
        $this->areas = collect([]);
        $this->areaDetails = collect([]);
        $this->areaDetailsFooter = collect([]);
        // $areas = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/AreasCollectionList');  
        $areas   = Area::whereNotNull('FOID')->where('Status',1)->get();
        if($this->colrefNo != ''){
            
            foreach($areas as $area){
                $collectionArea = CollectionArea::where('CollectionRefNo',$this->colrefNo)->where('AreaId', $area->Id)->first();
                $printStatus = ($collectionArea) ? CollectionStatus::where('Id',$collectionArea->Printed_Status)->first():'';
                $collectionStatus = ($collectionArea) ? CollectionStatus::where('Id',$collectionArea->Collection_Status)->first():'';
                $locations = explode("|",$area->City);
                $persons=[];
                foreach($locations as $location){
                    $address = explode(",",$location);
                    $barangay = trim($address[0],' ');
                    $city = trim($address[1],' ');
                    $membersPerLocations =  Members::where([['Barangay','LIKE','%'.$barangay.'%'],['City','LIKE','%'.$city.'%'],['Status','=',1]])->get();
                    foreach($membersPerLocations as $member){
                        $persons[] = $member;
                    }
                }
              
                 $details=[];
                 //Get Area Applications
                 $collectibles=0;
                 $loanHistory=0;
                 $totalSavings=0;
                 $totalAdvance=0;
                 $totalLapses=0;
                 $totalCollectedAmount=0;
                 $appDetails = [];
                 $totalItems=0;
                 $fo = FieldOfficer::where('FOID',$area->FOID)->first();
                 $details['expectedCollection']= 0;
                 $details['totalCollectible']= 0;
                 $details['total_collectedAmount']= 0;
                 $details['penalty']= 0;
                 $details['Area']= $area->Area;
                 $details['areaName']= $area->Area;
                 $details['areaID']= $area->Id;
                 $details['FOID']= $area->FOID;
                 $details['area_RefNo']= '';
                 $details['fieldOfficer']= $fo->Lname.', '.$fo->Fname.' '.$fo->Mname[0];
                 $details['payment_Status']= "No Payment";
                  $details['collection_Status'] = "NO PAYMENT";
                 $details['refNo']= $this->colrefNo;
                 $details['collection_RefNo']= '';
                 $details['totalItems']= 0;
                 $details['advancePayment']= 0;
                 $details['dateCreated']= "";
                 $details['dateCollected']= 0;
                 $details['total_FieldExpenses']= 0;
                 $details['total_Balance']= 0;
                 $details['total_savings']= 0;
                 $details['total_advance']= 0;
                 $details['total_lapses']= 0;
                 foreach($persons as $person){
                    $application= Application::where('MemId',$person->MemId)->where('Status',14)->with('member')->with('termsofpayment')->with('detail')->with('loanhistory')->first();
                    $savings= MembersSavings::where('MemId',$person->MemId)->first();
                   
                    if(!is_null($application)) {
                        if($application->loanhistory->OutstandingBalance != 0){

                            //Get back to you//
                            //get updated lapses, advance and collected amount within this collection//
                            $collectionAreasMembers = CollectionAreaMember::where('NAID',$application->NAID)->get();
                            $totalCollectionAdvance=0;
                            $totalCollecitonLapses=0;
                            $totalCollecitonLapses=0;
                            if($collectionAreasMembers){
                                foreach( $collectionAreasMembers as $collectionAreaMember){
                                    $totalCollectionAdvance += $collectionAreaMember->AdvancePayment;
                                    $totalCollecitonLapses += $collectionAreaMember->LapsePayment;
                                }
                            }

                         
                            $collectionAreaMember = CollectionAreaMember::where('NAID',$application->NAID)->where('Area_RefNo', ($collectionArea) ? $collectionArea->Area_RefNo:'')->first();
                            $collectionArea = CollectionAreaMember::where('NAID',$application->NAID)->where('Area_RefNo', ($collectionArea) ? $collectionArea->Area_RefNo:'')->first();
                            $paymentStatus = ($collectionArea)  ? CollectionStatus::where('Id',$collectionAreaMember->Payment_Status)->first()->Status:'';
                            $collectibles +=  $application->detail->ApprovedDailyAmountDue;
                            $loanHistory +=  $application->loanhistory->OutstandingBalance;
                            $totalSavings +=  ($savings) ? $savings->TotalSavingsAmount:0;
                            $totalLapses += $totalCollecitonLapses;
                            $totalAdvance += $totalCollectionAdvance;
                            $totalItems +=  1;

                         
                            $details['expectedCollection']= $collectibles;
                            $details['totalCollectible']= $collectibles;
                            $details['total_collectedAmount']= 0;
                            $details['penalty']= 0;
                            $details['Area']= $area->Area;
                            $details['areaName']= $area->Area;
                            $details['areaID']= $area->Id;
                            $details['FOID']= $area->FOID;
                            $details['fieldOfficer']= $fo->Lname.', '.$fo->Fname.' '.$fo->Mname[0];
                            $details['refNo']= ($collectionArea) ? $collectionArea->Area_RefNo:'';
                            $details['area_RefNo']= ($collectionArea) ? $collectionArea->Area_RefNo:'';
                            $details['payment_Status']= $paymentStatus ;
                            $details['collection_Status'] = $collectionStatus != '' ? $collectionStatus->Status:'';
                            $details['collection_RefNo']= '';
                            $details['totalItems']= $totalItems;
                            $details['advancePayment']= 0;
                            $details['dateCreated']= "";
                            $details['dateCollected']= 0;
                            $details['total_FieldExpenses']= 0;
                            $details['total_Balance']=  $application->loanhistory->OutstandingBalance;
                            $details['total_savings']= $totalSavings ;
                            $details['total_advance']= $totalAdvance;
                            $details['total_lapses']= $totalLapses;
                            $appDetails[]=$printStatus;
                            $details['application'] = $appDetails;
                            
                        }
                    }
                }
               
            $this->areas[]=$details;

            } 
      
            //$this->areas = Area::whereNotNull('FOID')->where('Status',1)->get();
            
            //$this->areas = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/CollectionDetailsViewbyRefno', ['colrefno' => $this->colrefNo]);  
        }
        else{
           // $areas = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/MakeCollection');             
            //$areas   = Area::whereNotNull('FOID')->where('Status',1)->get();
          
            foreach($areas as $area){
                $locations = explode("|",$area->City);
                $persons=[];
                foreach($locations as $location){
                    $address = explode(",",$location);
                    $barangay = trim($address[0],' ');
                    $city = trim($address[1],' ');
                    $membersPerLocations =  Members::where([['Barangay','LIKE','%'.$barangay.'%'],['City','LIKE','%'.$city.'%'],['Status','=',1]])->get();
                    foreach($membersPerLocations as $member){
                        $persons[] = $member;
                    }
                }
              
                 $details=[];
                 //Get Area Applications
                 $collectibles=0;
                 $loanHistory=0;
                 $totalSavings=0;
                 $appDetails = [];
                 $totalItems=0;
                 $fo = FieldOfficer::where('FOID',$area->FOID)->first();
                 $details['expectedCollection']= 0;
                 $details['totalCollectible']= 0;
                 $details['total_collectedAmount']= 0;
                 $details['penalty']= 0;
                 $details['Area']= $area->Area;
                 $details['areaName']= $area->Area;
                 $details['areaID']= $area->Id;
                 $details['FOID']= $area->FOID;
                 $details['area_RefNo']= '';
                 $details['fieldOfficer']= $fo->Lname.', '.$fo->Fname.' '.$fo->Mname[0];
                 $details['collection_RefNo']= '';
                 $details['totalItems']= 0;
                 $details['advancePayment']= 0;
                 $details['dateCreated']= "";
                 $details['dateCollected']= 0;
                 $details['total_FieldExpenses']= 0;
                 $details['total_Balance']= 0;
                 $details['total_savings']= 0;
                 $details['total_advance']= 0;
                 $details['total_lapses']= 0;

                 foreach($persons as $person){
                    $application= Application::where('MemId',$person->MemId)->where('Status',14)->with('member')->with('termsofpayment')->with('detail')->with('loanhistory')->first();
                    $savings= MembersSavings::where('MemId',$person->MemId)->first();
                   
                    if(!is_null($application)) {
                        if($application->loanhistory->OutstandingBalance != 0){
                           $collectibles +=  $application->detail->ApprovedDailyAmountDue;
                           $loanHistory +=  $application->loanhistory->OutstandingBalance;
                           $totalSavings +=  ($savings) ? $savings->TotalSavingsAmount:0;
                           $totalItems +=  1;
                            $details['expectedCollection']= $collectibles;
                            $details['totalCollectible']= $collectibles;
                            $details['total_collectedAmount']= 0;
                            $details['penalty']= 0;
                            $details['Area']= $area->Area;
                            $details['areaName']= $area->Area;
                            $details['areaID']= $area->Id;
                            $details['FOID']= $area->FOID;
                            $details['fieldOfficer']= $fo->Lname.', '.$fo->Fname.' '.$fo->Mname[0];
                            $details['payment_Status']= '';
                            $details['collection_Status'] = '';
                            $details['area_RefNo']= '';
                            $details['collection_RefNo']= '';
                            $details['totalItems']= $totalItems;
                            $details['advancePayment']= 0;
                            $details['dateCreated']= "";
                            $details['dateCollected']= 0;
                            $details['total_FieldExpenses']= 0;
                            $details['total_Balance']= 0;
                            $details['total_savings']= 0;
                            $details['total_advance']= 0;
                            $details['total_lapses']= 0;
                            $appDetails[]=$application->NAID;
                            $details['application'] = $appDetails;
                            
                        }
                    }
                }
               
            $this->areas[]=$details;

            }     
        
        }
       
         $mfolist = collect([]);
        //  $folist = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldOfficer/FieldOfficerList');  
        //  $folist = $folist->json();
         $this->folist = FieldOfficer::where('Status',1)->get()->sortBy('Lname');
        if($this->areaID != ''){
           
            $refno =  $this->areas->where('areaID', $this->areaID)->first();
            //dd( $refno);
            if($refno){                                      
                $this->getCollectionDetails($this->areaID,$refno['FOID'], $refno['area_RefNo'], 1);
            }            
        }
       //dd( $this->folist);
       
    }

    public function render()
    {
        return view('livewire.collection.collection.collection');
    }
}
