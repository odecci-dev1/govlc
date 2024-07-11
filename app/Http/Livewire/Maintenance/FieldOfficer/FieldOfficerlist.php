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

    // public function archive($foid)
    // {
    //     // Find the field officer by FOID
    //     $officer = TblFieldOfficer::where('FOID', $foid)->first();

    //     // Check if officer exists
    //     if (!$officer) {
    //         // Handle case where officer with $foid does not exist
    //         session()->flash('error', 'Field officer not found.');
    //         return redirect()->to('/maintenance/fieldofficer/list');
    //     }

    //     // Archive the officer by changing status to inactive (assuming status ID 2 means inactive)
    //     try {
    //         // Get the Status object for inactive status
    //         $statusInactive = Status::find(2); // Assuming status ID 2 is for inactive status

    //         // Associate the officer with the inactive status
    //         $officer->status()->associate($statusInactive);
    //         $officer->save();

    //         // Log success
    //         Log::info('Field officer archived successfully: ' . $officer->FOID);

    //         // Redirect with success message
    //         return redirect()->to('/maintenance/fieldofficer/list')->with('message', 'Field officer has been archived');
    //     } catch (\Exception $e) {
    //         // Log the error
    //         Log::error('Failed to archive field officer: ' . $e->getMessage());

    //         // Flash error message
    //         session()->flash('error', 'Failed to archive field officer: ' . $e->getMessage());
    //     }

    //     // Redirect back to officer list page
    //     return redirect()->to('/maintenance/fieldofficer/list');
    // }

    public function archive($foid)
    {
        try {
            // Find the field officer by FOID
            $officer = TblFieldOfficer::where('FOID', $foid)->first();

            // Check if officer exists
            if (!$officer) {
                // Handle case where officer with $foid does not exist
                session()->flash('error', 'Field officer not found.');
                return redirect()->to('/maintenance/fieldofficer/list');
            }

            // Get the Status object for inactive status (assuming status ID 2 means inactive)
            $statusInactive = Status::find(2);

            if (!$statusInactive) {
                throw new \Exception('Inactive status not found.');
            }

            // Associate the officer with the inactive status
            $officer->status()->associate($statusInactive);
            $officer->save();
            $officer->delete();

            // Perform soft delete (optional, if you want to keep historical records)

            // Log success
            Log::info('Field officer archived successfully: ' . $officer->FOID . "  its current status: " . $officer->status->Name);

            // Redirect with success message
            return redirect()->to('/maintenance/fieldofficer/list')->with('message', 'Field officer has been archived');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to archive field officer: ' . $e->getMessage());

            // Flash error message
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
