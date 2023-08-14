<?php

namespace App\Http\Livewire\Maintenance\LoanTypes;

use Livewire\Component;

class LoanTypes extends Component
{

    public function store(){
        // "loan_amount_Lessthan_Val": 0,
        // "loan_amount_Lessthan_Per": 0,
        // "loan_amount_GreaterEqual_Val": 0,
        // "loan_amount_GreaterEqual_Fixed": 0,
        // "savings": 0,
        // "loanInsurance": 0,
        // "lifeInsurance": 0,
        // "loanAmount_Min": 0,
        // "loanAmount_Max": 0,
        // "nameOfTerms": "string",
        // "days": 0,
        // "interestRate": 0,
        // "apfid": "string",
        // "loanTypeName": "string",
        // "loanTypeID": "string"      
    }

    public function render()
    {
        return view('livewire.maintenance.loan-types.loan-types');
    }
}
