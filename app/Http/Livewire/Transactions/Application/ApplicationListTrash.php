<?php

namespace App\Http\Livewire\Transactions\Application;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;

class ApplicationListTrash extends Component
{
    use Common;
    public $keyword = '';
    public $list = [];

    
    public function restore($naID){        
        $restore = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Application/RestoreApplication', ['naid' => $naID]);                                               
        return redirect()->to('/tranactions/trashed/application/list')->with('mmessage', 'Application has been restore');  
    }

    public function render()
    {
        $filter = [ 'page' => 1, 'pageSize' => 999999999, 'borrower' => $this->keyword ];
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Application/Application_TrashListPaginateFilter', $filter);                    
        $this->list = $data->json();             
        return view('livewire.transactions.application.application-list-trash');
    }
}
