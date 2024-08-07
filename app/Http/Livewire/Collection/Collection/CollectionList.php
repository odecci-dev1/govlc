<?php

namespace App\Http\Livewire\Collection\Collection;

use App\Models\Collection;
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

    // public function render()
    // { 
    //     $collectionArea = Collection::all();
    //     $date = date('n/j/Y').' 12:00:00 AM';
        
    //     if( $this->displayrecent ){
    //         $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Collection/Areas', ['showprev' => 'true']);               
    //         $this->list =  collect($data->json());  
    //         dd($this->list);
    //     } else {
            
    //         $inputs = [
    //             'page' => $this->paginate['page'],
    //             'pageSize' => $this->paginate['pageSize'],
    //             'FilterName' => $this->keyword,
    //             'status' => 'Active',
    //             'module' => 'Collection',
    //         ];
            
    //         $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Pagination/DisplayListPaginate', $inputs);                 
            
    //         $this->list =  collect($data->json()['items']);                                             
    //         dd($this->list);

    //         if( $data->json()['totalPage'] ){
    //             $this->paginationPaging['totalPage'] = $data->json()['totalPage'];
    //             $this->paginationPaging['totalRecord'] = $data->json()['totalRecord'];
    //             $this->paginationPaging['currentPage'] = $data->json()['currentPage'];
    //             $this->paginationPaging['nextPage'] = $data->json()['nextPage'] < $data->json()['totalPage'] ?  $data->json()['nextPage'] : $data->json()['totalPage'];
    //             $this->paginationPaging['prevPage'] = $data->json()['prevPage'] > 0 ? $data->json()['prevPage'] : 1;
    //         }
    //     }
    //     $this->check = $this->list->where('dateCreated', $date)->first();   
    //     //dd(   $this->list );    
    //     return view('livewire.collection.collection.collection-list');
    // }

    // public function render()
    // {
    //     $date = date('n/j/Y').' 12:00:00 AM';

    //     $query = Collection::with(['collectionAreas.areaMembers']);

    //     if (!empty($this->keyword)) {
    //         $query->where('RefNo', 'like', '%' . $this->keyword . '%');
    //     }

    //     $query->orderBy('DateCreated', 'desc');

    //     $collections = $query->paginate($this->paginate['pageSize'], ['*'], 'page', $this->paginate['page']);

    //     $this->list = $collections->map(function ($collection) {
    //         $totals = $collection->collectionAreas->flatMap->areaMembers->reduce(function ($carry, $member) {
    //             $carry['total_advance'] += $member->AdvancePayment;
    //             $carry['total_lapses'] += $member->LapsePayment;
    //             $carry['totalCollectible'] += $member->CollectedAmount;
    //             $carry['total_savings'] += $member->Savings;
    //             $carry['total_Balance'] += $member->CollectedAmount - $member->AdvancePayment - $member->LapsePayment;
    //             return $carry;
    //         }, [
    //             'total_advance' => 0, 
    //             'total_lapses' => 0, 
    //             'totalCollectible' => 0, 
    //             'total_savings' => 0, 
    //             'total_Balance' => 0
    //         ]);

    //         $collection->totals = $totals;

    //         return $collection;
    //     });

    //     $this->paginationPaging['totalPage'] = $collections->lastPage();
    //     $this->paginationPaging['totalRecord'] = $collections->total();
    //     $this->paginationPaging['currentPage'] = $collections->currentPage();
    //     $this->paginationPaging['nextPage'] = $collections->currentPage() < $collections->lastPage() ? $collections->currentPage() + 1 : $collections->lastPage();
    //     $this->paginationPaging['prevPage'] = $collections->currentPage() > 1 ? $collections->currentPage() - 1 : 1;

    //     $this->check = $this->list->where('DateCreated', $date)->first();

    //     return view('livewire.collection.collection.collection-list', [
    //         'collections' => $this->list,
    //     ]);
    // }

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

        $one = $this->list = $collections->map(function ($collection) {
            $totals = $collection->collectionAreas->flatMap->areaMembers->reduce(function ($carry, $member) {
                $carry['total_advance'] += $member->AdvancePayment;
                $carry['total_lapses'] += $member->LapsePayment;
                $carry['totalCollectible'] += $member->CollectedAmount;
                $carry['total_savings'] += $member->Savings;
                $carry['total_Balance'] += $member->CollectedAmount - $member->AdvancePayment - $member->LapsePayment;
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
