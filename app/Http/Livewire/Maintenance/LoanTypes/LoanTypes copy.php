<?php

namespace App\Http\Livewire\Maintenance\LoanTypes;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class LoanTypes extends Component
{
    public $loantype;

    public $terms = [];
    public $inpterms;
    public $formulaList = [];

    public function messages(){
        $messages = [];
        $messages['inpterms.nameOfTerms.required'] = 'Name of terms is required.';        
        $messages['inpterms.days.required'] = 'No. of days is required.';  
        $messages['inpterms.days.numeric'] = 'No. of days is should be a number.';  
        $messages['inpterms.days.min'] = 'No. of days is should be greater than 0.';                      
        $messages['inpterms.interestRate.required'] = 'Interest rate is required.';  
        $messages['inpterms.interestType.required'] = 'Interest type is required.';    
        $messages['inpterms.formula.required'] = 'Select formula from the list.';                     
        return $messages;        
    }

    public function store(){   
        $inputs = $this->loantype;

        $terms = [];
        if(count( $this->terms) > 0){
            foreach($this->terms as $key => $value){
                $terms[] =  [   'nameOfTerms' => $value['nameOfTerms'], 
                                'days' => $value['days'],
                                'interestRate' => $value['interestRate'],
                                'loanTypeID' => $value['loanTypeID'],   
                                'formula' => 'string',                                        
                            ];
            }
        }


        $data = [
                        'loan_amount_Lessthan' =>  $inputs['loan_amount_Lessthan'],
                        'loan_amount_GreaterEqual' =>  $inputs['loan_amount_GreaterEqual'],
                        'savings' =>  $inputs['savings'],
                        'loanAmount_Min' =>  $inputs['loanAmount_Min'],
                        'loanAmount_Max' =>  $inputs['loanAmount_Max'],
                        'loanTypeName' =>  '234s23423',
                        'loanTypeID' =>  'stringss',
                        'loan_amount_Lessthan_Amount' =>  $inputs['loan_amount_Lessthan_Amount'],
                        'lalV_Type' =>  $inputs['lalV_Type'],
                        'loan_amount_GreaterEqual_Amount' =>  $inputs['loan_amount_GreaterEqual_Amount'],
                        'lageF_Type' =>  $inputs['lageF_Type'],
                        'loanInsurance' =>  $inputs['loanInsurance'],
                        'loanI_Type' =>  $inputs['loanI_Type'],
                        'lifeInsurance' =>  $inputs['lifeInsurance'],
                        'lifeI_Type' =>  $inputs['lifeI_Type'],
                        "terms"=> [
                            "nameOfTerms"=> "stringssss",
                            "days"=> 0,
                            "interestRate"=> 0,
                            "loanTypeID"=> "stringsss",
                            "formula"=> "string"
                        ]
                ];

        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/SaveLoanType', $data);   
        dd( $crt );             
        return redirect()->to('/maintenance/loantypes/list')->with('mmessage', 'Field area successfully saved');     
    }

    public function addTerms(){
        $lastcnt = array_key_last($this->terms);    
        $data = $this->validate([                                    
                                    'inpterms.nameOfTerms' => ['required'],
                                    'inpterms.days' => ['required', 'numeric', 'min:1'],
                                    'inpterms.interestRate' => ['required'],  
                                    'inpterms.interestType' => ['required'],                                                      
                                    'inpterms.formula' => ['required'],                                   
                                ]);

        $this->terms[$lastcnt + 1] = [  'nameOfTerms' => $data['inpterms']['nameOfTerms'],
                                        'days' => $data['inpterms']['days'],
                                        'interestRate' => $data['inpterms']['interestRate'],                                         
                                        'loanTypeID' => 'string',
                                        'formula' => isset($this->formulaList[$data['inpterms']['formula']]) ? $this->formulaList[$data['inpterms']['formula']] : ''                                       
                                     ];

        $this->resetterms();                        
    }

    public function resetterms(){
        $this->inpterms['nameOfTerms'] = '';
        $this->inpterms['days'] = '';
        $this->inpterms['interestRate'] = '';
        $this->inpterms['formula'] = '';       
    }


    public function mount(){
        $this->formulaList[1] = '(Loan Amount + Interest) / Days';
        $this->formulaList[2] = '((Loan Amount + Interest) / Days) x 2';
        $this->inpterms['interestType'] = 1;
    }

    public function render()
    {
        return view('livewire.maintenance.loan-types.loan-types');
    }
}
