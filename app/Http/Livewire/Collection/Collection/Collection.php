<?php

namespace App\Http\Livewire\Collection\Collection;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Collection extends Component
{

    public $areas = [];
    public $areaID = '';

    public function getCollectionDetails($areaID){
        // $this->areaID = $areaID;       
    }

    public function mount(){
        $areas = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/Areas');  
        $areas = $areas->json();
        // dd($areas);
        if( $areas ){
            $this->areas = $areas;
        }
    }

    public function render()
    {
        return view('livewire.collection.collection.collection');
    }
}
