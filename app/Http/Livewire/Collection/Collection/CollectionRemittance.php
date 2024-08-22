<?php

namespace App\Http\Livewire\Collection\Collection;

use App\Models\Application;
use App\Models\Area;
use App\Models\CollectionArea;
use App\Models\CollectionAreaMember;
use App\Models\CollectionStatus;
use App\Models\LoanHistory;
use App\Models\Members;
use App\Models\MembersSavings;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;
use Carbon\Carbon;

class CollectionRemittance extends Component
{
    use Common;
    public $areaRefNo;
    public $list=[];
    public $arealist = [];
    public $foid = '';
    public $areaID = '';

    public $memid = '';
    public $reminfo;

    //expenses
    public $expenses;
    public $expcnt = [];
    public $totalexp = 0;

    public $appdtl=[];

    public $remitUsingAdvanceValidation;

    public function rules(){                
        $rules = []; 
        return $rules;
    }

    public function setRemmittInfo($naid = '', $memid = '', $amount = 0,$index=0){
        //dd($this->list->where('naid', $naid)->first());
        $this->appdtl = $this->list[$index];      
       // $appdtl = $this->list->where('naid', $naid)->first();   
       // dd($this->appdtl);
        $this->memid =  $memid;
        $this->reminfo['savings'] = 0;
        $this->reminfo['amntCollected'] = $amount;
        $this->remitUsingAdvanceValidation='';

        $this->computeLapses();       
    }

    public function computeLapses(){
        // if(isset($this->reminfo['amntCollected'])){
        //     $data = [
        //         "memId"=> $this->memid,
        //         "areaRefno"=> $this->areaRefNo,
        //         "amountCollected"=> $this->reminfo['amntCollected']
        //     ];         
        //     $compute = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/RemitAmountCollectedComputation', $data);                       
        //     $compute = $compute->json();
           
        //     if($compute){         
        //         $this->reminfo['lapses'] = isset($compute['lapses']) ? $compute['lapses'] : 0;
        //         $this->reminfo['advance'] = isset($compute['advance']) ? $compute['advance'] : 0;              
        //     }
            
        // }
        $this->remitUsingAdvanceValidation='';
        $getLoanHistory = LoanHistory::where('NAID',$this->appdtl['naid'])->first();
        
        $this->reminfo['lapses'] = (($this->appdtl['dailyCollectibles'] - $this->reminfo['amntCollected']) < 0 ? 0:($this->appdtl['dailyCollectibles'] - $this->reminfo['amntCollected']));
        if($getLoanHistory->Penalty == 0){
            $this->reminfo['advance'] = (($this->reminfo['amntCollected'] - $this->appdtl['dailyCollectibles']) < 0 ? 0:($this->reminfo['amntCollected'] - $this->appdtl['dailyCollectibles']));
        }else{
            $this->reminfo['advance'] = 0;
        }


       
    }

    public function resetRemittance(){
        $this->memid = '';
        $this->reminfo['amntCollected'] = null;
        $this->reminfo['savings'] = null;
        $this->reminfo['lapses'] = null;
        $this->reminfo['advance'] = null;
        $this->reminfo['modeOfPayment'] = null;
    }

