<?php

namespace App\Http\Livewire\Transactions\Application;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ApplicationPrintingPassbook extends Component
{
    public $naID;
    public $loansummary;
    public $member;
    public function render()
    {
        $getloansummary = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanSummary/GetLoanSummary', [ 'naid' => $this->naID ]);                  
        $this->loansummary = isset($getloansummary[0]) ? $getloansummary[0] : []; 
        //dd($this->loansummary);
        $member = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/ApplicationMemberDetails', [ 'applicationID' => $this->naID ]);                         
        $member = $member->json();
        $this->member = isset($member[0]) ? $member[0] : []; 
        //dd( $this->member);
        return view('livewire.transactions.application.application-printing-passbook');
    }
}
