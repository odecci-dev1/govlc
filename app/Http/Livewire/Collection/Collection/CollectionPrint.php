<?php

namespace App\Http\Livewire\Collection\Collection;

use App\Models\Application;
use App\Models\Area;
use App\Models\CollectionArea;
use App\Models\CollectionAreaMember;
use App\Models\FieldOfficer;
use App\Models\MembersSavings;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;


class CollectionPrint extends Component
{
    public $areas = [];
    public $areaID = '';
    public $areaRefNo = '';

    public $areaDetails = [];    
    public $areaDetailsFooter = [];
    
    public function mount(){
        $this->areas = collect([]);
        $this->areaDetails = collect([]);
        $this->areaDetailsFooter = collect([]);

       
      
        $collectionAreaMembers = CollectionAreaMember::where('Area_RefNo',$this->areaRefNo)->where('AdvanceStatus',0)->get();
        if($collectionAreaMembers){
       
            $collectibles=0;
            $totalBalance=0;
            $totalSavings=0;
            $totalAdvance=0;
            $totalLapses=0;
            $totalCollected=0;
            $areaName='';
            $fieldOfficer='';
            foreach($collectionAreaMembers as $collectionAreaMember){
            
                $details=[];
              
                $getColectionArea = CollectionArea::where('Area_RefNo',$collectionAreaMember->Area_RefNo)->first();
                $getArea = Area::where('AreaID',$getColectionArea->AreaId)->first();
                $getFO = FieldOfficer::where('FOID',$getArea->FOID)->first();
                $application= Application::where('NAID',$collectionAreaMember->NAID)->where('Status',14)->with('member')->with('termsofpayment')->with('detail')->with('loanhistory')->first();
                $savings= MembersSavings::where('MemId',$application->member->MemId)->first();
                $collectibles +=  $application->detail->ApprovedDailyAmountDue;
                $totalBalance +=  $application->loanhistory->OutstandingBalance;
                $totalSavings +=  ($savings) ? $savings->TotalSavingsAmount:0;
                $getprviousCollectionRecord = CollectionAreaMember::where('NAID',$application->NAID)->where('AdvanceStatus',0)->get();
               // dd($getprviousCollectionRecord->sum('LapsePayment'));
                if($collectionAreaMember->NAID == $application->NAID){
                    $totalAdvance += $getprviousCollectionRecord->sum('AdvancePayment');
                    //$totalAdvance += $collectionAreaMember->AdvancePayment;
                }
                if($collectionAreaMember->NAID == $application->NAID){
                   
                    $totalLapses += $getprviousCollectionRecord->sum('LapsePayment');
                   //$totalLapses += $collectionAreaMember->LapsePayment;
                }
                if($collectionAreaMember->NAID == $application->NAID){
                    $totalCollected += $collectionAreaMember->CollectedAmount;
                }
                $areaName= $getArea->Area;
                
                $fieldOfficer= $getFO->Lname.', '.$getFO->Fname.' '. ( $getFO->Mname != "" ? $getFO->Mname:"");
                $details['memId']= $application->MemId;
                $details['cno']= $application->member->Cno;
                $details['borrower']=  $application->member->Lname.', '.  $application->member->Fname.' '. ( $application->member->Mname != "" ? $application->member->Mname[0].'.':"");
                
                $details['co_Borrower']=  $application->member->comaker->Lnam.', '.  $application->member->comaker->Fname.' '. ( $application->member->comaker->Mname != "" ? $application->member->comaker->Mname[0].'.':"");
                
                $details['co_Cno']= $application->NAID;
                $details['naid']= $application->NAID;
                $details['releasingDate']= $application->loanhistory->DateReleased;
                $details['dueDate']= $application->loanhistory->DueDate;
                $details['dailyCollectibles']= $application->detail->ApprovedDailyAmountDue;
                $details['amountDue']= $application->loanhistory->OutstandingBalance;
                $details['totalSavingsAmount']=  $totalSavings;
                $details['advancePayment']=  $totalAdvance;
                $details['lapsePayment']=  $totalLapses;
                $details['loanPrincipal']=  $application->detail->ApprovedLoanAmount;
                $details['typeOfCollection']=  $application->termsofpayment->collectionType->TypeOfCollection;
               
                

              
                $this->areaDetails[] = $details;
            }
           
            
            // $this->details['areaName'] = $areaName;
            // $this->details['area_RefNo']= $this->areaRefNo;
            // $this->details['fieldOfficer']= $fieldOfficer;
          
            $this->areaDetailsFooter = [
                'areaID' =>$this->areaID,
                'totalCollectible' => $collectibles,
                'total_Balance' => $totalBalance,
                'total_savings' => $collectibles,
                'total_advance' => $totalAdvance,
                'total_lapses' => $totalLapses,
                'total_collectedAmount' => $totalCollected,
                'areaName' => $areaName,
                'area_RefNo' => $this->areaRefNo,
                'fieldOfficer' => $fieldOfficer,
            ];

        
           
        }
     
    }

    public function render()
    {
        return view('livewire.collection.collection.collection-print');
    }
}
