<?php

namespace App\Http\Livewire\Collection\Collection;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CollectionPrintSummary extends Component
{
    public $areas;
    public $colrefNo = '';
    
    public function render()
    {
        // $areas = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/AreasCollectionList');  
        $areas = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/CollectionDetailsViewbyRefno', ['colrefno' => $this->colrefNo]);  
        $areas = $areas->json();
        //dd($this->colrefNo);
        if( $areas ){
            $this->areas = collect($areas);
        }
        return view('livewire.collection.collection.collection-print-summary');
    }
}
