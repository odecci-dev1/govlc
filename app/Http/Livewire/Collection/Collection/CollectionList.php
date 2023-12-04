<?php

namespace App\Http\Livewire\Collection\Collection;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class CollectionList extends Component
{
    public $list;
    public $check = 0;
    public $displayrecent;
    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/Areas');  
        $data = $data->json();
        $mlist = collect($data);        
        $date = date('m/d/Y').' 12:00:00 AM';        
        if($this->displayrecent){           
            $t = strtotime("-7 days");
            $get7days = date('m/d/Y', $t);
            $this->list = $mlist->filter(function ($item) use ($get7days) {
                return (data_get($item, 'dateCreated') > $get7days.' 12:00:00 AM' );
            });
        }
        else{
            $this->list = $mlist;
        }     
        $this->check = $this->list->where('dateCreated', $date)->first();                   
        return view('livewire.collection.collection.collection-list');
    }
}
