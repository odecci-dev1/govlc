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
    public $collectionType = [];

    public function rules(){                
        $rules = [];   
        $rules['loantype.loanTypeName'] = ['required'];    
        $rules['terms'] = ['required'];      
        $rules['loantype.savings'] = 'required';  
        $rules['loantype.loanAmount_Min'] = [''];   
        $rules['loantype.loanAmount_Max'] = [''];         
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
                                'interestRate' => $value['interestRate'],
                                'interestType' => $value['interestType'],
                                'loanTypeID' => $this->loantypeID,   
                                'formula' => $value['formula'],  
                                'interestApplied' => $value['interestApplied'],  
                                'terms' => $value['terms'], 
                                'oldFormula' => $value['oldFormula'], 
                                'noAdvancePayment' => $value['noAdvancePayment'],  
                                'notarialFeeOrigin' => $value['notarialFeeOrigin'],  
                                'lessThanNotarialAmount' => $value['lessThanNotarialAmount'],  
                                'lessThanAmountTYpe' => $value['lessThanAmountTYpe'],  
                                'greaterThanEqualNotarialAmount' => $value['greaterThanEqualNotarialAmount'],  
                                'greaterThanEqualAmountType' => $value['noAdvancePayment'],  
                                'loanInsuranceAmount' => $value['loanInsuranceAmount'], 
                                'loanInsuranceAmountType' => $value['loanInsuranceAmountType'],       
                                'lifeInsuranceAmount' => $value['lifeInsuranceAmount'],       
                                'lifeInsuranceAmountType' => $value['lifeInsuranceAmountType'],       
                                'deductInterest' => $value['deductInterest'], 
                                'collectionTypeId' => $value['collectionTypeId'],                                          
                            ];
            }
        }
       
        $data = [
                    'loanTypeName' =>  $inputs['loantype']['loanTypeName'],
                    'loanTypeID' => $this->loantypeID,
                    'savings' =>  $inputs['loantype']['savings'],
                    'loanAmount_Min' =>  isset($inputs['loantype']['loanAmount_Min']) ? $inputs['loantype']['loanAmount_Min'] : 0,
                    'loanAmount_Max' =>  isset($inputs['loantype']['loanAmount_Max']) ? $inputs['loantype']['loanAmount_Max'] : 0,
                    'terms' => $terms
                ];
                //dd($data);
        $savemsg = '';
        if($this->loantypeID == ''){
            $savemsg = 'Loan type successfully saved';
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/SaveLoanType', $data);            
            // dd($crt);
            $getLasLoanId = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/GetlastLoanTypeDetails');  
            $getLasLoanId =  $getLasLoanId->json();
            $this->loantypeID = $getLasLoanId['loanTypeID'];
        }   
        else{
            $savemsg = 'Loan type successfully updated';
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/UpdateLoanType', $data);
          
        }               
        return redirect()->to('/maintenance/loantypes/view/' . $this->loantypeID)->with('mmessage', $savemsg);     
    }
    
    public function addTerms(){
        $lastcnt = array_key_last($this->terms);   
        $data = $this->validate([                                    
                                    'inpterms.nameOfTerms' => ['required'],
                                    'inpterms.interestRate' => ['required', 'numeric', 'min:1'],
                                    'inpterms.interestType' => ['required'],  
                                    'inpterms.formula' => ['required'],
                                    'inpterms.interestApplied' => ['required'],                                                                
                                    'inpterms.terms' => ['required'],  
                                    'inpterms.oldFormula' => ['required'],    
                                    'inpterms.noAdvancePayment' => ['required'],    
                                    'inpterms.notarialFeeOrigin' => ['required'],    
                                    'inpterms.lessThanNotarialAmount' => ['required'],    
                                    'inpterms.lessThanAmountTYpe' => ['required'], 
                                    'inpterms.greaterThanEqualNotarialAmount' => ['required'],  
                                    'inpterms.greaterThanEqualAmountType' => ['required'],  
                                    'inpterms.loanInsuranceAmount' => ['required'],  
                                    'inpterms.loanInsuranceAmountType' => ['required'],  
                                    'inpterms.lifeInsuranceAmount' => ['required'],  
                                    'inpterms.lifeInsuranceAmountType' => ['required'],
                                    'inpterms.deductInterest' => ['required'],      
                                    'inpterms.collectionTypeId' => ['required'],                                            
                                ]);

        $this->terms[$lastcnt + 1] = [  'nameOfTerms' => $data['inpterms']['nameOfTerms'],
                                        'interestRate' => $data['inpterms']['interestRate'],
                                        'interestType' => $data['inpterms']['interestType'],                                         
                                        'formula' => $data['inpterms']['formula'], 
                                        'interestApplied' => $data['inpterms']['interestApplied'],   
                                        'terms' => $data['inpterms']['terms'], 
                                        'oldFormula' => $data['inpterms']['oldFormula'], 
                                        'noAdvancePayment' => $data['inpterms']['noAdvancePayment'], 
                                        'notarialFeeOrigin' => $data['inpterms']['notarialFeeOrigin'], 
                                        'lessThanNotarialAmount' => $data['inpterms']['lessThanNotarialAmount'], 
                                        'lessThanAmountTYpe' => $data['inpterms']['lessThanAmountTYpe'], 
                                        'greaterThanEqualNotarialAmount' => $data['inpterms']['greaterThanEqualNotarialAmount'], 
                                        'greaterThanEqualAmountType' => $data['inpterms']['greaterThanEqualAmountType'], 
                                        'loanInsuranceAmount' => $data['inpterms']['loanInsuranceAmount'],   
                                        'loanInsuranceAmountType' => $data['inpterms']['loanInsuranceAmountType'],   
                                        'lifeInsuranceAmount' => $data['inpterms']['lifeInsuranceAmount'], 
                                        'lifeInsuranceAmountType' => $data['inpterms']['lifeInsuranceAmountType'], 
                                        'deductInterest' => $data['inpterms']['deductInterest'], 
                                        'collectionTypeId' => $data['inpterms']['collectionTypeId'],                         
                                     ];

        $this->resetterms();                        
    }

    public function resetterms(){                                                             
        $this->inpterms['nameOfTerms'] = null;
        $this->inpterms['interestRate'] = null;
        $this->inpterms['interestType'] = null;
        $this->inpterms['formula'] = null;
        $this->inpterms['interestApplied'] = null;  
        $this->inpterms['terms'] = null;
        $this->inpterms['oldFormula'] = null;
        $this->inpterms['noAdvancePayment'] = null;
        $this->inpterms['notarialFeeOrigin'] = null;
        $this->inpterms['lessThanNotarialAmount'] = null;    
        $this->inpterms['lessThanAmountTYpe'] = null;
        $this->inpterms['greaterThanEqualNotarialAmount'] = null;
        $this->inpterms['greaterThanEqualAmountType'] = null;
        $this->inpterms['loanInsuranceAmount'] = null;
        $this->inpterms['loanInsuranceAmountType'] = null;
        $this->inpterms['lifeInsuranceAmount'] = null;
        $this->inpterms['lifeInsuranceAmountType'] = null;
        $this->inpterms['deductInterest'] = null;
        $this->inpterms['collectionTypeId'] = null;
    }


    public function mount($loanid = ''){
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
                                            'interestRate' => $termsofPayment['interestRate'],
                                            'interestType' => $termsofPayment['iR_Type'],                                         
                                            'loanTypeID' => $this->loantypeID,
                                            'formula' => $termsofPayment['formulaID'],
                                            'interestApplied' => $termsofPayment['interestApplied'],
                                            'terms' => $termsofPayment['terms'],
                                            'oldFormula' => $termsofPayment['oldFormula'],
                                            'noAdvancePayment' => $termsofPayment['noAdvancePayment'],
                                            'notarialFeeOrigin' => $termsofPayment['notarialFeeOrigin'],
                                            'lessThanNotarialAmount' => $termsofPayment['lessThanNotarialAmount'],
                                            'lessThanAmountTYpe' => $termsofPayment['lalV_TypeID'],
                                            'greaterThanEqualNotarialAmount' => $termsofPayment['greaterThanEqualNotarialAmount'],
                                            'greaterThanEqualAmountType' => $termsofPayment['lageF_TypeID'],
                                            'loanInsuranceAmount' => $termsofPayment['loanInsuranceAmount'],
                                            'loanInsuranceAmountType' => $termsofPayment['loanI_TypeID'],
                                            'lifeInsuranceAmount' => $termsofPayment['lifeInsuranceAmount'],
                                            'lifeInsuranceAmountType' => $termsofPayment['lifeI_TypeID'],
                                            'deductInterest' => $termsofPayment['deductInterest'],
                                            'collectionTypeId' => $termsofPayment['typeOfCollectionID'],
                                         ];
                }
            }
        }

        $collType = $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/GetCollectionType');
        $collType = $collType->json();
        if($collType){
            foreach($collType as $mcollType){
                $this->collectionType[$mcollType['id']] = ['id' => $mcollType['id'], 'typeOfCollection' => $mcollType['typeOfCollection']];
            }
        }

        $formulaList = $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/GetLoanFormula');
        $formulaList = $formulaList->json();
        if($formulaList){
            foreach($formulaList as $mformulaList){
                $this->formulaList[$mformulaList['formulaID']] = ['formulaID' => $mformulaList['formulaID'], 'formula' => $mformulaList['formula']];
            }
        }
        // $this->inpterms['interestType'] = 1;
    }

    public function render()
    {
        return view('livewire.maintenance.loan-types.loan-types');
    }
}
