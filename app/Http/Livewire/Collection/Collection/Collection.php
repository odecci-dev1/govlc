<?php

namespace App\Http\Livewire\Collection\Collection;

use App\Models\Application;
use App\Models\CollectionArea;
use App\Models\CollectionAreaMember;
use App\Models\MembersSavings;
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
    public $folist = [];
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
       
        if(round($this->totalDenomination != round($sumDetails + $total_savings['total_daily_savings'], 2), 2)){    
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
            $collect = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/Collect', $data);               
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
        $collect = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/Reject', $data);         
        $this->emit('RESPONSE_CLOSE_REJECTION_MODAL', ['url' => URL::to('/').'/collection/view/'.$this->colrefNo]);            
    }

    public function print($areaRefNo = ''){   
        //dd(['areaID' => $this->areaID, 'remarks' => 'Printded ' . Carbon::now() , 'foid' => $this->foid]);    
        $print = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/PrintCollection', ['areaID' => $this->areaID , 'remarks' => 'Printded ' . Carbon::now() , 'foid' => $this->foid]);                  
        $print = $print->json();
        //dd( $print );
        if($areaRefNo == ''){               
            $this->emit('openUrlPrintingStub', ['url' => URL::to('/').'/collection/print/area/'.$this->areaID.'/'.$print['areaRef']]);        
            return redirect()->to('/collection/view/'. $print['colRef'].'/'.$this->areaID);       
        }
        else{                         
            $this->emit('openUrlPrintingStub', ['url' => URL::to('/').'/collection/print/area/'.$this->areaID.'/'.$areaRefNo]);        
            return redirect()->to('/collection/view/'.$this->colrefNo.'/'.$this->areaID);  
        }
        
    }
    
    public function getCollectionDetails($areaID = '', $foid = '', $areaRefNo = '', $force = 0){      
        $this->areas = Area::whereNotNull('FOID')->where('Status',1)->get();
        $this->areastatus = CollectionArea::where('AreaId',$areaID)->first();
        if($this->areastatus){

        }
        // $this->areaDetails = collect([]);
        // $this->areaDetailsFooter = collect([]);
       
        // if($this->areaID == ''){
        //     $this->areaID = $areaID;       
        //     $this->foid = $foid;
        //     $this->areaRefNo = $areaRefNo;
        // }
        // else{
        //     if($force == 0){
        //         if($this->areaID == $areaID){
        //             $this->areaID = '';  
        //             $this->foid = '';     
        //             $this->areaRefNo = '';
        //         }
        //         else{
        //             $this->areaID = $areaID;    
        //             $this->foid = $foid;      
        //             $this->areaRefNo = $areaRefNo;             
        //         }
        //     }
        //     else{
        //         $this->areaID = $areaID;    
        //         $this->foid = $foid;  
        //         $this->areaRefNo = $areaRefNo;       
        //     }
        // }    
        //dd( $this->areaID );   
        //dd($areaRefNo); 
       // $this->areaRefNo = $this->areaRefNo == 'PENDING' ? '' : $this->areaRefNo;
  
        if($areaID != ''){
                $this->areaID = $areaID;
               // $details = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/CollectionDetailsList', ['areaid' => $this->areaID, 'arearefno' => $this->areaRefNo ]);  
                //$details = $details->json();   
                //dd($details[0]);    

                $area =  Area::where('Id',$areaID)->first();
                $locations = explode("|",$area->City);
                $persons=[];
                foreach($locations as $location){
                    $address = explode(",",$location);
                    $barangay = $address[0];
                    $city = $address[1];
                    $members=[];
                    $membersPerLocations =  Members::where('Barangay','LIKE','%'.$barangay.'%')->orWhere('City','LIKE','%'.$city.'%')->get();
                    foreach($membersPerLocations as $member){
                        $members[] = $member;
                    }
                    $persons=$members;
                }
              
              
                $details=[];
                //Get Area Applications
                 $collectibles=0;
                 $loanHistory=0;
                 $totalSavings=0;
                 $applicationData=[];
                 foreach($persons as $person){
              
                    $application= Application::where('MemId',$person->MemId)->where('Status',14)->with('member')->with('termsofpayment')->with('detail')->with('loanhistory')->first();
                    $savings= MembersSavings::where('MemId',$person->MemId)->first();
                    if($application){
                        $collectibles +=  $application->detail->ApprovedDailyAmountDue;
                        $loanHistory +=  $application->loanhistory->OutstandingBalance;
                        $totalSavings +=  $savings->TotalSavingsAmount;
                        $details['totalCollectible']= $collectibles;
                        $details['total_Balance']= $loanHistory;
                        $details['total_savings']= $totalSavings;
                        $details['total_advance']= 0;
                        $details['total_lapses']= 0;
                        $details['total_collectedAmount']= 0;
                        $details['total_FieldExpenses']= 0;
                        $details['daily_savings']= 0;
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
                        $applicationData['collectedAmount'] = 0;
                        $applicationData['amountDue'] = $application->detail->OutstandingBalance;
                        $applicationData['pastDue'] = 0;
                        $applicationData['totalSavingsAmount'] = $savings->TotalSavingsAmount;
                        $applicationData['advancePayment'] = $savings->TotalSavingsAmount;
                        $applicationData['payment_Status'] = 'No Payment';
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
                        $applicationData['lapsePayment'] = 0;
                        $applicationData['advancePayment'] = 0;
                        $this->areaDetails[] = $applicationData; 


                    }
                    
                        //$CollectionAreaMember = CollectionAreaMember::where('NAID',$app->NAID)
            
                    // foreach($applications as $app){
                    //     $applicationCollections[]=CollectionAreaMember::where('NAID',$app->NAID)->orderBy('DateCollected','DESC')->first();
                    // }
                
                    // foreach($applications as $application){ 
                    //     $applicationDetails[] = $application;
                        
                    //     $terms = $application->termsofpayment->Terms;
                    //     $collectible[] = $application->detail->ApprovedDailyAmountDue * $terms;
                    // };
                   
                    
                 }
                // $this->areastatus = $areas->where('areaID', $areaID)->first();  

               
                 //Get Collectibles
              
                //foreach($applications as $application){
                        // $collectionDetails=[];
                        // $collectionAreaMember = CollectionAreaMember::where('NAID',$application->NAID)->orderBy('DateCollected','DESC')->first();
                        // $lastCollection= date_create($collectionAreaMember->DateCollected);
                        // $dueDate= date_create($application->loanhistory->DueDate);

                        // $days = $lastCollection->diff($dueDate, true)->days;
                        // $sundays = intval($days / 7) + ($lastCollection->format('N') + $days % 7 >= 7);
                        // $remainDays = date_add( $dueDate, date_interval_create_from_date_string($sundays." Days"));
                        // $collectionDetails['RemainingDays'] = $remainDays;
                        // $details[] = $collectionDetails;

                // }
                 
                //dd($details);
                 
                // if(isset($details[0])){
                     //$collections = null;
                //     $details = $details[0];                                       
                //     $collections = $details['collection'];
                    
                //    if($collections){
                        
                        $this->areaDetailsFooter[$this->areaID] = [               
                                                        'areaID' => $this->areaID,                                                        
                                                        'totalCollectible' => $details['totalCollectible'],
                                                        'expectedCollection' => $details['totalCollectible'],
                                                        'total_Balance' => $details['total_Balance'],
                                                        'total_savings' => $details['total_savings'],
                                                        'total_advance' => $details['total_advance'],
                                                        'total_lapses' => $details['total_lapses'],
                                                        'total_collectedAmount' => $details['total_collectedAmount'],
                                                        'total_FieldExpenses' => $details['total_FieldExpenses'],
                                                        'total_daily_savings' => $details['daily_savings'],
                                                        //'total_daily_savings' => collect($details['collection'])->sum('dailySavings'),
                                                     ];
                                                     
                    //     foreach($collections as $coll){
                    //         $this->areaDetails =  $this->areaDetails->push($coll);
                    //     }                        
                    // }                                                 
                //}               
                //dd($this->areas);
                //dd($this->areaDetails);
        }
    }

    public function mount(){       
        $this->areas = collect([]);
        $this->areaDetails = collect([]);
        $this->areaDetailsFooter = collect([]);
        // $areas = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/AreasCollectionList');  
        if($this->colrefNo != ''){
            $this->areas = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/CollectionDetailsViewbyRefno', ['colrefno' => $this->colrefNo]);  
        }
        else{
           // $areas = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/MakeCollection');             
            $this->areas = Area::whereNotNull('FOID')->where('Status',1)->get();
             
        }     

        //dd( $this->areas);    
        //$mfolist = collect([]);
        // $folist = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldOfficer/FieldOfficerList');  
        // $folist = $folist->json();
        // $this->folist = FieldOfficer::where('Status',1)->get()->sortBy('Lname');
        // if($this->areaID != ''){
           
        //     $refno =  $this->areas->where('areaID', $this->areaID)->first();
        //     if($refno){                                      
        //         $this->getCollectionDetails($this->areaID,$this->folist['id'], $refno['area_RefNo'], 1);
        //     }            
        // }
       
        //dd($this->folist);
    }

    public function render()
    {
        return view('livewire.collection.collection.collection');
    }
}
