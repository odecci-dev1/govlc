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
    public $arealist = [];
    public $foid = '';
    public $areaID = '';

    public $memid = '';
    public $reminfo;

    //expenses
    public $expenses;
    public $expcnt = [];
    public $totalexp = 0;

    public function rules(){                
        $rules = []; 
        return $rules;
    }

    public function setRemmittInfo($naid = '', $memid = ''){
        $appdtl = $this->list->where('naid', $naid)->first();      
        $this->memid =  $memid;
        $this->reminfo['savings'] = 0;
    }

    public function computeLapses(){
        if(isset($this->reminfo['amntCollected'])){
            $data = [
                "memId"=> $this->memid,
                "areaRefno"=> $this->areaRefNo,
                "amountCollected"=> $this->reminfo['amntCollected']
            ];         
            $compute = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/RemitAmountCollectedComputation', $data);             
            //dd($compute);
            $compute = $compute->json();
        
            if($compute){         
                $this->reminfo['lapses'] = isset($compute['lapses']) ? $compute['lapses'] : 0;
                $this->reminfo['advance'] = isset($compute['advance']) ? $compute['advance'] : 0;              
            }
            
        }
    }

    public function resetRemittance(){
        $this->memid = '';
        $this->reminfo['amntCollected'] = null;
        $this->reminfo['savings'] = null;
        $this->reminfo['lapses'] = null;
        $this->reminfo['advance'] = null;
        $this->reminfo['modeOfPayment'] = null;
    }

    public function remit(){
        $rules = [];
        $rules['reminfo.amntCollected'] = ['required', 'numeric', 'min:0'];
        $rules['reminfo.savings'] = ['numeric', 'min:0']; 
        $rules['reminfo.modeOfPayment'] = ['required'];      

        $messages = [];
        $messages['reminfo.amntCollected.required'] = 'Required field';
        $messages['reminfo.amntCollected.numeric'] = 'Must be a number';
        $messages['reminfo.amntCollected.min'] = 'Must be >= than 0';
        $messages['reminfo.savings.required'] = 'Required field';
        $messages['reminfo.savings.numeric'] = 'Must be a number';
        $messages['reminfo.savings.min'] = 'Must be >= than 0';
        $messages['reminfo.modeOfPayment.required'] = 'Required field';
       
        
        $this->validate($rules, $messages);
        $data = [
                    "memId"=> $this->memid,
                    "savings"=> isset($this->reminfo['savings']) ? $this->reminfo['savings'] : 0,
                    "modeOfPayment"=> $this->reminfo['modeOfPayment'],
                    "areaRefno"=> $this->areaRefNo,
                    "areaID"=> $this->areaID,
                    "amountCollected"=> $this->reminfo['amntCollected'],
                    "advancePayment"=> isset($this->reminfo['advance']) ? $this->reminfo['advance'] : 0,
                    "lapses"=> isset($this->reminfo['lapses']) ? $this->reminfo['lapses'] : 0,
                    "userId"=> session()->get('auth_userid'),
                    "foid"=> $this->foid
                ];
        $remit = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/Remit', $data);                                     
        return redirect()->to('/collection/remittance/'.$this->foid.'/'.$this->areaRefNo.'/'.$this->areaID)->with(['mmessage'=> 'Remittance successfully saved', 'mword'=> 'Success']);    
    }

    public function saveExpenses(){
        $rules = [];
        $messages = [];
        if($this->expcnt){
            foreach($this->expcnt as $cnt){
                $rules['expenses.expense'.$cnt] = ['required'];
                $rules['expenses.amount'.$cnt] = ['required', 'numeric', 'min:1'];
                $messages['expenses.expense'.$cnt.'.required'] = 'Required field';
                $messages['expenses.amount'.$cnt.'.required'] = 'Required field';
                $messages['expenses.amount'.$cnt.'.numeric'] = 'Must be a number';
                $messages['expenses.amount'.$cnt.'.min'] = 'Must be > than 0';
            }
        }

        $this->validate($rules, $messages);

        $data = [];
        if($this->expcnt){
            foreach($this->expcnt as $cnt){
                $data[] = [
                            "expensesDescription"=>  $this->expenses['expense'.$cnt],
                            "fieldExpenses"=> $this->expenses['amount'.$cnt],
                            "areaId"=> $this->areaID
                          ];
            }
        }
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Collection/FieldExpenses', $data);                
        return redirect()->to('/collection/remittance/'.$this->foid.'/'.$this->areaRefNo.'/'.$this->areaID)->with(['mmessage'=> 'Field expenses successfully saved', 'mword'=> 'Success']);    
    }

    public function cancelExpenses(){
        if($this->expcnt){
            foreach($this->expcnt as $cnt){
                if(($key = array_search($cnt, $this->expcnt)) !== false) { 
                    $this->expenses['expense'.$cnt] = null;
                    $this->expenses['amount'.$cnt] = null;       
                    unset($this->expcnt[$key]); 
                }   
            }
        }
        $this->expcnt = [1];
        $this->getTotalExp();        
    }

    public function addExpenses(){
        $lastcnt = end($this->expcnt);
        $this->expcnt[] = $lastcnt + 1;      
    }

    public function subExpenses(){
        $lastcnt = end($this->expcnt);     
        if($lastcnt != 1){        
            if(($key = array_search($lastcnt, $this->expcnt)) !== false) { 
                $this->expenses['expense'.$lastcnt] = null;
                $this->expenses['amount'.$lastcnt] = null;       
                unset($this->expcnt[$key]); 
            }   
            $this->getTotalExp();              
        }     
    }

    public function getTotalExp(){
        $this->totalexp = 0;
        if($this->expcnt){
            foreach($this->expcnt as $cnt){
                $this->totalexp = $this->totalexp + (isset($this->expenses['amount'.$cnt]) ? (is_numeric($this->expenses['amount'.$cnt]) ? $this->expenses['amount'.$cnt] : 0) : 0);
            }
        }
    }

    public function mount($areaRefNo = ''){
        $this->areaRefNo = $areaRefNo;      
        $this->expcnt = [1];     
        $arealist = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/GetAreaReferenceNo', ['FOID' => $this->foid]);  
        $this->arealist = $arealist->json();       
    }
    
    public function render()
    {             
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/CollectionDetailsViewbyAreaRefno', ['areaid' => $this->areaID, 'area_refno' => $this->areaRefNo]);                
        //dd($data->getStatusCode());
        if($data->getStatusCode() == 200){
            $data = $data->json();      
            //dd($data); 
            if(!empty($data[0]['collection'])){
                $this->list = collect($data[0]['collection']);           
            }   
        }
        //dd($this->list);   
        return view('livewire.collection.collection.collection-remittance');
    }
}