    public function remit(){
        $rules = [];
        $rules['reminfo.amntCollected'] = ['required', 'numeric', 'min:0'];
        $rules['reminfo.savings'] = ['numeric', 'min:0']; 
        $rules['reminfo.modeOfPayment'] = ['required'];      

        $messages = [];
        $messages['reminfo.amntCollected.required'] = 'Required field';
        $messages['reminfo.amntCollected.numeric'] = 'Must be a number';
        $messages['reminfo.amntCollected.min'] = 'Must be >= than 0';
        $messages['reminfo.savings.required'] = 'Required field';
        $messages['reminfo.savings.numeric'] = 'Must be a number';
        $messages['reminfo.savings.min'] = 'Must be >= than 0';
        $messages['reminfo.modeOfPayment.required'] = 'Required field';
       
        
        $this->validate($rules, $messages);
        $data = [
                    "memId"=> $this->memid,
                    "savings"=> isset($this->reminfo['savings']) ? $this->reminfo['savings'] : 0,
                    "modeOfPayment"=> $this->reminfo['modeOfPayment'],
                    "areaRefno"=> $this->areaRefNo,
                    "areaID"=> $this->areaID,
                    "amountCollected"=> $this->reminfo['amntCollected'],
                    "advancePayment"=> isset($this->reminfo['advance']) ? $this->reminfo['advance'] : 0,
                    "lapses"=> isset($this->reminfo['lapses']) ? $this->reminfo['lapses'] : 0,
                    "userId"=> session()->get('auth_userid'),
                    "foid"=> $this->foid
                ];
            if($this->appdtl['advancePayment'] == 0 && $this->reminfo['amntCollected'] == 0){
             $this->remitUsingAdvanceValidation = 'No Advance Payment Available';
            }else if($this->reminfo['amntCollected'] == 0 && $this->appdtl['advancePayment'] < $this->appdtl['dailyCollectibles']){
                $this->remitUsingAdvanceValidation = 'Insufficient Advance Payment';
            }else{
                $useAdvancePayment =  $this->reminfo['amntCollected'];
                if($this->reminfo['amntCollected'] != 0){
                    $useAdvancePayment =0;
                    if($this->reminfo['amntCollected'] < $this->appdtl['dailyCollectibles']){
                        $useAdvancePayment = ($this->appdtl['dailyCollectibles'] > $this->appdtl['advancePayment']) ? $this->appdtl['advancePayment']:$this->appdtl['dailyCollectibles'];
                    }
                  
                }if($this->reminfo['amntCollected'] == 0 && $this->appdtl['advancePayment'] != 0){
                    $useAdvancePayment = $this->appdtl['dailyCollectibles'];
                }
                
                 CollectionAreaMember::where("Area_RefNo",$this->areaRefNo)->where('NAID',$this->appdtl['naid'])->update([
                'CollectedAmount' => $this->reminfo['amntCollected'],
                'AdvancePayment' =>  $this->reminfo['advance'],
                'LapsePayment' =>  $this->reminfo['lapses'],
                'Payment_Method' =>  $this->reminfo['modeOfPayment'],
                'DateCollected' =>  date_format(Carbon::now(),'Y-m-d'),
                'Savings' =>  $this->reminfo['savings'],
                'UsedAdvancePayment'=> $useAdvancePayment,
                'Payment_Status'=> ($this->reminfo['lapses'] == 0) ? 1:2,
                ]);
                // $newOutStandingBalance = $this->appdtl['amountDue'] - $this->reminfo['amntCollected'];
                // LoanHistory::where('NAID',$this->appdtl['naid'])->update([
                //     'OutStandingBalance' => $newOutStandingBalance
                // ]);
                // $newSavingsAmount = $this->apptl['totalSavingsAmount'] + $this->reminfo['savings'];
                // MembersSavings::where('MemId',$this->appdtl['memId'])->update([
                //     'TotalSavingsAmount'=> $this->reminfo[''],
                // ]);
            }
        //dd($this->reminfo['amntCollected']);
       
           
    
    
        
        
        
      
       // $remit = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/Remit', $data);                                     
        return redirect()->to('/collection/remittance/'.$this->foid.'/'.$this->areaRefNo.'/'.$this->areaID)->with(['mmessage'=> 'Remittance successfully saved', 'mword'=> 'Success']);    
    }

    public function saveExpenses(){
        $rules = [];
        $messages = [];
        if($this->expcnt){
            foreach($this->expcnt as $cnt){
                $rules['expenses.expense'.$cnt] = ['required'];
                $rules['expenses.amount'.$cnt] = ['required', 'numeric', 'min:1'];
                $messages['expenses.expense'.$cnt.'.required'] = 'Required field';
                $messages['expenses.amount'.$cnt.'.required'] = 'Required field';
                $messages['expenses.amount'.$cnt.'.numeric'] = 'Must be a number';
                $messages['expenses.amount'.$cnt.'.min'] = 'Must be > than 0';
            }
        }

        $this->validate($rules, $messages);

        $data = [];
        if($this->expcnt){
            foreach($this->expcnt as $cnt){
                $data[] = [
                            "expensesDescription"=>  $this->expenses['expense'.$cnt],
                            "fieldExpenses"=> $this->expenses['amount'.$cnt],
                            "areaRefno"=> $this->areaRefNo,
                            "areaId"=> $this->areaID
                          ];
            }
        }

        CollectionArea::where('Area_RefNo',$this->areaRefNo)->update([
            'FieldExpenses' => $this->expenses['amount'.$cnt],
        ]);

       // $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/FieldExpenses', $data);                
        return redirect()->to('/collection/remittance/'.$this->foid.'/'.$this->areaRefNo.'/'.$this->areaID)->with(['mmessage'=> 'Field expenses successfully saved', 'mword'=> 'Success']);    
    }

    public function cancelExpenses(){
        if($this->expcnt){
            foreach($this->expcnt as $cnt){
                if(($key = array_search($cnt, $this->expcnt)) !== false) { 
                    $this->expenses['expense'.$cnt] = null;
                    $this->expenses['amount'.$cnt] = null;       
                    unset($this->expcnt[$key]); 
                }   
            }
        }
        $this->expcnt = [1];
        $this->getTotalExp();        
    }

    public function addExpenses(){
        $lastcnt = end($this->expcnt);
        $this->expcnt[] = $lastcnt + 1;      
    }

