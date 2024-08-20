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
                if($collectionAreaMember->NaID == $application->NAID){
                    $totalAdvance += $collectionAreaMember->AdvancePayment;
                }
                if($collectionAreaMember->NaID == $application->NAID){
                    $totalLapses += $collectionAreaMember->LapsePayment;
                }
                if($collectionAreaMember->NaID == $application->NAID){
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
                $details['amountDue']= $application->loanhistory->OutstandingBalance + (($application->loanhistory->Penalty) ? $application->loanhistory->Penalty:0);
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

            
            //dd( $this->areaDetailsFooter);
           
        }
        // $details = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/CollectionDetailsList', ['areaid' => $this->areaID, 'arearefno' => $this->areaRefNo]);         
   
        // $details = $details->json();           
       
        // if($details){
        //     $details = $details[0];                       
        //     $collections = $details['collection'];
        //     if($collections){
        //         $this->areaDetailsFooter[$this->areaID] = [
        //                                 'areaID' =>$this->areaID,
        //                                 'totalCollectible' => $details['totalCollectible'],
        //                                 'total_Balance' => $details['total_Balance'],
        //                                 'total_savings' => $details['total_savings'],
        //                                 'total_advance' => $details['total_advance'],
        //                                 'total_lapses' => $details['total_lapses'],
        //                                 'total_collectedAmount' => $details['total_collectedAmount'],
        //                               ];
        //         //dd($collections);     
        //         $cnt = 0;                 
        //         foreach($collections as $coll){
        //             $cnt = $cnt + 1;          
        //             if($coll['payment_Status'] != 'Paid'){
        //                 $this->areaDetails =  $this->areaDetails->put($cnt, $coll);
        //             }                   
        //         }                    
        //     }                         
        // }      
        //dd($this->areaDetails);
      // dd($this->areaDetails);
    }

    public function render()
    {
        return view('livewire.collection.collection.collection-print');
    }
}
