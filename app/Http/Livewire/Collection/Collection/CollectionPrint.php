<?php

namespace App\Http\Livewire\Collection\Collection;

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
      
        $details = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/CollectionDetailsList', ['areaid' => $this->areaID, 'arearefno' => $this->areaRefNo]);         
   
        $details = $details->json();           
       
        if($details){
            $details = $details[0];                       
            $collections = $details['collection'];
            if($collections){
                $this->areaDetailsFooter[$this->areaID] = [
                                        'areaID' =>$this->areaID,
                                        'totalCollectible' => $details['totalCollectible'],
                                        'total_Balance' => $details['total_Balance'],
                                        'total_savings' => $details['total_savings'],
                                        'total_advance' => $details['total_advance'],
                                        'total_lapses' => $details['total_lapses'],
                                        'total_collectedAmount' => $details['total_collectedAmount'],
                                      ];
                //dd($collections);     
                $cnt = 0;                 
                foreach($collections as $coll){
                    $cnt = $cnt + 1;          
                    if($coll['payment_Status'] != 'Paid'){
                        $this->areaDetails =  $this->areaDetails->put($cnt, $coll);
                    }                   
                }                    
            }                         
        }      
        //dd($this->areaDetails);
      // dd($this->areaDetails);
    }

    public function render()
    {
        return view('livewire.collection.collection.collection-print');
    }
}
