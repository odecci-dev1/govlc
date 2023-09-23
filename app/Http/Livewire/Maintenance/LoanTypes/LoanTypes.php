<?php

namespace App\Http\Livewire\Maintenance\LoanTypes;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class LoanTypes extends Component
{

    public $loantypeID = '';
    public $loantype;

    public $terms = [];
    public $inpterms;
    public $formulaList = [];

    public function rules(){                
        $rules = [];     
        $rules['loantype.loan_amount_Lessthan'] = 'required';  
        $rules['loantype.loan_amount_GreaterEqual'] = 'required';  
        $rules['loantype.savings'] = 'required';  
        $rules['loantype.loanAmount_Min'] = ['required'];   
        $rules['loantype.loanAmount_Max'] = ['required'];   
        $rules['loantype.loanTypeName'] = ['required'];   
        $rules['loantype.loan_amount_Lessthan_Amount'] = ['required'];   
        $rules['loantype.lalV_Type'] = ['required'];   
        $rules['loantype.loan_amount_GreaterEqual_Amount'] = ['required'];   
        $rules['loantype.lageF_Type'] = ['required'];   
        $rules['loantype.loanInsurance'] = ['required'];   
        $rules['loantype.loanI_Type'] = ['required'];   
        $rules['loantype.lifeInsurance'] = ['required'];   
        $rules['loantype.lifeI_Type'] = ['required'];   
        $rules['inpterms'] = ['required'];      
        return $rules;
    }


    public function messages(){
        $messages = [];
        $messages['loantype.loan_amount_Lessthan.required'] = 'Please enter amount';  
        $messages['loantype.loan_amount_GreaterEqual.required'] = 'Please enter amount';  
        $messages['loantype.savings.required'] = 'Please enter amount';  
        $messages['loantype.loanAmount_Min.required'] = 'Please enter amount';  
        $messages['loantype.loanAmount_Max.required'] = 'Please enter amount';  
        $messages['loantype.loanTypeName.required'] = 'Please enter loan type name';  
        $messages['loantype.loan_amount_Lessthan_Amount.required'] = 'Please enter amount';  
        $messages['loantype.lalV_Type.required'] = 'Please enter amount';  
        $messages['loantype.loan_amount_GreaterEqual_Amount.required'] = 'Please enter amount';    
        $messages['loantype.lageF_Type.required'] = 'Please enter amount';   
        $messages['loantype.loanInsurance.required'] = 'Please enter amount';   
        $messages['loantype.loanI_Type.required'] = 'Please enter amount';    
        $messages['loantype.lifeInsurance.required'] = 'Please enter amount';  
        $messages['loantype.lifeI_Type.required'] = 'Please enter amount';  
        $messages['inpterms.gt'] = 'Please add terms of payment';  

        $messages['inpterms.nameOfTerms.required'] = 'Name of terms is required.';        
        $messages['inpterms.days.required'] = 'No. of days is required.';  
        $messages['inpterms.days.numeric'] = 'No. of days is should be a number.';  
        $messages['inpterms.days.min'] = 'No. of days is should be greater than 0.';                      
        $messages['inpterms.interestRate.required'] = 'Interest rate is required.';  
        $messages['inpterms.interestType.required'] = 'Interest type is required.';    
        $messages['inpterms.formula.required'] = 'Select formula from the list.';                     
        return $messages;        
    }

    public function save(){   
        $inputs = $this->validate();
        dd($inputs);
        $terms = [];
        if(count( $this->terms) > 0){
            foreach($this->terms as $key => $value){
                $terms[] =  [   'nameOfTerms' => $value['nameOfTerms'], 
                                'days' => $value['days'],
                                'interestRate' => $value['interestRate'],
                                'loanTypeID' => $this->loantypeID,   
                                'formula' => $value['formula'],                                        
                            ];
            }
        }
       
        $data = [
                        'loan_amount_Lessthan' =>  $inputs['loantype']['loan_amount_Lessthan'],
                        'loan_amount_GreaterEqual' =>  $inputs['loantype']['loan_amount_GreaterEqual'],
                        'savings' =>  $inputs['loantype']['savings'],
                        'loanAmount_Min' =>  $inputs['loantype']['loanAmount_Min'],
                        'loanAmount_Max' =>  $inputs['loantype']['loanAmount_Max'],
                        'loanTypeName' =>  $inputs['loantype']['loanTypeName'],
                        'loanTypeID' =>  $this->loantypeID,
                        'loan_amount_Lessthan_Amount' =>  $inputs['loantype']['loan_amount_Lessthan_Amount'],
                        'lalV_Type' =>  $inputs['loantype']['lalV_Type'],
                        'loan_amount_GreaterEqual_Amount' =>  $inputs['loantype']['loan_amount_GreaterEqual_Amount'],
                        'lageF_Type' =>  $inputs['loantype']['lageF_Type'],
                        'loanInsurance' =>  $inputs['loantype']['loanInsurance'],
                        'loanI_Type' =>  $inputs['loantype']['loanI_Type'],
                        'lifeInsurance' =>  $inputs['loantype']['lifeInsurance'],
                        'lifeI_Type' =>  $inputs['loantype']['lifeI_Type'],
                        "terms"=> $terms
                ];

        if($this->loantypeID == ''){
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/SaveLoanType', $data);  
        }   
        else{
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/UpdateLoanType', $data);
        }       
        return redirect()->to('/maintenance/loantypes/list')->with('mmessage', ($this->loantypeID == '' ? 'Loan type successfully saved' : 'Loan type successfully updated'));     
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
        $this->inpterms['interestType'] = '';
        $this->inpterms['interestRate'] = '';
        $this->inpterms['formula'] = '';       
    }


    public function mount(){
        $this->formulaList[1] = '(Loan Amount + Interest) / Days';
        $this->formulaList[2] = '((Loan Amount + Interest) / Days) x 2';
        // $this->inpterms['interestType'] = 1;
    }

    public function render()
    {
        return view('livewire.maintenance.loan-types.loan-types');
    }
}
