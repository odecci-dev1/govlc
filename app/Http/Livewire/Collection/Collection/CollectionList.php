<?php

namespace App\Http\Livewire\Collection\Collection;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class CollectionList extends Component
{
    public $list;
    public $check = 0;
    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/Areas');  
        $data = $data->json();
        $this->list = collect($data);
        // dd( $this->list);
        $date = date('m/d/Y').' 12:00:00 AM'; 
        $this->check = $this->list->where('dateCreated', $date)->first();       
        return view('livewire.collection.collection.collection-list');
    }
}
