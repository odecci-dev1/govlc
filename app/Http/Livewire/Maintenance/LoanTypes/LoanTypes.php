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
        $rules['loantype.savings'] = '';  
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
        $messages['inpterms.terms.required'] = 'Terms is required.';  
        $messages['inpterms.terms.numeric'] = 'Terms should be a number.';                      
        $messages['inpterms.interestRate.required'] = 'Interest rate is required.';  
        $messages['inpterms.interestRate.numeric'] = 'Interest rate should be a number.';  
        $messages['inpterms.interestType.required'] = 'Interest type is required.';    
        $messages['inpterms.formula.required'] = 'Select formula from the list.';    
        $messages['inpterms.collectionTypeId.required'] = 'Select collection type';   
        $messages['inpterms.interestApplied.required'] = 'Interest applied is required.';    
        $messages['inpterms.noAdvancePayment.required'] = 'Please select one.';    
        $messages['inpterms.oldFormula.required'] = 'Please select one.';    
        $messages['inpterms.notarialFeeOrigin.required'] = 'Notarial fee origin is required.';   
        $messages['inpterms.lessThanAmountTYpe.required'] = 'Please select one.';   
        $messages['inpterms.lessThanNotarialAmount.required'] = 'Please enter amount.';  
        $messages['inpterms.lessThanNotarialAmount.numeric'] = 'Please enter a number.';  
        $messages['inpterms.greaterThanEqualAmountType.required'] = 'Please select one.';   
        $messages['inpterms.greaterThanEqualNotarialAmount.required'] = 'Please enter amount.';  
        $messages['inpterms.greaterThanEqualNotarialAmount.numeric'] = 'Please enter a number.';          
        $messages['inpterms.loanInsuranceAmountType.required'] = 'Please select one.';   
        $messages['inpterms.loanInsuranceAmount.required'] = 'Please enter amount.';  
        $messages['inpterms.loanInsuranceAmount.numeric'] = 'Please enter a number.';          
        $messages['inpterms.lifeInsuranceAmountType.required'] = 'Please select one.';   
        $messages['inpterms.lifeInsuranceAmount.required'] = 'Please enter amount.';  
        $messages['inpterms.lifeInsuranceAmount.numeric'] = 'Please enter a number.'; 
        $messages['inpterms.deductInterest.required'] = 'Please select one.'; 

        return $messages;        
    }

    public function save(){   
        $inputs = $this->validate();
        //dd($this->terms);
        $terms = [];
        if(count( $this->terms) > 0){
            foreach($this->terms as $key => $value){ 

                if($this->loantypeID == ''){
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
                                    'greaterThanEqualAmountType' => $value['greaterThanEqualAmountType'],  
                                    'loanInsuranceAmount' => $value['loanInsuranceAmount'], 
                                    'loanInsuranceAmountType' => $value['loanInsuranceAmountType'],       
                                    'lifeInsuranceAmount' => $value['lifeInsuranceAmount'],       
                                    'lifeInsuranceAmountType' => $value['lifeInsuranceAmountType'],       
                                    'deductInterest' => $value['deductInterest'], 
                                    'collectionTypeId' => $value['collectionTypeId'],                                          
                                ];
                }
                else
                {
                    $terms[] =  [
                                'topId' => $value['topId'],          
                                'nameOfTerms' => $value['nameOfTerms'], 
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
                                'greaterThanEqualAmountType' => $value['greaterThanEqualAmountType'],  
                                'loanInsuranceAmount' => $value['loanInsuranceAmount'], 
                                'loanInsuranceAmountType' => $value['loanInsuranceAmountType'],       
                                'lifeInsuranceAmount' => $value['lifeInsuranceAmount'],       
                                'lifeInsuranceAmountType' => $value['lifeInsuranceAmountType'],       
                                'deductInterest' => $value['deductInterest'], 
                                'collectionTypeId' => $value['collectionTypeId'],                                                                     
                            ];
                }            
            }
        }
       
        $data = [
                    'loanTypeName' =>  $inputs['loantype']['loanTypeName'],
                    'loanTypeID' => $this->loantypeID,
                    'savings' =>  isset($inputs['loantype']['savings']) ? $inputs['loantype']['savings'] : 0,
                    'loanAmount_Min' =>  isset($inputs['loantype']['loanAmount_Min']) ? $inputs['loantype']['loanAmount_Min'] : 0,
                    'loanAmount_Max' =>  isset($inputs['loantype']['loanAmount_Max']) ? $inputs['loantype']['loanAmount_Max'] : 0,
                    'terms' => $terms
                ];
                //dd($data);
        $savemsg = '';
        if($this->loantypeID == ''){
            $savemsg = 'Loan type successfully saved';
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/SaveLoanType', $data);            
            
            $getLasLoanId = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/GetlastLoanTypeDetails');  
            $getLasLoanId =  $getLasLoanId->json();
            $this->loantypeID = $getLasLoanId['loanTypeID'];
        }   
        else{
            $savemsg = 'Loan type successfully updated';
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/UpdateLoanType', $data);

            //dd($crt);
          
        }               
        return redirect()->to('/maintenance/loantypes/view/' . $this->loantypeID)->with('mmessage', $savemsg);     
    }
    
    public function addTerms(){
        if(isset($this->inpterms['termsKey'])){
            if($this->inpterms['termsKey'] > 0){             
                $lastcnt = $this->inpterms['termsKey'];
            }
            else{                
                $lastcnt = array_key_last($this->terms) + 1;   
            }
        }
        else{           
            $lastcnt = array_key_last($this->terms) + 1;   
        }
      
        $data = $this->validate([                                    
                                    'inpterms.nameOfTerms' => ['required'],
                                    'inpterms.interestRate' => ['required', 'numeric'],
                                    'inpterms.interestType' => ['required'],  
                                    'inpterms.formula' => ['required'],
                                    'inpterms.interestApplied' => isset($this->inpterms['interestType']) ? ($this->inpterms['interestType'] == 'Custom' ? ['required'] : '') : '',                                                                
                                    'inpterms.terms' => ['required', 'numeric'],  
                                    'inpterms.oldFormula' => ['required'],    
                                    'inpterms.noAdvancePayment' => ['required'],                                      
                                    'inpterms.collectionTypeId' => ['required'],    
                                    'inpterms.notarialFeeOrigin' => ['required'],    
                                    'inpterms.lessThanNotarialAmount' => ['required', 'numeric'],    
                                    'inpterms.lessThanAmountTYpe' => ['required'], 
                                    'inpterms.greaterThanEqualNotarialAmount' => ['required', 'numeric'],  
                                    'inpterms.greaterThanEqualAmountType' => ['required'],  
                                    'inpterms.loanInsuranceAmount' => ['required', 'numeric'],  
                                    'inpterms.loanInsuranceAmountType' => ['required'],  
                                    'inpterms.lifeInsuranceAmount' => ['required', 'numeric'],  
                                    'inpterms.lifeInsuranceAmountType' => ['required'],
                                    'inpterms.deductInterest' => ['required'],                                              
                                ]);

                               

        $this->terms[$lastcnt] = [  'nameOfTerms' => $data['inpterms']['nameOfTerms'],
                                    'interestRate' => $data['inpterms']['interestRate'],
                                    'interestType' => $data['inpterms']['interestType'],                                         
                                    'formula' => $data['inpterms']['formula'], 
                                    'interestApplied' => isset($data['inpterms']['interestApplied']) ? $data['inpterms']['interestApplied'] : 0,   
                                    'terms' => $data['inpterms']['terms'], 
                                    'oldFormula' => $data['inpterms']['oldFormula'], 
                                    'noAdvancePayment' => $data['inpterms']['noAdvancePayment'], 
                                    'notarialFeeOrigin' => isset($data['inpterms']['notarialFeeOrigin']) ? $data['inpterms']['notarialFeeOrigin'] : '', 
                                    'lessThanNotarialAmount' => isset($data['inpterms']['lessThanNotarialAmount']) ? $data['inpterms']['lessThanNotarialAmount'] : 0, 
                                    'lessThanAmountTYpe' => isset($data['inpterms']['lessThanAmountTYpe']) ? $data['inpterms']['lessThanAmountTYpe'] : '', 
                                    'greaterThanEqualNotarialAmount' => isset($data['inpterms']['greaterThanEqualNotarialAmount']) ? $data['inpterms']['greaterThanEqualNotarialAmount'] : 0, 
                                    'greaterThanEqualAmountType' => isset($data['inpterms']['greaterThanEqualAmountType']) ? $data['inpterms']['greaterThanEqualAmountType'] : '', 
                                    'loanInsuranceAmount' => isset($data['inpterms']['loanInsuranceAmount']) ? $data['inpterms']['loanInsuranceAmount'] : 0,   
                                    'loanInsuranceAmountType' => isset($data['inpterms']['loanInsuranceAmountType']) ? $data['inpterms']['loanInsuranceAmountType'] : '',   
                                    'lifeInsuranceAmount' => isset($data['inpterms']['lifeInsuranceAmount']) ? $data['inpterms']['lifeInsuranceAmount'] : 0, 
                                    'lifeInsuranceAmountType' => isset($data['inpterms']['lifeInsuranceAmountType']) ? $data['inpterms']['lifeInsuranceAmountType'] : '', 
                                    'deductInterest' => isset($data['inpterms']['deductInterest']) ? $data['inpterms']['deductInterest'] : 2, 
                                    'collectionTypeId' => $data['inpterms']['collectionTypeId'],      
                                    'topId' => isset($this->inpterms['topId']) ? $this->inpterms['topId'] : null,                         
                                     ];
        //dd($this->terms);                           
        $this->resetterms();                        
    }

    public function removeTerms($key){
        unset($this->terms[$key]);
    }

    public function editTerms($key){
        $inp =  $this->terms[$key];
        $this->inpterms['termsKey'] = $key;
        $this->inpterms['nameOfTerms'] = $inp['nameOfTerms'];
        $this->inpterms['interestRate'] = $inp['interestRate'] <= 100 ? $inp['interestRate'] * 100 : $inp['interestRate'];
        $this->inpterms['interestType'] = $inp['interestType'];
        $this->inpterms['formula'] = $inp['formula'];;
        $this->inpterms['interestApplied'] = $inp['interestApplied'];
        $this->inpterms['terms'] = $inp['terms'];
        $this->inpterms['oldFormula'] = $inp['oldFormula'];
        $this->inpterms['noAdvancePayment'] = $inp['noAdvancePayment'];
        $this->inpterms['notarialFeeOrigin'] = $inp['notarialFeeOrigin'];
        $this->inpterms['lessThanNotarialAmount'] = $inp['lessThanNotarialAmount'];    
        $this->inpterms['lessThanAmountTYpe'] = $inp['lessThanAmountTYpe'];
        $this->inpterms['greaterThanEqualNotarialAmount'] = $inp['greaterThanEqualNotarialAmount'];
        $this->inpterms['greaterThanEqualAmountType'] = $inp['greaterThanEqualAmountType'];
        $this->inpterms['loanInsuranceAmount'] = $inp['loanInsuranceAmount'];
        $this->inpterms['loanInsuranceAmountType'] = $inp['loanInsuranceAmountType'];
        $this->inpterms['lifeInsuranceAmount'] = $inp['lifeInsuranceAmount'];
        $this->inpterms['lifeInsuranceAmountType'] = $inp['lifeInsuranceAmountType'];
        $this->inpterms['deductInterest'] = $inp['deductInterest'];
        $this->inpterms['collectionTypeId'] = $inp['collectionTypeId'];
        $this->inpterms['topId'] = $inp['topId'];
    }

    public function resetterms(){            
        $this->inpterms['termsKey'] = 0;                                                 
        $this->inpterms['nameOfTerms'] = null;
        $this->inpterms['interestRate'] = null;
        $this->inpterms['interestType'] = null;
        $this->inpterms['formula'] = null;
        $this->inpterms['interestApplied'] = null;  
        $this->inpterms['terms'] = null;
        $this->inpterms['oldFormula'] = 2;
        $this->inpterms['noAdvancePayment'] = 2;
        $this->inpterms['notarialFeeOrigin'] = null;
        $this->inpterms['lessThanNotarialAmount'] = null;    
        $this->inpterms['lessThanAmountTYpe'] = null;
        $this->inpterms['greaterThanEqualNotarialAmount'] = null;
        $this->inpterms['greaterThanEqualAmountType'] = null;
        $this->inpterms['loanInsuranceAmount'] = null;
        $this->inpterms['loanInsuranceAmountType'] = null;
        $this->inpterms['lifeInsuranceAmount'] = null;
        $this->inpterms['lifeInsuranceAmountType'] = null;
        $this->inpterms['deductInterest'] = 2;
        $this->inpterms['collectionTypeId'] = null;
        $this->inpterms['topId'] = null;
    }

    public function archive($loantypeID){       
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/DeleteLoanType', [ 'loanTypeID' => $loantypeID ]);              
        //dd($loantypeID);
        return redirect()->to('/maintenance/loantypes/list')->with('mmessage', 'Loan type has been trashed');    
    }

    public function mount($loanid = ''){
        if($loanid != ''){
            $this->loantypeID = $loanid;
            $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/LoanTypeFilter', ['loanTypeID' => $this->loantypeID]);            
            $data = $data->json();
            $data = $data[0];
            //cdd($data);

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
                                            'topId' => $termsofPayment['topId'],
                                         ];
                }
            }         
        }

        $this->inpterms['noAdvancePayment'] = 1;
        $this->inpterms['oldFormula'] = 2;
        $this->inpterms['deductInterest'] = 2;

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
        if(isset($this->inpterms['collectionTypeId'])){
            if($this->inpterms['collectionTypeId'] == 3){
                $this->inpterms['interestType'] = 'Custom';
                $this->inpterms['interestApplied'] = 'Monthly';
            }
        }
        if(isset($this->inpterms['interestType'])){
            if( $this->inpterms['interestType'] == 'Compound' ){
                $this->inpterms['interestApplied'] = '';
            }
        }
        return view('livewire.maintenance.loan-types.loan-types');
    }
}
