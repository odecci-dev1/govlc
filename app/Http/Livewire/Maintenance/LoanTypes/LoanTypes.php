<?php

namespace App\Http\Livewire\Maintenance\LoanTypes;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class LoanTypes extends Component
{
    public $loantype;

    public function store(){
        // "loan_amount_Lessthan": 0,
        // "loan_amount_GreaterEqual": 0,
        // "savings": 0,
        // "loanAmount_Min": 0,
        // "loanAmount_Max": 0,
        // "nameOfTerms": 0,
        // "days": 0,
        // "apfid": "string",
        // "loanTypeName": "string",
        // "loanTypeID": "string",
        // "loan_amount_Lessthan_Amount": 0,
        // "lalV_Type": 0,
        // "loan_amount_GreaterEqual_Amount": 0,
        // "lageF_Type": 0,
        // "loanInsurance": 0,
        // "loanI_Type": 0,
        // "lifeInsurance": 0,
        // "lifeI_Type": 0,
        // "interestRate": 0,
        // "iR_Type": 0
        $inputs = $this->loantype;

        $data = [
                    'loan_amount_Lessthan' =>  $inputs['loan_amount_Lessthan'],
                    'loan_amount_GreaterEqual' =>  $inputs['loan_amount_GreaterEqual'],
                    'savings' =>  $inputs['savings'],
                    'loanAmount_Min' =>  $inputs['loanAmount_Min'],
                    'loanAmount_Max' =>  $inputs['loanAmount_Max'],
                    'nameOfTerms' => 0,
                    'days' => 0,
                    'apfid' => 'string',
                    'loanTypeName' =>  $inputs['loanTypeName'],
                    'loanTypeID' =>  'string',
                    'loan_amount_Lessthan_Amount' =>  $inputs['loan_amount_Lessthan_Amount'],
                    'lalV_Type' =>  $inputs['lalV_Type'],
                    'loan_amount_GreaterEqual_Amount' =>  $inputs['loan_amount_GreaterEqual_Amount'],
                    'lageF_Type' =>  $inputs['lageF_Type'],
                    'loanInsurance' =>  $inputs['loanInsurance'],
                    'loanI_Type' =>  $inputs['loanI_Type'],
                    'lifeInsurance' =>  $inputs['lifeInsurance'],
                    'lifeI_Type' =>  $inputs['lifeI_Type'],
                    'interestRate' =>  0,
                    'iR_Type' =>  1,
                ];      
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/SaveLoanType', $data);                  
        return redirect()->to('/maintenance/loantypes/list')->with('mmessage', 'Field area successfully saved');     
    }

    public function render()
    {
        return view('livewire.maintenance.loan-types.loan-types');
    }
}
