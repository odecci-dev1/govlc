<?php

namespace App\Http\Livewire\Transactions\Application;
use Illuminate\Support\Facades\Http;

use Livewire\Component;

class ApplicationPrintingVoucher extends Component
{
    public $naID;
    public $loansummary;
    public function render()
    {
        $getloansummary = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanSummary/GetLoanSummary', [ 'naid' => $this->naID ]);                  
        $this->loansummary = isset($getloansummary[0]) ? $getloansummary[0] : [];     
        dd($this->loansummary);
        return view('livewire.transactions.application.application-printing-voucher');
    }
}
