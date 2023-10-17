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

        
    }

    public function mount(){
        $this->areas = collect([]);
        $this->areaDetails = collect([]);
        $this->areaDetailsFooter = collect([]);
        $areas = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/AreasCollectionList');  
        $areas = $areas->json();
        //dd($areas);
        if( $areas ){
            $this->areas = collect($areas);
            foreach($this->areas as $mareas){
                $details = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/CollectionDetailsList', ['areaid' => $mareas['areaID']]);  
                $details = $details->json();
                if($details){
                    $details = $details[0];                                       
                    $collections = $details['collection'];
                    if($collections){
                        $this->areaDetailsFooter[$mareas['areaID']] = [
                                                                        'areaID' => $mareas['areaID'],
                                                                        'totalCollectible' => $details['totalCollectible'],
                                                                        'total_Balance' => $details['total_Balance'],
                                                                        'total_savings' => $details['total_savings'],
                                                                        'total_advance' => $details['total_advance'],
                                                                        'total_lapses' => $details['total_lapses'],
                                                                        'total_collectedAmount' => $details['total_collectedAmount'],
                                                                      ];
                        foreach($collections as $coll){
                            $this->areaDetails =  $this->areaDetails->push($coll);
                        }                        
                    }                                                 
                }
            }
            //dd($this->areaDetailsFooter);
            //dd( $this->areaDetails->where('areaID', 'AREA-021') );    
        }
    }

    public function render()
    {
        return view('livewire.collection.collection.collection');
    }
}
