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
    public $infoFooter;

    //cash denominations
    public $cashDenominations;
    public $totalDenomination = 0;

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

    public function print(){
        $print = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/PrintCollection', ['areaID' => $this->areaID, 'foid' => $this->foid]);    
        $this->emit('openUrlPrintingStub', ['url' => URL::to('/').'/collection/print/area/'.$this->areaID]);              
        return redirect()->to('/collection/view');       
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
            //dd( $this->areaDetails );
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
