<?php

namespace App\Http\Livewire\Collection\Collection;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CollectionList extends Component
{
    public $list;
    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/Areas');  
        $data = $data->json();
        $this->list = collect($data);
        //dd($this->list);
        return view('livewire.collection.collection.collection-list');
    }
}
