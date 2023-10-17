<?php

namespace App\Http\Livewire\Collection\Collection;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Collection extends Component
{

    public $areas = [];
    public $areaID = '';

    public $areaDetails = [];    
    public $areaDetailsFooter = [];

    public function getCollectionDetails($areaID){
        if($this->areaID == ''){
            $this->areaID = $areaID;       
        }
        else{
            if($this->areaID == $areaID){
                $this->areaID = '';       
            }
            else{
                $this->areaID = $areaID;       
            }
        }

        if($this->areaID != ''){
            $details = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/CollectionDetailsList', ['areaid' => $this->areaID]);  
            $details = $details->json();
            if($details){
                $details = $details[0];
                //dd($details);
                $this->areaDetailsFooter['totalCollectible'] = $details['totalCollectible'];
                $this->areaDetailsFooter['total_Balance'] = $details['total_Balance'];
                $this->areaDetailsFooter['total_savings'] = $details['total_savings'];
                $this->areaDetailsFooter['total_advance'] = $details['total_advance'];
                $this->areaDetailsFooter['total_lapses'] = $details['total_lapses'];
                $this->areaDetailsFooter['total_collectedAmount'] = $details['total_collectedAmount'];
                
                $collections = $details['collection'];
                if($collections){
                    $this->areaDetails = $collections;
                }
                //dd($this->areaDetails);
            }
        }
        else{
            $this->areaDetails = [];
            $this->areaDetailsFooter = [];
        }
        
    }

    public function mount(){
        $areas = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/AreasCollectionList');  
        $areas = $areas->json();
        //dd($areas);
        if( $areas ){
            $this->areas = $areas;
        }
    }

    public function render()
    {
        return view('livewire.collection.collection.collection');
    }
}
