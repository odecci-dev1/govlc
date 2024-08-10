<?php

namespace App\Http\Livewire\Transactions\Application;

use App\Models\Application;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;

class ApplicationListTrash extends Component
{
    use Common;
    public $keyword = '';
    public $list = [];

    
    public function restore($naID){        
       Application::where('NAID',$naID)->update([
        'Status' => 7,
            'DeclineDate'=>'',
             'DeclinedBy'=>'',
        ]);                                              
        return redirect()->to('/tranactions/trashed/application/list')->with('mmessage', 'Application has been restore');  
    }

    public function render()
    {
        $filter = [ 'page' => 1, 'pageSize' => 999999999, 'borrower' => $this->keyword ];
        $this->list = Application::where('Status',2)->get();                 
              
        return view('livewire.transactions.application.application-list-trash');
    }
}
