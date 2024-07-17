<?php

namespace App\Http\Livewire\Maintenance\FieldOfficer;

use Livewire\Component;
use App\Traits\Common;
use App\Models\FieldOfficer as TblFieldOfficer;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FieldOfficerlist extends Component
{
    use Common;

    public $usertype;
    public $keyword = '';
    public $paginate = [];
    public $paginationPaging = [];
    public $selectedFoid = null;


    public function archive($foid)
    {
        $officer = TblFieldOfficer::where('FOID', $foid);

        if ($officer) {

            $officer->update([
                'Status' =>  2,
            ]);

            Log::info('Archived officer with FOID: ' . $foid);

            return redirect()->to('/maintenance/fieldofficer/list')->with('mmessage', 'Field officer was successfully archived!');
            
        } else {
            Log::error('Failed to archive officer. FOID: ' . $foid);
        }
    }

    public function mount()
    {
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 15;
        $this->paginate['FilterName'] = '';
        $this->paginationPaging['totalPage'] = 0;
        $this->paginationPaging['totalRecord'] = 0;
        $this->usertype = session()->get('auth_usertype');
    }

    public function setPage($page = 1)
    {
        $this->paginate['page'] = $page;
    }

    public function render()
    {
        // Query only active field officers (status ID 1)
        $query = TblFieldOfficer::whereHas('status', function ($query) {
            $query->where('id', 1);
        });

        if ($this->keyword) {
            $query->where(function ($query) {
                $query->where('fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('lname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('mname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('cno', 'like', '%' . $this->keyword . '%');
            });
        }

        $officers = $query->paginate($this->paginate['pageSize'], ['*'], 'page', $this->paginate['page']);

        $this->paginationPaging['totalPage'] = $officers->lastPage();
        $this->paginationPaging['totalRecord'] = $officers->total();
        $this->paginationPaging['currentPage'] = $officers->currentPage();
        $this->paginationPaging['nextPage'] = $officers->currentPage() < $officers->lastPage() ? $officers->currentPage() + 1 : $officers->lastPage();
        $this->paginationPaging['prevPage'] = $officers->currentPage() > 1 ? $officers->currentPage() - 1 : 1;

        return view('livewire.maintenance.field-officer.field-officerlist', ['list' => $officers]);
    }
}
