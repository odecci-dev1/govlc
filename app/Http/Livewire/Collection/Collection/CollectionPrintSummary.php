<?php

namespace App\Http\Livewire\Collection\Collection;

use App\Models\Application;
use App\Models\Area;
use App\Models\CollectionArea;
use App\Models\CollectionAreaMember;
use App\Models\CollectionStatus;
use App\Models\FieldOfficer;
use App\Models\LoanHistory;
use App\Models\Members;
use App\Models\MembersSavings;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CollectionPrintSummary extends Component
{
    public $areas;
    public $colrefNo = '';
    
    public function render()
    {
        $areas   = Area::whereNotNull('FOID')->where('Status',1)->get();
        foreach($areas as $area){
            $collectionArea = CollectionArea::where('CollectionRefNo',$this->colrefNo)->where('AreaId', $area->Id)->first();
            $printStatus = ($collectionArea) ? CollectionStatus::where('Id',$collectionArea->Printed_Status)->first():'';
            $collectionStatus = ($collectionArea) ? CollectionStatus::where('Id',$collectionArea->Collection_Status)->first():'';
            $locations = explode("|",$area->City);
            $persons=[];
            // foreach($locations as $location){
            //     $address = explode(",",$location);
            //     $barangay = trim($address[0],' ');
            //     $city = trim($address[1],' ');
            //     $membersPerLocations =  Members::where([['Barangay','LIKE','%'.$barangay.'%'],['City','LIKE','%'.$city.'%'],['Status','=',1]])->get();
            //     foreach($membersPerLocations as $member){
            //         $persons[] = $member;
            //     }
            // }
          
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
             $details['total_Balance']= 0;
             $details['total_savings']= 0;
             $details['total_advance']= 0;
             $details['total_lapses']= 0;
             $details['grand_totalCollectible']=0;
             $details['grand_total_collectedAmount']=0;
             $details['grand_total_Balance'] = 0;
             $details['grand_total_savings'] =0;
             $details['grand_total_advance'] =0;
             $details['grand_total_lapses'] =0;
            $collectionAreaMembers = CollectionAreaMember::where('Area_RefNo')->get();
            $totalCollectionAdvance=0;
            $totalCollecitonLapses=0;
            $totalCollected=0;
             foreach($collectionAreaMembers as $collectionAreaMember){
                $application= Application::where('NAID',$collectionAreaMember->NAID)->where('Status',14)->with('member')->with('termsofpayment')->with('detail')->with('loanhistory')->first();
                $savings= MembersSavings::where('MemId',$application->MemId)->first();
               
                if(!is_null($application)) {
                    if($application->loanhistory->OutstandingBalance != 0){

                        //Get back to you//
                        //get updated lapses, advance and collected amount within this collection//
                        $collectionAreasMembers = CollectionAreaMember::where('NAID',$application->NAID)->get();
                   
                        if($collectionAreasMembers){
                            foreach( $collectionAreasMembers as $collectionAreaMember){
                                $totalCollectionAdvance += $collectionAreaMember->AdvancePayment;
                                $totalCollecitonLapses += $collectionAreaMember->LapsePayment - $collectionAreaMember->UsedAdvancePayment;
                                $totalCollected += $collectionAreaMember->CollectedAmount;
                            }
                        }

                        $collectionAreaMember = CollectionAreaMember::where('NAID',$application->NAID)->where('Area_RefNo', ($collectionArea) ? $collectionArea->Area_RefNo:'')->first();
                        $collectionArea = CollectionAreaMember::where('NAID',$application->NAID)->where('Area_RefNo', ($collectionArea) ? $collectionArea->Area_RefNo:'')->first();
                        $collectibles +=  $application->detail->ApprovedDailyAmountDue;
                        $loanHistory +=  $application->loanhistory->OutstandingBalance;
                        $totalSavings +=  ($savings) ? $savings->TotalSavingsAmount:0;
                        $totalLapses += $totalCollecitonLapses;
                        $totalAdvance += $totalCollectionAdvance;
                        $totalCollectedAmount += $totalCollected;
                        
                        $totalItems +=  1;
                        
                        $details['totalCollectible']= $collectibles;
                        $details['total_collectedAmount']= $totalCollectedAmount;
                        $details['total_Balance']=  $application->loanhistory->OutstandingBalance;
                        $details['total_savings']= $totalSavings ;
                        $details['total_advance']= $totalAdvance;
                        $details['total_lapses']= $totalLapses;
                        $appDetails[]=$printStatus;
                        $details['application'] = $appDetails;
                        
                    }
                }
                // $details['grand_totalCollectible'] += $details['totalCollectible'];
                // $details['grand_total_collectedAmount'] += $details['total_collectedAmount'];
                // $details['grand_total_Balance'] += $details['total_Balance'];
                // $details['grand_total_savings'] += $details['total_savings'];
                // $details['grand_total_advance'] += $details['total_advance'];
                // $details['grand_total_lapses'] += $details['total_lapses'];
            }
           
        //$this->areas=collect($details);
        $this->areas[] = $details;
        } 
       // dd(array_sum(array_column($this->areas,'totalCollectible')));
       // dd( json_encode($this->areas)->sum(1));
        
        return view('livewire.collection.collection.collection-print-summary');
    }
}
