<?php

namespace App\Traits;


use App\Models\Application;
use App\Models\CollectionAreaMember;
use App\Models\Holiday;
use App\Models\AdvancePaymentFormula;
use Carbon\Carbon;
trait Calculator{

    public function calculateLoan($formula,$interestRate,$loanPrincipal,$terms,$oldFormula){
        if($formula == 1){ 
            $collectible = (($loanPrincipal * $interestRate) + $loanPrincipal) / $terms;
            $advancePayment = $collectible;
            $interestAmount = $loanPrincipal * $interestRate;
        }else{
            $collectible = $loanPrincipal / $terms;
            $advancePayment = $collectible;
            $interestAmount = $loanPrincipal * $interestRate;
        }
        
        $calculatedResult=[];
        $calculatedResult['collectible'] = ceil($collectible);
        $calculatedResult['advancePayment'] = $oldFormula == 1 ? ceil($advancePayment*2):ceil($advancePayment);
        $calculatedResult['interestAmount'] = ceil($interestAmount);
       
        return $calculatedResult;
    }

    public function calculateNotarialFee($NotarialFeeOrigin,$loanPrincipal,$loanAmount,$LessThanAmount,$LessThanAmountTYpe,$LessThanNotarialAmount,$GreaterThanEqualAmountTYpe,$GreaterThanEqualNotarialAmount){
         //Getting Notarial Fee
                    // Computation will fall to this condition if the notarial origin is principal
        if($NotarialFeeOrigin == 2){
            if($loanPrincipal <= $LessThanAmount){
                if($LessThanAmountTYpe == 2){
                    $notarialFee = $LessThanNotarialAmount;
                }else{
                    $notarialFee = $LessThanNotarialAmount * $loanPrincipal;
                }
            }else{
                if($GreaterThanEqualAmountTYpe == 2){
                    $notarialFee = $GreaterThanEqualNotarialAmount;
                }else{
                    $notarialFee = $GreaterThanEqualNotarialAmount * $loanPrincipal;
                }
            }
        }else{

            if($loanAmount <= $LessThanAmount){
                if($LessThanAmountTYpe == 2){
                    $notarialFee = $LessThanNotarialAmount;
                }else{
                    $notarialFee = $LessThanNotarialAmount * $loanAmount;
                }
            }else{
                if($GreaterThanEqualAmountTYpe == 2){
                    $notarialFee = $GreaterThanEqualNotarialAmount;
                }else{
                    $notarialFee = $GreaterThanEqualNotarialAmount * $loanAmount;
                }
            }
        }
        return $notarialFee;
    }


    public function calculateReceivable($loanPrincipal, $naID){

        $res = Application::where('NAID', $naID)->with('member')->with('detail')->with('loantype')->with('termsofpayment')->first(); 
        $details = $res->detail;
        $interestRate = $res->TermsOfpayment->InterestRate;
      
        $terms =  $res->TermsOfpayment->Terms;
        $loanAmount = ($loanPrincipal * $interestRate) + $loanPrincipal;
        $formulas = AdvancePaymentFormula::where('APFID',$res->TermsOfpayment->Formula)->first();
        $calculatedResult = $this->calculateLoan($formulas->Id,$interestRate,$loanPrincipal,$terms,$res->TermsOfpayment->OldFormula );
        $notarialFee = $this->calculateNotarialFee($res->TermsOfpayment->NotarialFeeOrigin,$loanPrincipal,$loanAmount,$res->TermsOfpayment->LessThanAmount,$res->TermsOfpayment->LessThanAmountTYpe,$res->TermsOfpayment->LessThanNotarialAmount,$res->TermsOfpayment->GreaterThanEqualAmountTYpe,$res->TermsOfpayment->GreaterThanEqualNotarialAmount);
        $loanInsurance = $this->calculateLoanInsurance($res->TermsOfpayment->LoanInsuranceAmountType,$res->TermsOfpayment->LoanInsuranceAmount,$loanPrincipal);
        $lifeInsurance = $this->calculateLifeInsurance($res->TermsOfpayment->LifeInsuranceAmountType,$res->TermsOfpayment->LifeInsuranceAmount,$loanPrincipal);
        $interestAmount = $this->calculatedResult['interestAmount'];
        $isDeductInterest = $res->TermsOfpayment->DeductInterest;
        $deductInterest=0;
        if($isDeductInterest == 1){
            $deductInterest = $interestAmount;
        }
        $loanStart = date_create(Carbon::now()->format('Y-m-d'));
        $loanEnd = date_create(date_format(date_add(date_create(Carbon::now()->format('Y-m-d')), date_interval_create_from_date_string($terms." Days")),'Y-m-d'));
     
        $days = $loanStart->diff($loanEnd, true)->days;
        $sundays = intval($days / 7) + ($loanStart->format('N') + $days % 7 >= 7);
        $loanEndWithSundays = date_create(date_format(date_add( $loanEnd, date_interval_create_from_date_string($sundays." Days")),'Y-m-d'));
       
        $getHolidays = Holiday::whereBetween('Date',[$loanStart,$loanEndWithSundays])->count();
        
        $holidayPayment = $getHolidays * $calculatedResult['collectible'];
        
        $deductionsAmount =  $notarialFee + $holidayPayment + $loanInsurance + $calculatedResult['advancePayment'] + $lifeInsurance +  $deductInterest ;
        $receivables = $loanPrincipal - $deductionsAmount;
;
        return $receivables;
    }

    public function getCollectionData($mmeberID,){
        $collectionData=[];
        $getMemberLoanApplications = Application::select('NAID')->where('MemId', $mmeberID)->get();
        if($getMemberLoanApplications){
            foreach($getMemberLoanApplications as $memberLoan){
                $naIDs[] = $memberLoan->NAID;
            }
        }
        
        $getMemberCollections = CollectionAreaMember::whereIn('NAID', $naIDs)->get();
        $totalSavings=0;
        $noPayments=0;
        if($getMemberCollections){
            foreach($getMemberCollections as $collection){
                $totalSavings+=$collection->Savings;
                if($collection->Payment_Method == 'No Payment'){
                    $noPayments+=1;
                }
            }
        }
        $collectionData['noPayments'] =  $noPayments;
        $collectionData['totalSavings'] = $totalSavings;
        return $collectionData;
    }

    public function calculateLoanInsurance($LoanInsuranceAmountType,$LoanInsuranceAmount,$loanPrincipal){
        if($LoanInsuranceAmountType == 1){
            $LoanInsurance = $loanPrincipal * $LoanInsuranceAmount;
        }else{
            $LoanInsurance= $LoanInsuranceAmount;
        }
        return $LoanInsurance;
    }

    public function calculateLifeInsurance($LoanInsuranceAmountType,$LoanInsuranceAmount,$loanPrincipal){
        if($LoanInsuranceAmountType == 1){
            $LoanInsurance = $loanPrincipal * $LoanInsuranceAmount;
        }else{
            $LoanInsurance= $LoanInsuranceAmount;
        }
        return $LoanInsurance;
    }

} 
?>