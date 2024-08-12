<?php

namespace App\Http\Livewire\Transactions\Application;

use Livewire\Component;
use App\Models\Application;
use App\Models\Holiday;
use App\Models\AdvancePaymentFormula;
use App\Models\LoanHistory;
use App\Traits\Calculator;
use App\Traits\Common;
use Carbon\Carbon;

use Illuminate\Support\Facades\Http;

class ApplicationPrintingPassbook extends Component
{
    public $naID;
    public $loansummary;
    public $member;
    public function render()
    {

        $res = Application::where('NAID', $this->naID)->with('member')->with('detail')->with('loantype')->with('termsofpayment')->first();
        $loanHistory = LoanHistory::where('NAID',$this->naID)->first();
    
        
    

        $this->loansummary['naid'] = $res->NAID;
        $this->loansummary['borrower'] = $res->member->Lname.', '.$res->member->Fname.' '.$res->member->Mname;
        $this->member['houseNo'] = $res->member->HouseNo;
        $this->member['barangay'] = $res->member->Barangay;
        $this->member['city'] = $res->member->City;
        $this->member['province'] = $res->member->Province;
        $this->member['cno'] = $res->member->Cno;
        $this->loansummary['co_Lname'] = $res->member->comaker->Lnam;
        $this->loansummary['co_Fname'] = $res->member->comaker->Fname;
        $this->loansummary['co_Mname'] = $res->member->comaker->Mname;
        $this->loansummary['co_Cno'] = $res->member->comaker->Mname;
        $this->member['co_HouseNo'] = $res->member->comaker->HouseNo;
        $this->member['co_Barangay'] = $res->member->comaker->Barangay;
        $this->member['co_City'] = $res->member->comaker->City;
        $this->member['co_Province'] = $res->member->comaker->Province;
        $this->loansummary['LoanTypeName'] = $res->loantype->LoanTypeName;
        $this->loansummary['Terms'] = $res->termsofpayment->Terms;
        $this->loansummary['LoanAmount'] = $res->detail->ApprovedLoanAmount + $res->detail->ApproveedInterest;
        $this->loansummary['dailyCollectibles'] = $res->detail->ApprovedDailyAmountDue;
        $this->loansummary['releasingDate'] = $res->ReleasingDate;
        $this->loansummary['dueDate'] = $loanHistory->DueDate;
        $this->loansummary['advancePayment'] = $res->detail->ApprovedAdvancePayment;
        $this->loansummary['ReleasedDate'] = date_create($res->ReleasingDate);
        // $getloansummary = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanSummary/GetLoanSummary', [ 'naid' => $this->naID ]);                  
        // $this->loansummary = isset($getloansummary[0]) ? $getloansummary[0] : []; 
        // //dd($this->loansummary);
        // $member = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/ApplicationMemberDetails', [ 'applicationID' => $this->naID ]);                         
        // $member = $member->json();
        // $this->member = isset($member[0]) ? $member[0] : []; 
        //dd($res->ReleasingDate);
        
        return view('livewire.transactions.application.application-printing-passbook');
    }
}
