<?php

namespace App\Http\Livewire\Collection\Collection;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CollectionRemittance extends Component
{
    public $areaRefNo;
    public $list;

    public $memid = '';

    public function setRemmittInfo($naid = ''){
        $appdtl = $this->list->where('naid', $naid)->first();
        $this->memid =  $appdtl ?  $appdtl['memId'] : '';
    }

    public function computeLapses(){
        $data = [
            "memId"=> "MEM-02",
            "areaRefno"=> "AREA-04420231019-02",
            "amountCollected"=> 500
        ];
        $compute = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/RemitAmountCollectedComputation', $data);  
        dd( $compute );
    }

    public function mount($areaRefNo = ''){
        $this->areaRefNo = $areaRefNo;
    }
    
    public function render()
    {
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/CollectionDetailsViewbyAreaRefno', ['area_refno' => $this->areaRefNo]);  
        $data = $data->json();
        if($data){
            $this->list = collect($data);
        }   
        return view('livewire.collection.collection.collection-remittance');
    }
}
