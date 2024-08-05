<?php

namespace App\Http\Livewire\Reports\SavingsReport;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SavingsExport;
use App\Models\Members;

class SavingsReport extends Component
{
    public $datestart;
    public $dateend;
    public $member;
    public $data;
    public $memberlist;
    public $newappmodelkeyword = '';

    public function mount()
    {
        $this->dateend = date('Y-m-d');      
        $this->datestart = date('Y-m-d', strtotime("-3 months"));
        $this->searchMembers();
    }

    public function searchMembers()
    {
        $this->memberlist = Members::where('Fname', 'like', '%' . $this->newappmodelkeyword . '%')
            ->orWhere('Lname', 'like', '%' . $this->newappmodelkeyword . '%')
            ->selectRaw("CONCAT(Lname, ', ', Fname, ' ', ISNULL(Suffix, ''), ' ', LEFT(Mname, 1), '.') as fullname, MemId")
            ->get();
    }

    public function setMember($memId  = null)
    {
        $this->member = $memId ;
    }

    
    public function exportReleaseReport()
    {
        return Excel::download(new SavingsExport( $this->data ), 'Savings_Report_'. $this->datestart . '_' . $this->dateend .'.xlsx');
    }

    public function print()
    {
        $printhtml = view('livewire.reports.savings-report.savings-report-print', [
            'data' => $this->data,
            'datestart' => $this->datestart,
            'dateend' => $this->dateend,
            'member' => $this->member
        ])->render();

        $this->emit('printReport', ['data' => $printhtml]);
    }

    public function render()
    {
        $members  = Members::with('memberSavings')
            ->whereHas('memberSavings', function ($query) {
                $query->whereBetween('DateUpdated', [$this->datestart, $this->dateend]);
            })
            ->when($this->member, function ($query) {
                $query->where('MemId', $this->member);  
            })
            ->get();

        // $totalSavings = $members->flatMap(function ($member) {
        // //    return $member->memberSavings->TotalSavingsAmount;
        //    dd($member->memberSavings->TotalSavingsAmount);
        // }); 
        $totalSavings = $members->flatMap(function ($member) {
            // Return the collection of member savings
            // dd($member->memberSavings);
            return $member->memberSavings;
        })->sum('TotalSavingsAmount'); 

        $this->data = $members;
        
        return view('livewire.reports.savings-report.savings-report', [
            'totalSavings' => $totalSavings,
        ]);
    }
}
