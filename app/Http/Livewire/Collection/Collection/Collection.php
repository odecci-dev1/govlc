<?php

namespace App\Http\Livewire\Collection\Collection;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class Collection extends Component
{

    public $areas = [];
    public $areaID = '';
    public $foid = '';
    public $folist = [];

    public $areaDetails = [];    
    public $areaDetailsFooter = [];

    public function print(){
        $print = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/PrintCollection', ['areaID' => $this->areaID, 'foid' => $this->foid]);    
        $this->emit('openUrlPrintingStub', ['url' => URL::to('/').'/collection/print/area/'.$this->areaID]);      
        //$crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Releasing/ReleasingComplete', $data);                                    
        return redirect()->to('/collection/view');
        //$this->areaID = $this->areaID;       
    }
    
    public function getCollectionDetails($areaID, $foid){
        if($this->areaID == ''){
            $this->areaID = $areaID;       
            $this->foid = $foid;
        }
        else{
            if($this->areaID == $areaID){
                $this->areaID = '';  
                $this->foid = '';     
            }
            else{
                $this->areaID = $areaID;    
                $this->foid = $foid;   
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
            //dd($this->areas);
            //dd( $this->areaDetails->where('areaID', 'AREA-021') );    
        }

        $mfolist = collect([]);
        $folist = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldOfficer/FieldOfficerList');  
        $folist = $folist->json();
        if($folist){
            $mfolist = collect($folist);
        }
        $this->folist = $mfolist->sortBy('lname');
        //dd($this->folist);
    }

    public function render()
    {
        return view('livewire.collection.collection.collection');
    }
}
