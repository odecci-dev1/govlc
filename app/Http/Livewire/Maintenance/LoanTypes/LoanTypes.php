<?php

namespace App\Http\Livewire\Maintenance\LoanTypes;

use App\Models\AdvancePaymentFormula;
use App\Models\LoanType;
use App\Models\TermsOfPayment;
use App\Models\TermsTypeOfCollection;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;

class LoanTypes extends Component
{

    use Common;
    public $LoanTypeId = '';
    public $loantype;
    public $usertype;
    
    public $terms = [];
    public $inpterms;
    public $collectionType = [];
    public $formulaList = [];

    public function rules()
    {                
        $rules = [
            'loantype.LoanTypeName' => 'required',
            'terms' => 'required',
            'loantype.Savings' => 'required',
            'loantype.LoanAmount_Min' => !empty($this->loantype['LoanAmount_Max']) ? ['required'] : '',
            'loantype.LoanAmount_Max' => !empty($this->loantype['LoanAmount_Min']) ? ['required', 'gte:loantype.LoanAmount_Min'] : '',
        ];   
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'loantype.LoanTypeName' => 'Please enter loan type name',  
            'loantype.Savings' => 'Please enter amount',  
            'loantype.LoanAmount_Min.required' => 'Please enter amount',  
            'loantype.LoanAmount_Max.required' => 'Please enter amount',  
            'loantype.Loan_amount_Lessthan.required' => 'Please enter amount',  
            'loantype.Loan_amount_GreaterEqual.required' => 'Please enter amount',  
            'loantype.LoanAmount_Max.gte' => 'Max amt must be greter than min amt',  
            'loantype.loan_amount_Lessthan_Amount.required' => 'Please enter amount',  
            'loantype.lalV_Type.required' => 'Please enter amount',  
            'loantype.loan_amount_GreaterEqual_Amount.required' => 'Please enter amount',    
            'loantype.lageF_Type.required' => 'Please enter amount',   
            'loantype.loanInsurance.required' => 'Please enter amount',   
            'loantype.loanI_Type.required' => 'Please enter amount',    
            'loantype.lifeInsurance.required' => 'Please enter amount',  
            'loantype.lifeI_Type.required' => 'Please enter amount',

            'Terms.required' => 'Please add terms of payment', 

            'inpterms.NameOfTerms.required' => 'Name of terms is required.',        
            'inpterms.Terms.required' => 'Terms is required.',  
            'inpterms.Terms.numeric' => 'Terms should be a number.',                      
            'inpterms.InterestRate.required' => 'Interest rate is required.',  
            'inpterms.InterestRate.numeric' => 'Interest rate should be a number.',  
            'inpterms.InterestType.required' => 'Interest type is required.',    
            'inpterms.Formula.required' => 'Select Formula from the list.',    
            'inpterms.CollectionTypeId.required' => 'Select collection type',   
            'inpterms.InterestApplied.required' => 'Interest applied is required.',    
            'inpterms.NoAdvancePayment.required' => 'Please select one.',    
            'inpterms.OldFormula.required' => 'Please select one.',    
            'inpterms.NotarialFeeOrigin.required' => 'Notarial fee origin is required.',   
            'inpterms.LessThanAmountType.required' => 'Please select one.',   
            'inpterms.LessThanNotarialAmount.required' => 'Please enter amount.',  
            'inpterms.LessThanNotarialAmount.numeric' => 'Please enter a number.',  
            'inpterms.GreaterThanEqualAmountType.required' => 'Please select one.',   
            'inpterms.GreaterThanEqualNotarialAmount.required' => 'Please enter amount.',  
            'inpterms.GreaterThanEqualNotarialAmount.numeric' => 'Please enter a number.',          
            'inpterms.LoanInsuranceAmountType.required' => 'Please select one.',   
            'inpterms.LoanInsuranceAmount.required' => 'Please enter amount.',  
            'inpterms.LoanInsuranceAmount.numeric' => 'Please enter a number.',          
            'inpterms.LifeInsuranceAmountType.required' => 'Please select one.',   
            'inpterms.LifeInsuranceAmount.required' => 'Please enter amount.',  
            'inpterms.LifeInsuranceAmount.numeric' => 'Please enter a number.', 
            'inpterms.DeductInterest.required' => 'Please select one.', 
        ];
        
