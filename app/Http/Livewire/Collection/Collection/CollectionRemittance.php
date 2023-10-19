<?php

namespace App\Http\Livewire\Collection\Collection;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CollectionRemittance extends Component
{
    public $areaRefNo;
    public $list;

    public function setRemmittInfo($naid = ''){
        $appdtl = $this->list->where('naid', $naid)->first();
        //dd($appdtl);
        $data = [
                    "memId"=> $appdtl['memId'],
                    "savings"=> 0,
                    "modeOfPayment"=> "string",
                    "areaRefno"=> "string",
                    "amountCollected"=> 500,
                    "advancePayment"=> 0,
                    "lapses"=> 0,
                    "userId"=> "string"
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
        //dd( $this->list );
        return view('livewire.collection.collection.collection-remittance');
    }
}
