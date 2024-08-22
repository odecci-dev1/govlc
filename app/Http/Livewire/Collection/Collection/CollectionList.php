<?php

namespace App\Http\Livewire\Collection\Collection;

use App\Models\Collection;
use App\Models\LoanDetails;
use App\Models\LoanHistory;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class CollectionList extends Component
{
    public $list;
    public $check = 0;
    public $displayrecent = false;
    public $keyword = '';
    public $paginate = [];
    public $paginationPaging = [];

    public $runningBalance = 0;
    public $tester = [];

    public function mount(){
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 25;
        $this->paginate['FilterName'] = '';        
        $this->paginationPaging['totalPage'] = 0;  
        $this->paginationPaging['totalRecord'] = 0;       
        $this->displayrecent = false; 
    }

    public function setToFalse(){
        $this->displayrecent = null;
    }

    public function setPage($page = 1){
        $this->paginate['page'] = $page;
    }


    public function render()
    {
        $date = Carbon::now()->startOfDay();

        $query = Collection::with(['collectionAreas.areaMembers']);

        if (!empty($this->keyword)) {
            $query->where('RefNo', 'like', '%' . $this->keyword . '%');
        }

        if ($this->displayrecent) {
            $query->whereDate('DateCreated', $date);
        } else {
            $query->orderBy('DateCreated', 'desc');
        }
    
         $collections = $query->paginate($this->paginate['pageSize'], ['*'], 'page', $this->paginate['page']);
        // foreach( $collections as $collection ){
        //          $carry=[];
        //         foreach($collection->collectionAreas->flatMap->areaMember as $member){
        //             $details=[];
        //             $getLoanDetails = LoanDetails::where('NAID',$member->NAID)->first();
        //             $getLoanHistory = LoanHistory::where('NAID',$member->NAID)->first();
        //             $details['total_advance'] += $member->AdvancePayment;
        //             $details['total_lapses'] += $member->LapsePayment - $member->UsedAdvancePayment;
        //             $details['totalCollectible'] += ($getLoanHistory->Penalty != 0) ? $getLoanHistory->OutstandingBalance:$getLoanDetails->ApprovedDailyAmountDue;
        //             $details['total_savings'] += $member->Savings;
        //             $details['total_Balance'] += $getLoanDetails->BeginningBalance - $member->CollectedAmount ;
        //             $carry[] = $details;
        //              //$carry['total_Balance'] += $member->CollectedAmount + $member->AdvancePayment + $member->LapsePayment;
        //         }
        //         $this->list[] = $carry;   
        // }
        //dd($this->list);
        $one = $this->list = $collections->map(function ($collection) {
            $runningBalance = 0;
            $totals = $collection->collectionAreas->flatMap->areaMembers->reduce(function ($carry, $member) {
                $getLoanDetails = LoanDetails::where('NAID',$member->NAID)->first();
                $getLoanHistory = LoanHistory::where('NAID',$member->NAID)->first();
                $carry['total_advance'] += $member->AdvancePayment;
                $carry['total_lapses'] += $member->LapsePayment - $member->UsedAdvancePayment;
                $carry['totalCollectible'] += ($getLoanHistory->Penalty != 0) ? $getLoanHistory->OutstandingBalance:$getLoanDetails->ApprovedDailyAmountDue;
                $carry['total_savings'] += $member->Savings;
                $runningBalance = $getLoanDetails->BeginningBalance - $member->CollectedAmount ;
                $carry['total_Balance'] += $runningBalance;
                 //$carry['total_Balance'] += $member->CollectedAmount + $member->AdvancePayment + $member->LapsePayment;
                return $carry;
            }, [
                'total_advance' => 0, 
                'total_lapses' => 0, 
                'totalCollectible' => 0, 
                'total_savings' => 0, 
                'total_Balance' => 0
            ]);

            $collection->totals = $totals;
            
            return $collection;
        });
      
        // $inputs = [
        //     'page' => $this->paginate['page'],
        //     'pageSize' => $this->paginate['pageSize'],
        //     'FilterName' => $this->keyword,
        //     'status' => 'Active',
        //     'module' => 'Collection',
        // ];
        
        // $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Pagination/DisplayListPaginate', $inputs);                 
        
        // $two = $this->list =  collect($data->json()['items']);                                             
        // dd($one, $two);
        // dd($this->list);

        // Update pagination details
        $this->paginationPaging['totalPage'] = $collections->lastPage();
        $this->paginationPaging['totalRecord'] = $collections->total();
        $this->paginationPaging['currentPage'] = $collections->currentPage();
        $this->paginationPaging['nextPage'] = $collections->currentPage() < $collections->lastPage() ? $collections->currentPage() + 1 : $collections->lastPage();
        $this->paginationPaging['prevPage'] = $collections->currentPage() > 1 ? $collections->currentPage() - 1 : 1;

        // Check if there's an entry for the current date
        $this->check = $this->list->where('DateCreated', $date)->first();

        return view('livewire.collection.collection.collection-list', [
            'collections' => $this->list,
        ]);
    }
}
