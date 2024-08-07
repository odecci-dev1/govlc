<?php

namespace App\Traits;

trait Calculator{

    public function calculateLoan($formula,$interestRate,$loanPrincipal,$terms,$oldFormula){
        if($formula == 1){ 
            $collectible = (($loanPrincipal * $interestRate) + $loanPrincipal) / $terms;
            if($oldFormula == 1){
              $collectible = (($loanPrincipal * $interestRate) + $loanPrincipal) / $terms;
            }
            $advancePayment = $collectible;
            $interestAmount = $loanPrincipal * $interestRate;
        }else{
            $collectible = $loanPrincipal / $terms;
            $advancePayment = $collectible;
            $interestAmount = $loanPrincipal * $interestRate;
        }
        $calculatedResult=[];
        $calculatedResult['collectible'] = $collectible;
        $calculatedResult['advancePayment'] = $advancePayment;
        $calculatedResult['interestAmount'] = $interestAmount;
       
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


    public function calculateReceivable($loanAmount,$notarialfee,$advancepayment,$insurance){
        
    }

} 
?>