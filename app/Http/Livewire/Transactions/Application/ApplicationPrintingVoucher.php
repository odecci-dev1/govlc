<?php

namespace App\Http\Livewire\Transactions\Application;
use Illuminate\Support\Facades\Http;

use Livewire\Component;
use App\Models\Application;
use App\Models\Holiday;

use App\Models\AdvancePaymentFormula;
use App\Models\LoanHistory;
use App\Traits\Calculator;
use App\Traits\Common;
use Carbon\Carbon;

class ApplicationPrintingVoucher extends Component
{

    use Calculator,Common;
    public $naID;
    public $loansummary=[];
    public $fname;
    public function render()
    {
        $res = Application::where('NAID', $this->naID)->with('member')->with('detail')->with('loantype')->with('termsofpayment')->first(); 
        $formulas = AdvancePaymentFormula::where('APFID',$res->TermsOfpayment->Formula)->first();
        $loanHistory = LoanHistory::where('NAID',$this->naID)->first();
      

      

        $this->loansummary['interestRate'] = $res->TermsOfpayment->InterestRate;
        $this->loansummary['loanPrincipal'] = in_array($res->Status, [7,8,9]) ? ($res->details->LoanAmount ??= 0) : $res->detail->ApprovedLoanAmount;
        $this->loansummary['terms'] =  $res->TermsOfpayment->Terms;
        $this->loansummary['loanAmount'] = ( $this->loansummary['loanPrincipal'] * $this->loansummary['interestRate']) + $this->loansummary['loanPrincipal'];
        $this->loansummary['memberId'] = $res->member->id;

        $calculatedResult = $this->calculateLoan($formulas->Id,$this->loansummary['interestRate'],$this->loansummary['loanPrincipal'],$this->loansummary['terms'],$res->TermsOfpayment->OldFormula );
        $this->loansummary['notarialFee'] = $this->calculateNotarialFee($res->TermsOfpayment->NotarialFeeOrigin,$this->loansummary['loanPrincipal'],$this->loansummary['loanAmount'],$res->TermsOfpayment->LessThanAmount,$res->TermsOfpayment->LessThanAmountTYpe,$res->TermsOfpayment->LessThanNotarialAmount,$res->TermsOfpayment->GreaterThanEqualAmountTYpe,$res->TermsOfpayment->GreaterThanEqualNotarialAmount);
        $this->loansummary['loanInsurance'] = $this->calculateLoanInsurance($res->TermsOfpayment->LoanInsuranceAmountType,$res->TermsOfpayment->LoanInsuranceAmount,$this->loansummary['loanPrincipal']);
        $this->loansummary['lifeInsurance'] = $this->calculateLifeInsurance($res->TermsOfpayment->LifeInsuranceAmountType,$res->TermsOfpayment->LifeInsuranceAmount,$this->loansummary['loanPrincipal']);
        $this->loansummary['interestAmount'] = $calculatedResult['interestAmount'];
        $this->loansummary['advancePayment'] = $calculatedResult['advancePayment'];
        $this->loansummary['deductInterest'] = $res->TermsOfpayment->DeductInterest;

        $loanStart = date_create(Carbon::now()->format('Y-m-d'));
        $loanEnd = date_create(date_format(date_add(date_create(Carbon::now()->format('Y-m-d')), date_interval_create_from_date_string($this->loansummary['terms']." Days")),'Y-m-d'));
     
        $days = $loanStart->diff($loanEnd, true)->days;
        $sundays = intval($days / 7) + ($loanStart->format('N') + $days % 7 >= 7);
        $loanEndWithSundays = date_create(date_format(date_add( $loanEnd, date_interval_create_from_date_string($sundays." Days")),'Y-m-d'));
       
        $getHolidays = Holiday::whereBetween('Date',[$loanStart,$loanEndWithSundays])->where('status',1)->count();
        $loanEndWithHolidays = date_format(date_add( $loanEndWithSundays, date_interval_create_from_date_string($getHolidays." Days")),'Y-m-d');
        $this->loansummary['dueDate'] = $loanEndWithHolidays;
        $this->loansummary['releasingDate'] = $res->ReleasingDate;

        $this->loansummary['holidayPayment'] = $getHolidays * $calculatedResult['collectible'];
        $this->loansummary['deductions'] = $this->loansummary['notarialFee'] + $this->loansummary['holidayPayment'] + $this->loansummary['loanInsurance'] + $calculatedResult['advancePayment'] + $this->loansummary['lifeInsurance'] +  ($this->loansummary['deductInterest'] == 1 ? $this->loansummary['interestAmount']:0) + $loanHistory->UsedSavings;
        
        $this->loansummary['loanReceivables'] = $this->loansummary['loanPrincipal'] - $this->loansummary['deductions'];
        $this->loansummary['usedSavings'] = $loanHistory->UsedSavings;
        $this->loansummary['fname'] = $res->member->Fname;
        $this->loansummary['lname'] = $res->member->Lname;
        $this->loansummary['mname'] = $res->member->Mname;
        $this->loansummary['co_Cno'] = $res->member->comaker->Cno;
        $this->loansummary['cno'] = $res->member->Cno;
        $this->loansummary['cno'] = $res->member->Cno;
        $this->loansummary['createdBy'] = $this->getUserName($res->CreatedBy);
        $this->loansummary['releasedBy'] = $this->getUserName($res->ReleasedBy);
        $this->loansummary['modeOfRelease'] = $res->detail->ModeOfRelease;
        $this->loansummary['modeOfReleaseReference'] = $res->detail->ModeOfReleaseReference;


        return view('livewire.transactions.application.application-printing-voucher');
    }
}