    public function subExpenses(){
        $lastcnt = end($this->expcnt);     
        if($lastcnt != 1){        
            if(($key = array_search($lastcnt, $this->expcnt)) !== false) { 
                $this->expenses['expense'.$lastcnt] = null;
                $this->expenses['amount'.$lastcnt] = null;       
                unset($this->expcnt[$key]); 
            }   
            $this->getTotalExp();              
        }     
    }

    public function getTotalExp(){
        $this->totalexp = 0;
        if($this->expcnt){
            foreach($this->expcnt as $cnt){
                $this->totalexp = $this->totalexp + (isset($this->expenses['amount'.$cnt]) ? (is_numeric($this->expenses['amount'.$cnt]) ? $this->expenses['amount'.$cnt] : 0) : 0);
            }
        }
    }

    public function mount($areaRefNo = ''){
        $this->areaRefNo = $areaRefNo;      
        $this->expcnt = [1];     

        $area = Area::where('FOID',$this->foid)->first();
        $collectionAreas = CollectionArea::where('AreaId',$area->Id)->WhereNull('Collection_Status')->orWhere('Collection_Status',4)->get();
        if($collectionAreas){
            foreach($collectionAreas as $collectionArea){
                $areaReference = [];
                $areaReference['areaRefNo'] = $collectionArea->Area_RefNo;
                $areaReference['areaID'] = $area->Id;
                $this->arealist[] = $areaReference;

            }
        }     
    }
    
    public function render()
    {             
        $this->list=[];
        $area =  Area::where('Id',$this->areaID)->first();
        $locations = explode("|",$area->City);
        $persons=[];

         $collectionAreaMembers = CollectionAreaMember::where("Area_RefNo",$this->areaRefNo)->where('Payment_Status',2)->get();
         $collectibles=0;
         $loanHistory=0;
         $totalSavings=0;
         $applicationData=[];
         foreach($collectionAreaMembers as $collectionAreaMember){
      
            $application= Application::where('NAID',$collectionAreaMember->NAID)->where('Status',14)->with('member')->with('termsofpayment')->with('detail')->with('loanhistory')->first();
            
            $savings= MembersSavings::where('MemId',$application->MemId)->first();
         
     
            if(!is_null($application)) {
                if($application->loanhistory->OutstandingBalance != 0){
                $collectionAreaMembers = CollectionAreaMember::where('NAID',$application->NAID)->where('AdvanceStatus',0)->get();
                $totalLapses =0;
                $totalAdvance = 0;
                if($collectionAreaMembers){
                    foreach($collectionAreaMembers as $collectionAreaMember){
                        $totalLapses +=  $collectionAreaMember->LapsePayment;
                        $totalAdvance +=  $collectionAreaMember->AdvancePayment;
                    }
                }
               
                $collectibles +=  $application->detail->ApprovedDailyAmountDue;
                $loanHistory +=  $application->loanhistory->OutstandingBalance;
                $totalSavings +=  ( $savings) ? $savings->TotalSavingsAmount:0;
                $details['totalCollectible']= $collectibles;
                $details['total_Balance']= $loanHistory;
                $details['total_savings']=  $totalSavings;
                $details['total_advance']= 0;
                $details['total_lapses']= 0;
                $details['total_collectedAmount']= 0;
                $details['total_FieldExpenses']= 0;
                $details['daily_savings']= 0;
                $details['penalty']= 0;
                $applicationData['areaID'] = $this->areaID;
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
                $applicationData['amountDue'] = $application->loanhistory->OutstandingBalance;
                $applicationData['pastDue'] = 0;
                $applicationData['totalSavingsAmount'] = ( $savings) ? $savings->TotalSavingsAmount:0;
                $applicationData['advancePayment'] = 0;
                // $applicationData['payment_Status'] = ($paymentStatus) ? $paymentStatus->Status:'';
                // $applicationData['collection_Status'] = ($collectionStatus) ? $collectionStatus->Status:'';
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
                $applicationData['lapsePayment'] = $totalLapses;
                $applicationData['advancePayment'] = $totalAdvance;
                $applicationData['naid'] = $application->NAID;
                $applicationData['memId'] = $application->MemId;
                $this->list[] = $applicationData; 
            }

            }
            
         }

        // $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/CollectionDetailsViewbyAreaRefno', ['areaid' => $this->areaID, 'area_refno' => $this->areaRefNo]);                
        // //dd($data->getStatusCode());
        // if($data->getStatusCode() == 200){
        //     $data = $data->json();      
        //     //dd($data); 
        //     if(!empty($data[0]['collection'])){
        //         $this->list = collect($data[0]['collection']);           
        //     }   
        // }
        //dd($this->list);   
        return view('livewire.collection.collection.collection-remittance');
    }
}