        return $messages;        
    }

    public function save()
    {   
        $inputs = $this->validate();
        $terms = [];
        if(count( $this->terms) > 0) {
            foreach($this->terms as $key => $value) { 

                if($this->LoanTypeId == '') {
                    $terms[] = [   
                        'NameOfTerms' => $value['NameOfTerms'], 
                        'InterestRate' => $value['InterestRate'],
                        'InterestType' => $value['InterestType'],
                        'LoanTypeId' => $this->LoanTypeId,   
                        'Formula' => $value['Formula'],  
                        'InterestApplied' => $value['InterestApplied'],  
                        'Terms' => $value['Terms'], 
                        'OldFormula' => $value['OldFormula'], 
                        'NoAdvancePayment' => $value['NoAdvancePayment'],  
                        'NotarialFeeOrigin' => $value['NotarialFeeOrigin'],  
                        'LessThanNotarialAmount' => $value['LessThanNotarialAmount'],  
                        'LessThanAmountType' => $value['LessThanAmountType'],  
                        'GreaterThanEqualNotarialAmount' => $value['GreaterThanEqualNotarialAmount'],  
                        'GreaterThanEqualAmountType' => $value['GreaterThanEqualAmountType'],  
                        'LoanInsuranceAmount' => $value['LoanInsuranceAmount'], 
                        'LoanInsuranceAmountType' => $value['LoanInsuranceAmountType'],       
                        'LifeInsuranceAmount' => $value['LifeInsuranceAmount'],       
                        'LifeInsuranceAmountType' => $value['LifeInsuranceAmountType'],       
                        'DeductInterest' => $value['DeductInterest'], 
                        'CollectionTypeId' => $value['CollectionTypeId'],                                          
                    ];
                } else {
                    $terms[] = [
                        'TopId' => $value['TopId'],          
                        'NameOfTerms' => $value['NameOfTerms'], 
                        'InterestRate' => $value['InterestRate'],
                        'InterestType' => $value['InterestType'],
                        'LoanTypeId' => $this->LoanTypeId,   
                        'Formula' => $value['Formula'],  
                        'InterestApplied' => $value['InterestApplied'],  
                        'Terms' => $value['Terms'], 
                        'OldFormula' => $value['OldFormula'], 
                        'NoAdvancePayment' => $value['NoAdvancePayment'],  
                        'NotarialFeeOrigin' => $value['NotarialFeeOrigin'],  
                        'LessThanNotarialAmount' => $value['LessThanNotarialAmount'],  
                        'LessThanAmountType' => $value['LessThanAmountType'],  
                        'GreaterThanEqualNotarialAmount' => $value['GreaterThanEqualNotarialAmount'],  
                        'GreaterThanEqualAmountType' => $value['GreaterThanEqualAmountType'],  
                        'LoanInsuranceAmount' => $value['LoanInsuranceAmount'], 
                        'LoanInsuranceAmountType' => $value['LoanInsuranceAmountType'],       
                        'LifeInsuranceAmount' => $value['LifeInsuranceAmount'],       
                        'LifeInsuranceAmountType' => $value['LifeInsuranceAmountType'],       
                        'DeductInterest' => $value['DeductInterest'], 
                        'CollectionTypeId' => $value['CollectionTypeId'],                                                                     
                    ];
                }            
            }
        }
       
        $data = [
            'LoanTypeName' =>  $inputs['loantype']['LoanTypeName'],
            'Savings' =>  isset($inputs['loantype']['Savings']) ? $inputs['loantype']['Savings'] : 0,
            'LoanAmount_Min' =>  isset($inputs['loantype']['LoanAmount_Min']) ? $inputs['loantype']['LoanAmount_Min'] : 0,
            'LoanAmount_Max' =>  isset($inputs['loantype']['LoanAmount_Max']) ? $inputs['loantype']['LoanAmount_Max'] : 0,
            'Terms' => $terms
        ];

        // dd($data, $this->LoanTypeId);
              
        $savemsg = '';
        if($this->LoanTypeId == ''){
            $savemsg = 'Loan type successfully saved!';
            $loanType = LoanType::create([
                $data,
                'Status' => 1,
                'DataCreated' => now(),
                'DateUpdated' => NULL,
            ]);

            $this->LoanTypeId = $loanType->LoanTypeID;

            foreach ($terms as $term) {
                $term['LoanTypeId'] = $this->LoanTypeID;
                TermsOfPayment::create($term);
            }

            $latestOfficer = LoanType::latest()->first();
            dd($latestOfficer);
            // return redirect()->to('/maintenance/loantypes/view/' . $latestOfficer)->with('mmessage', $savemsg);     
        } else {
            $savemsg = 'Loan type successfully updated!';
            $loanType = LoanType::where('LoanTypeID', $this->LoanTypeId);
            $loanType->update([
                $data,
                'Status' => 1,
                'DataCreated' => $this->DateCreated,
                'DateUpdated' => now(),
            ]);

            foreach ($terms as $term) {
                if (isset($term['TopId'])) {
                    $existingTerm = TermsOfPayment::find($term['TopId']);
                    if ($existingTerm) {
                        $existingTerm->update($term);
                    }
                } else {
                    $term['LoanTypeId'] = $this->LoanTypeId;
                    TermsOfPayment::create($term);
                }
            }

            return redirect()->to('/maintenance/loantypes/view/' . $this->LoanTypeId)->with('mmessage', $savemsg);     
        }               
    }
    
    public function addTerms()
    {
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
            'inpterms.NameOfTerms' => ['required'],
            'inpterms.InterestRate' => ['required', 'numeric'],
            'inpterms.InterestType' => ['required'],  
            'inpterms.Formula' => ['required'],
            'inpterms.InterestApplied' => isset($this->inpterms['InterestType']) ? ($this->inpterms['InterestType'] == 'Custom' ? ['required'] : '') : '',                                                                
            'inpterms.Terms' => ['required', 'numeric'],  
            'inpterms.OldFormula' => ['required'],    
            'inpterms.NoAdvancePayment' => ['required'],                                      
            'inpterms.CollectionTypeId' => ['required'],    
            'inpterms.NotarialFeeOrigin' => ['required'],    
            'inpterms.LessThanNotarialAmount' => ['required', 'numeric'],    
            'inpterms.LessThanAmountType' => ['required'], 
            'inpterms.GreaterThanEqualNotarialAmount' => ['required', 'numeric'],  
            'inpterms.GreaterThanEqualAmountType' => ['required'],  
            'inpterms.LoanInsuranceAmount' => ['required', 'numeric'],  
            'inpterms.LoanInsuranceAmountType' => ['required'],  
            'inpterms.LifeInsuranceAmount' => ['required', 'numeric'],  
            'inpterms.LifeInsuranceAmountType' => ['required'],
            'inpterms.DeductInterest' => ['required'],                                              
        ]);

        $this->terms[$lastcnt] = [  
            'NameOfTerms' => $data['inpterms']['NameOfTerms'],
            'InterestRate' => $data['inpterms']['InterestRate'],
            'InterestType' => $data['inpterms']['InterestType'],                                         
            'Formula' => $data['inpterms']['Formula'], 
            'InterestApplied' => isset($data['inpterms']['InterestApplied']) ? $data['inpterms']['InterestApplied'] : 0,   
            'Terms' => $data['inpterms']['Terms'], 
            'OldFormula' => $data['inpterms']['OldFormula'], 
            'NoAdvancePayment' => $data['inpterms']['NoAdvancePayment'], 
            'NotarialFeeOrigin' => isset($data['inpterms']['NotarialFeeOrigin']) ? $data['inpterms']['NotarialFeeOrigin'] : '', 
            'LessThanNotarialAmount' => isset($data['inpterms']['LessThanNotarialAmount']) ? $data['inpterms']['LessThanNotarialAmount'] : 0, 
            'LessThanAmountType' => isset($data['inpterms']['LessThanAmountType']) ? $data['inpterms']['LessThanAmountType'] : '', 
            'GreaterThanEqualNotarialAmount' => isset($data['inpterms']['GreaterThanEqualNotarialAmount']) ? $data['inpterms']['GreaterThanEqualNotarialAmount'] : 0, 
            'GreaterThanEqualAmountType' => isset($data['inpterms']['GreaterThanEqualAmountType']) ? $data['inpterms']['GreaterThanEqualAmountType'] : '', 
            'LoanInsuranceAmount' => isset($data['inpterms']['LoanInsuranceAmount']) ? $data['inpterms']['LoanInsuranceAmount'] : 0,   
            'LoanInsuranceAmountType' => isset($data['inpterms']['LoanInsuranceAmountType']) ? $data['inpterms']['LoanInsuranceAmountType'] : '',   
            'LifeInsuranceAmount' => isset($data['inpterms']['LifeInsuranceAmount']) ? $data['inpterms']['LifeInsuranceAmount'] : 0, 
            'LifeInsuranceAmountType' => isset($data['inpterms']['LifeInsuranceAmountType']) ? $data['inpterms']['LifeInsuranceAmountType'] : '', 
            'DeductInterest' => isset($data['inpterms']['DeductInterest']) ? $data['inpterms']['DeductInterest'] : 2, 
            'CollectionTypeId' => $data['inpterms']['CollectionTypeId'],      
            'TopId' => isset($this->inpterms['TopId']) ? $this->inpterms['TopId'] : null,                         
        ];
        //dd($this->terms);                           
        $this->resetterms();                        
    }

    public function removeTerms($key)
    {
        unset($this->terms[$key]);
    }

    public function editTerms($key)
    {
        $inp =  $this->terms[$key];
        $this->inpterms['termsKey'] = $key;
        $this->inpterms['NameOfTerms'] = $inp['NameOfTerms'];
        $this->inpterms['InterestRate'] = $inp['InterestRate'];
        $this->inpterms['InterestType'] = $inp['InterestType'];
        $this->inpterms['Formula'] = $inp['Formula'];;
        $this->inpterms['InterestApplied'] = $inp['InterestApplied'];
        $this->inpterms['Terms'] = $inp['Terms'];
        $this->inpterms['OldFormula'] = $inp['OldFormula'];
        $this->inpterms['NoAdvancePayment'] = $inp['NoAdvancePayment'];
        $this->inpterms['NotarialFeeOrigin'] = $inp['NotarialFeeOrigin'];
        $this->inpterms['LessThanNotarialAmount'] = $inp['LessThanNotarialAmount'];    
        $this->inpterms['LessThanAmountType'] = $inp['LessThanAmountType'];
        $this->inpterms['GreaterThanEqualNotarialAmount'] = $inp['GreaterThanEqualNotarialAmount'];
        $this->inpterms['GreaterThanEqualAmountType'] = $inp['GreaterThanEqualAmountType'];
        $this->inpterms['LoanInsuranceAmount'] = $inp['LoanInsuranceAmount'];
        $this->inpterms['LoanInsuranceAmountType'] = $inp['LoanInsuranceAmountType'];
        $this->inpterms['LifeInsuranceAmount'] = $inp['LifeInsuranceAmount'];
        $this->inpterms['LifeInsuranceAmountType'] = $inp['LifeInsuranceAmountType'];
        $this->inpterms['DeductInterest'] = $inp['DeductInterest'];
        $this->inpterms['CollectionTypeId'] = $inp['CollectionTypeId'];
        $this->inpterms['TopId'] = $inp['TopId'];
    }

    public function resetterms()
    {            
        $this->inpterms['termsKey'] = 0;                                                 
        $this->inpterms['NameOfTerms'] = null;
        $this->inpterms['InterestRate'] = null;
        $this->inpterms['InterestType'] = null;
        $this->inpterms['Formula'] = null;
        $this->inpterms['InterestApplied'] = null;  
        $this->inpterms['Terms'] = null;
        $this->inpterms['OldFormula'] = 2;
        $this->inpterms['NoAdvancePayment'] = 2;
        $this->inpterms['NotarialFeeOrigin'] = null;
        $this->inpterms['LessThanNotarialAmount'] = null;    
        $this->inpterms['LessThanAmountType'] = null;
        $this->inpterms['GreaterThanEqualNotarialAmount'] = null;
        $this->inpterms['GreaterThanEqualAmountType'] = null;
        $this->inpterms['LoanInsuranceAmount'] = null;
        $this->inpterms['LoanInsuranceAmountType'] = null;
        $this->inpterms['LifeInsuranceAmount'] = null;
        $this->inpterms['LifeInsuranceAmountType'] = null;
        $this->inpterms['DeductInterest'] = 2;
        $this->inpterms['CollectionTypeId'] = null;
        $this->inpterms['TopId'] = null;
    }

    public function archive($LoanTypeId)
    {       
        $loantype = LoanType::where('LoanTypeID', $LoanTypeId);
        
        $loantype->update([
            'Status' => 2,
            'DateUpdated' => now(),
        ]);

        return redirect()->to('/maintenance/loantypes/list')->with('mmessage', 'Loan type has been trashed');    
    }

    // public function mount($loanid = '')
    // {
    //     $this->usertype = session()->get('auth_usertype'); 
    //     if($loanid != ''){
    //         $this->LoanTypeId = $loanid;

    //         $loantype = LoanType::where('LoanTypeId', $loanid)->first();
    //         $termsofPayment = TermsOfPayment::where('LoanTypeId', $loanid)->first();
            
    //         $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/LoanType/LoanTypeFilter', ['LoanTypeId' => $this->LoanTypeId]);            
    //         $data = $data->json();
    //         $data = $data[0];

    //         $this->loantype['Loan_amount_Lessthan'] = $data['Loan_amount_Lessthan'];
    //         $this->loantype['Loan_amount_GreaterEqual'] = $data['Loan_amount_GreaterEqual'];
    //         $this->loantype['Savings'] = $data['Savings'];
    //         $this->loantype['LoanAmount_Min'] = $data['LoanAmount_Min'];
    //         $this->loantype['LoanAmount_Max'] = $data['LoanAmount_Max'];
    //         $this->loantype['LoanTypeName'] = $data['LoanTypeName'];

    //         $this->loantype['loan_amount_Lessthan_Amount'] = $data['loan_amount_Lessthan_Amount'];
    //         $this->loantype['lalV_Type'] = $data['laL_Id'];
    //         $this->loantype['loan_amount_GreaterEqual_Amount'] = $data['loan_amount_GreaterEqual_Amount'];
    //         $this->loantype['lageF_Type'] = $data['laG_Id'];

    //         $this->loantype['loanInsurance'] = $data['loanInsurance'];
    //         $this->loantype['loanI_Type'] = $data['loanI_Id'];
    //         $this->loantype['lifeInsurance'] = $data['lifeInsurance'];
    //         $this->loantype['lifeI_Type'] = $data['lifeI_Id'];

    //         $termsofPayment = $data['termsofPayment'];         
    //         $cnt = 0;
    //         if( $termsofPayment ){
    //             foreach($termsofPayment as $termsofPayment){
    //                 $cnt = $cnt + 1;                                                    
    //                 $this->terms[$cnt] = [  
    //                     'NameOfTerms' => $termsofPayment['NameOfTerms'],
    //                     'InterestRate' => $termsofPayment['InterestRate'],
    //                     'InterestType' => $termsofPayment['iR_Type'],                                         
    //                     'LoanTypeId' => $this->LoanTypeId,                                           
    //                     'Formula' => $termsofPayment['formulaID'],
    //                     'InterestApplied' => $termsofPayment['InterestApplied'],
    //                     'terms' => $termsofPayment['terms'],
    //                     'OldFormula' => $termsofPayment['OldFormula'],
    //                     'NoAdvancePayment' => $termsofPayment['NoAdvancePayment'],
    //                     'NotarialFeeOrigin' => $termsofPayment['NotarialFeeOrigin'],
    //                     'LessThanNotarialAmount' => $termsofPayment['LessThanNotarialAmount'],
    //                     'LessThanAmountType' => $termsofPayment['lalV_TypeID'],
    //                     'GreaterThanEqualNotarialAmount' => $termsofPayment['GreaterThanEqualNotarialAmount'],
    //                     'GreaterThanEqualAmountType' => $termsofPayment['lageF_TypeID'],
    //                     'LoanInsuranceAmount' => $termsofPayment['LoanInsuranceAmount'],
    //                     'LoanInsuranceAmountType' => $termsofPayment['loanI_TypeID'],
    //                     'LifeInsuranceAmount' => $termsofPayment['LifeInsuranceAmount'],
    //                     'LifeInsuranceAmountType' => $termsofPayment['lifeI_TypeID'],
    //                     'DeductInterest' => $termsofPayment['DeductInterest'],
    //                     'CollectionTypeId' => $termsofPayment['typeOfCollectionID'],
    //                     'TopId' => $termsofPayment['TopId'],
    //                 ];
    //             }
    //         }         
    //     }

    //     $this->inpterms['NoAdvancePayment'] = 1;
    //     $this->inpterms['OldFormula'] = 2;
    //     $this->inpterms['DeductInterest'] = 2;

    //     $collType = $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/GetCollectionType');
    //     $collType = $collType->json();
    //     if($collType){
    //         foreach($collType as $mcollType){
    //             $this->collectionType[$mcollType['id']] = ['id' => $mcollType['id'], 'typeOfCollection' => $mcollType['typeOfCollection']];
    //         }
    //     }

    //     $formulaList = $data = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanType/GetLoanFormula');
    //     $formulaList = $formulaList->json();
    //     if($formulaList){
    //         foreach($formulaList as $mformulaList){
    //             $this->formulaList[$mformulaList['formulaID']] = ['formulaID' => $mformulaList['formulaID'], 'Formula' => $mformulaList['Formula']];
    //         }
    //     }
    //     // $this->inpterms['InterestType'] = 1;
    // }

    public function mount($loanid = '')
    {
        $this->usertype = session()->get('auth_usertype'); 
        if ($loanid != '') {
            $this->LoanTypeId = $loanid;

            $loantype = LoanType::where('LoanTypeId', $loanid)->first();
            // dd($loantype);
            $termsofPayment = TermsOfPayment::where('LoanTypeId', $loanid)->first();

            $this->loantype['Loan_amount_Lessthan'] = $loantype['Loan_amount_Lessthan'];
            $this->loantype['Loan_amount_GreaterEqual'] = $loantype['Loan_amount_GreaterEqual'];
            $this->loantype['Savings'] = $loantype->Savings;
            $this->loantype['LoanAmount_Min'] = $loantype['LoanAmount_Min'];
            $this->loantype['LoanAmount_Max'] = $loantype['LoanAmount_Max'];
            $this->loantype['LoanTypeName'] = $loantype->LoanTypeName;

            $this->loantype['loan_amount_Lessthan_Amount'] = $loantype['loan_amount_Lessthan_Amount'];
            $this->loantype['lalV_Type'] = $loantype['laL_Id'];
            $this->loantype['loan_amount_GreaterEqual_Amount'] = $loantype['loan_amount_GreaterEqual_Amount'];
            $this->loantype['lageF_Type'] = $loantype['laG_Id'];

            $this->loantype['loanInsurance'] = $loantype['loanInsurance'];
            $this->loantype['loanI_Type'] = $loantype['loanI_Id'];
            $this->loantype['lifeInsurance'] = $loantype['lifeInsurance'];
            $this->loantype['lifeI_Type'] = $loantype['lifeI_Id'];

            
            // $test = LoanType::with('terms')->where('LoanTypeId', $loanid);
            // $this->loantype = LoanType::with(['terms.advancePaymentFormula'])->find($loanid);
            $this->loantype = LoanType::with('terms')->where('LoanTypeId', $loanid)->first();
            // dd($this->loantype);

            if ($this->loantype) {
                // $this->terms = $this->loantype->terms;
                // Assign terms and other properties
                $this->terms = $this->loantype->terms->map(function($term) {
                    return [
                        'NameOfTerms' => $term->NameOfTerms,
                        'InterestRate' => $term->InterestRate,
                        'InterestType' => $term->InterestType,
                        'LoanTypeId' => $this->LoanTypeId,
                        'Formula' => $term->advancePaymentFormula ? $term->advancePaymentFormula->Formula : null,
                        'InterestApplied' => $term->InterestApplied,
                        'Terms' => $term->Terms,
                        'OldFormula' => $term->OldFormula,
                        'NoAdvancePayment' => $term->NoAdvancePayment,
                        'NotarialFeeOrigin' => $term->NotarialFeeOrigin,
                        'LessThanNotarialAmount' => $term->LessThanNotarialAmount,
                        'LessThanAmountType' => $term->LessThanAmountType,
                        'GreaterThanEqualNotarialAmount' => $term->GreaterThanEqualNotarialAmount,
                        'GreaterThanEqualAmountType' => $term->GreaterThanEqualAmountType,
                        'LoanInsuranceAmount' => $term->LoanInsuranceAmount,
                        'LoanInsuranceAmountType' => $term->LoanInsuranceAmountType,
                        'LifeInsuranceAmount' => $term->LifeInsuranceAmount,
                        'LifeInsuranceAmountType' => $term->LifeInsuranceAmountType,
                        'DeductInterest' => $term->DeductInterest,
                        'CollectionTypeId' => $term->CollectionTypeId,
                        'TopId' => $term->TopId,
                    ];
                });
            }
            
            // dd($this->terms);

            // *** Previous Approach when the was still using API Calls *** //
            // *** Refactor Below *** ///
            
        } else {
            $this->loantype = new LoanType();
        }
        $this->inpterms['NoAdvancePayment'] = 1;
        $this->inpterms['OldFormula'] = 2;
        $this->inpterms['DeductInterest'] = 2;

        $this->collectionType = TermsTypeOfCollection::all()->pluck('TypeOfCollection', 'Id')->toArray();;
        $this->formulaList = AdvancePaymentFormula::all()->pluck('Formula', 'Id')->toArray();
    }

    public function render()
    {
        if(isset($this->inpterms['CollectionTypeId'])){
            if($this->inpterms['CollectionTypeId'] == 3){
                $this->inpterms['InterestType'] = 'Custom';
                $this->inpterms['InterestApplied'] = 'Monthly';
            }
        }
        if(isset($this->inpterms['InterestType'])){
            if( $this->inpterms['InterestType'] == 'Compound' ){
                $this->inpterms['InterestApplied'] = '';
            }
        }
        return view('livewire.maintenance.loan-types.loan-types');
    }
}
