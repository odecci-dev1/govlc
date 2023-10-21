<?php

namespace App\Http\Livewire\Collection\Collection;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CollectionPrintSummary extends Component
{
    public $areas;
    
    public function render()
    {
        $areas = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/AreasCollectionList');  
        $areas = $areas->json();
        //dd($areas);
        if( $areas ){
            $this->areas = collect($areas);
        }
        return view('livewire.collection.collection.collection-print-summary');
    }
}
