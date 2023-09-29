<?php

namespace App\Http\Livewire\Maintenance\LoanTypes;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;

class LoanTypes extends Component
{

    use Common;
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
        $rules['loantype.loanAmount_Min'] = [''];   
        $rules['loantype.loanAmount_Max'] = [''];   
        $rules['loantype.loanTypeName'] = ['required'];   
        $rules['loantype.loan_amount_Lessthan_Amount'] = ['required'];   
        $rules['loantype.lalV_Type'] = ['required'];   
        $rules['loantype.loan_amount_GreaterEqual_Amount'] = ['required'];   
        $rules['loantype.lageF_Type'] = ['required'];   
        $rules['loantype.loanInsurance'] = ['required'];   
        $rules['loantype.loanI_Type'] = ['required'];   
        $rules['loantype.lifeInsurance'] = ['required'];   
        $rules['loantype.lifeI_Type'] = ['required'];   
        $rules['terms'] = ['required'];      
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
        $messages['terms.required'] = 'Please add terms of payment';  

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
                        'loanAmount_Min' =>  isset($inputs['loantype']['loanAmount_Min']) ? $inputs['loantype']['loanAmount_Min'] : 0,
                        'loanAmount_Max' =>  isset($inputs['loantype']['loanAmount_Max']) ? $inputs['loantype']['loanAmount_Max'] : 0,
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
               
        $savemsg = '';
        if($this->loantypeID == ''){
            $savemsg = 'Loan type successfully saved';
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/SaveLoanType', $data);  
            dd( $data );
            $getLasLoanId = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/GetlastLoanTypeDetails');  
            $getLasLoanId =  $getLasLoanId->json();
            $this->loantypeID = $getLasLoanId['loanTypeID'];
        }   
        else{
            $savemsg = 'Loan type successfully updated';
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/UpdateLoanType', $data);
            // dd($data);
        }               
        return redirect()->to('/maintenance/loantypes/view/' . $this->loantypeID)->with('mmessage', $savemsg);     
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


    public function mount($loanid = ''){
        $this->formulaList[1] = '(Loan Amount + Interest) / Days';
        $this->formulaList[2] = '((Loan Amount + Interest) / Days) x 2';
        if($loanid != ''){
            $this->loantypeID = $loanid;
            $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/LoanTypeFilter', ['loanTypeID' => $this->loantypeID]);            
            $data = $data->json();
            $data = $data[0];
            // dd($data);

            $this->loantype['loan_amount_Lessthan'] = $data['loan_amount_Lessthan'];
            $this->loantype['loan_amount_GreaterEqual'] = $data['loan_amount_GreaterEqual'];
            $this->loantype['savings'] = $data['savings'];
            $this->loantype['loanAmount_Min'] = $data['loanAmount_Min'];
            $this->loantype['loanAmount_Max'] = $data['loanAmount_Max'];
            $this->loantype['loanTypeName'] = $data['loanTypeName'];

            $this->loantype['loan_amount_Lessthan_Amount'] = $data['loan_amount_Lessthan_Amount'];
            $this->loantype['lalV_Type'] = $data['laL_Id'];
            $this->loantype['loan_amount_GreaterEqual_Amount'] = $data['loan_amount_GreaterEqual_Amount'];
            $this->loantype['lageF_Type'] = $data['laG_Id'];

            $this->loantype['loanInsurance'] = $data['loanInsurance'];
            $this->loantype['loanI_Type'] = $data['loanI_Id'];
            $this->loantype['lifeInsurance'] = $data['lifeInsurance'];
            $this->loantype['lifeI_Type'] = $data['lifeI_Id'];

            $termsofPayment = $data['termsofPayment'];
            $cnt = 0;
            if( $termsofPayment ){
                foreach($termsofPayment as $termsofPayment){
                    $cnt = $cnt + 1;
                    $this->terms[$cnt] = [  'nameOfTerms' => $termsofPayment['nameOfTerms'],
                                            'days' => $termsofPayment['days'],
                                            'interestRate' => $termsofPayment['interestRate'],                                         
                                            'loanTypeID' => $termsofPayment['loanTypeId'],
                                            'formula' => $termsofPayment['formula']                                  
                                         ];
                }
            }
        }
        // $this->inpterms['interestType'] = 1;
    }

    public function render()
    {
        return view('livewire.maintenance.loan-types.loan-types');
    }
}
