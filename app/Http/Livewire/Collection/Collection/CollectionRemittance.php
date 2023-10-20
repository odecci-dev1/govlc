<?php

namespace App\Http\Livewire\Collection\Collection;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;

class CollectionRemittance extends Component
{
    use Common;
    public $areaRefNo;
    public $list;
    public $foid = '';

    public $memid = '';
    public $reminfo;

    public function setRemmittInfo($naid = ''){
        $appdtl = $this->list->where('naid', $naid)->first();
        $this->memid =  $appdtl ?  $appdtl['memId'] : '';
    }

    public function computeLapses(){
        if(isset($this->reminfo['amntCollected'])){
            $data = [
                "memId"=> $this->memid,
                "areaRefno"=> $this->areaRefNo,
                "amountCollected"=> $this->reminfo['amntCollected']
            ];
            $compute = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/RemitAmountCollectedComputation', $data);  
            $compute = $compute->json();
        
            if($compute){         
                $this->reminfo['lapses'] = isset($compute['lapses']) ? $compute['lapses'] : 0;
                $this->reminfo['advance'] = isset($compute['advance']) ? $compute['advance'] : 0;
            }
        }
    }

    public function remit(){
        $data = [
                    "memId"=> $this->memid,
                    "savings"=> $this->reminfo['savings'],
                    "modeOfPayment"=> $this->reminfo['modeOfPayment'],
                    "areaRefno"=> $this->areaRefNo,
                    "amountCollected"=> $this->reminfo['amntCollected'],
                    "advancePayment"=> $this->reminfo['advance'],
                    "lapses"=> $this->reminfo['lapses'],
                    "userId"=> session()->get('auth_userid'),
                    "foid"=> $this->foid
                ];
        $compute = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/Remit', $data);               
      
        return redirect()->to('/collection/remittance/'.$this->areaRefNo)->with(['mmessage'=> 'Remittance successfully saved', 'mword'=> 'Success']);    
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
            $this->foid = $this->list[0]['foid'];
        }   
        //dd($this->list);
        return view('livewire.collection.collection.collection-remittance');
    }
}
