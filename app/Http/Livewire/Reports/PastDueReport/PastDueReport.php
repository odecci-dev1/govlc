<?php

namespace App\Http\Livewire\Reports\PastDueReport;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PastDueExport;

class PastDueReport extends Component
{

    public $datestart;
    public $dateend;
    public $member;
    public $data;
    public $memberlist;
    public $newappmodelkeyword = '';

    public function mount(){
        $this->dateend = date('Y-m-d');      
        $this->datestart = date('Y-m-d', strtotime("-3 months"));
        // $this->datestart = date('Y-m-d', strtotime("-6 days"));
    }

    public function searchMembers(){
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/MembershipFilterByFullname', ['fullname' => $this->newappmodelkeyword]);         
        $this->memberlist = $data->json();        
    }

    public function setMember($fullname = ''){
        $this->member = $fullname;
    }

    public function exportReleaseReport(){
        return Excel::download(new PastDueExport( $this->data ), 'Past_Due_Report_'. $this->datestart . '_' . $this->dateend .'.xlsx');
    }

    public function print(){      
        $printhtml = view('livewire.reports.past-due-report.past-due-report-print', [ 'data' => $this->data, 'datestart' => $this->datestart, 'dateend' => $this->dateend, 'member' => $this->member ])->render();    
        $this->emit('printReport', ['data' => $printhtml]);
    }

    public function render()
    {

    $input = [
                    'page' => 1,
                    'pageSize' => 1000,
                    'borrower' => $this->member,                 
                 ];
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Reports/Reports_PastDueList', $input);  
        $this->data = collect($data->json());              
        // $this->data->put(1, ['Borrower' => 'Borrower, Borrower, Borrower','LoanAmount' => 50000,'DateReleased' => '2023-12-26','DueDate' => '2023-12-27','TotalNP' => 10, 'TotalPastDueDay' => 9, 'TotalCollection' => 10000]);              
        return view('livewire.reports.past-due-report.past-due-report');
    }
}
