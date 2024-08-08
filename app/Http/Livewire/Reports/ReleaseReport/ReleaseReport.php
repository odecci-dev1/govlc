<?php

namespace App\Http\Livewire\Reports\ReleaseReport;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReleaseExport;

class ReleaseReport extends Component
{
    public $datestart;
    public $dateend;
    public $data;

    public function mount(){
        $this->dateend = date('Y-m-d');      
        $this->datestart = date('Y-m-d', strtotime("-3 months"));
        // $this->datestart = date('Y-m-d', strtotime("-6 days"));
    }

    public function render()
    {      
        $input = [
                    'page' => 1,
                    'pageSize' => 1000,
                    'datefrom' => $this->datestart,
                    'dateto' => $this->dateend,
                 ];
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Reports/Reports_ReleasingList', $input);  
        $data = $this->data = $data->json();     
        // dd($data);
        return view('livewire.reports.release-report.release-report');
    }

    public function exportReleaseReport(){
        return Excel::download(new ReleaseExport( $this->data ), 'Release_Report_'. $this->datestart . '_' . $this->dateend .'.xlsx');
    }

    public function print(){
        $printhtml = view('livewire.reports.release-report.release-report-print', [ 'data' => $this->data, 'datestart' => $this->datestart, 'dateend' => $this->dateend ])->render();    
        $this->emit('printReport', ['data' => $printhtml]);
    }
}
