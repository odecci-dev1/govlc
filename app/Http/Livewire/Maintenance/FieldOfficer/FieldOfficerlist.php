<?php

namespace App\Http\Livewire\Maintenance\FieldOfficer;

use Livewire\Component;
use App\Traits\Common;
use App\Models\FieldOfficer as TblFieldOfficer;

class FieldOfficerlist extends Component
{
    use Common;

    public $usertype;
    public $keyword = '';
    public $paginate = [];
    public $paginationPaging = [];

    // public function archive($id)
    // {
    //     $officer = TblFieldOfficer::find($id);
    //     dd($officer);
    //     if ($officer) {
    //         $officer->delete();fie
    //     }
    //     return redirect()->to('/maintenance/fieldofficer/list')->with(['mmessage' => 'Field officer has been archived', 'mword' => 'Success']);
    // }
    

    public function archive($id)
    {
        // Find officer by FOID (assuming $id is FOID)
        $officer = TblFieldOfficer::find($id);
        // Check if officer exists
        if (!$officer) {
            // Handle case where officer with $id does not exist
            session()->flash('error', 'Field officer not found.');
            return redirect()->to('/maintenance/fieldofficer/list');
        }

        // Delete the officer
        try {
            $officer->delete();
            session()->flash('success', 'Field officer has been archived successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to archive field officer: ' . $e->getMessage());
        }

        // Redirect back to officer list page
        return redirect()->to('/maintenance/fieldofficer/list');
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
        $query = TblFieldOfficer::query();

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
