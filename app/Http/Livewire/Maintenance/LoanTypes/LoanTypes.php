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
    public $currentEditingKey = null;
    public $inpterms;
    public $collectionType = [];
    public $formulaList = [];
    public $formulaLookup = [];

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
        $terms = collect($this->terms);
        $data = [
            'LoanTypeName' => $inputs['loantype']['LoanTypeName'],
            'Savings' => isset($inputs['loantype']['Savings']) ? $inputs['loantype']['Savings'] : 0,
            'LoanAmount_Min' => isset($inputs['loantype']['LoanAmount_Min']) ? $inputs['loantype']['LoanAmount_Min'] : 0,
            'LoanAmount_Max' => isset($inputs['loantype']['LoanAmount_Max']) ? $inputs['loantype']['LoanAmount_Max'] : 0,
        ];
    
        if ($this->LoanTypeId == '') {
            
            $data = array_merge($data, [
                'Status' => 1,
                'DateCreated' => now(),
                'DateUpdated' => null,
            ]);
    
            $loanType = LoanType::create($data);
            $latestLoanTypeID = $loanType->LoanTypeID;
    
            foreach ($terms as $term) {
                $term['LoanTypeId'] = $latestLoanTypeID;
                TermsOfPayment::create(array_merge($term, [
                    'Status' => 1,
                    'DateCreated' => now(),
                ]));
            }
    
            $savemsg = 'Loan type successfully saved!';
        } else {

            // Update existing loan type
            $loanType = LoanType::where('LoanTypeID', $this->LoanTypeId);
            $loanType->update(array_merge($data, [
                'Status' => 1,
                'DateUpdated' => now(),
            ]));
    
            $existingTerms = TermsOfPayment::where('LoanTypeId', $this->LoanTypeId)->get()->keyBy('TopId');
            $incomingTerms = $terms->keyBy('TopId');
    
            foreach ($existingTerms as $id => $term) {
                if ($incomingTerms->has($id)) {

                    $updatedTerm = $incomingTerms->get($id);
    
                    $term->update(
                        array_merge(array_diff_key($updatedTerm, ['TopId' => '']), [
                            'Status' => $term->Status,
                            'DateCreated' => $term->DateCreated, 
                            'DateUpdated' => now(),
                        ])
                    );
                } else {
                    $term->delete();
                }
            }
    
            foreach ($incomingTerms as $id => $term) {
                if (!$existingTerms->has($id)) {
                    TermsOfPayment::create(array_merge($term, [
                        'LoanTypeId' => $this->LoanTypeId,
                        'Status' => 1,
                        'DateCreated' => now(),
                    ]));
                }
            }
    
            $savemsg = 'Loan type successfully updated!';
        }
    
        return redirect()->to('/maintenance/loantypes/view/' . ($this->LoanTypeId ?: $latestLoanTypeID))->with('mmessage', $savemsg);
    }
    
    public function addTerms()
    {
        $termsCollection = collect($this->terms);
        if(isset($this->inpterms['termsKey'])){
            if($this->inpterms['termsKey'] > 0){             
                $lastcnt = $this->inpterms['termsKey'];
            }
            else{      
                $lastcnt = $termsCollection->keys()->last() + 1;          
            }
        }
        else{           
            $lastcnt = $termsCollection->keys()->last() + 1;          
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
        // dd($this->terms);                           
        $this->resetterms();                        
    }

    public function removeTerms($key)
    {
        unset($this->terms[$key]);
    }

    public function editTerms($key)
    {
        $this->currentEditingKey = (string)$key;
        $inp = $this->terms[$key];
        $this->inpterms = array_merge(['termsKey' => $key], $inp);
    }

    public function resetterms()
    {            
        $this->currentEditingKey = null;
        $this->inpterms = [
            'termsKey' => null,
            'NameOfTerms' => null,
            'InterestRate' => null,
            'InterestType' => null,
            'Formula' => null,
            'InterestApplied' => null,
            'Terms' => null,
            'OldFormula' => 2,
            'NoAdvancePayment' => 2,
            'NotarialFeeOrigin' => null,
            'LessThanNotarialAmount' => null,
            'LessThanAmountType' => null,
            'GreaterThanEqualNotarialAmount' => null,
            'GreaterThanEqualAmountType' => null,
            'LoanInsuranceAmount' => null,
            'LoanInsuranceAmountType' => null,
            'LifeInsuranceAmount' => null,
            'LifeInsuranceAmountType' => null,
            'DeductInterest' => 2,
            'CollectionTypeId' => null,
            'TopId' => null,
        ];
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

    public function mount($loanid = '')
    {
        $this->usertype = session()->get('auth_usertype'); 
        if ($loanid != '') {
            $this->LoanTypeId = $loanid;

            $loantype = LoanType::where('LoanTypeId', $loanid)->first();

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

            $this->loantype = LoanType::with('terms')->where('LoanTypeId', $loanid)->first();

            if ($this->loantype) {

                $this->terms = $this->loantype->terms->map(function($term) {
                    return [
                        'NameOfTerms' => $term->NameOfTerms,
                        'InterestRate' => $term->InterestRate,
                        'InterestType' => $term->InterestType,
                        'LoanTypeId' => $this->LoanTypeId,
                        'Formula' => $term->Formula,
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
            
            
        } else {
            $this->loantype = new LoanType();
        }
        $this->inpterms['NoAdvancePayment'] = 1;
        $this->inpterms['OldFormula'] = 2;
        $this->inpterms['DeductInterest'] = 2;

        $this->collectionType = TermsTypeOfCollection::all()->pluck('TypeOfCollection', 'Id')->toArray();;
        $this->formulaList = AdvancePaymentFormula::all()
            ->mapWithKeys(function ($item) {
                return [$item['Id'] => ['Formula' => $item['Formula'], 'APFID' => $item['APFID']]];
            })
            ->toArray();

        $this->formulaLookup = array_column($this->formulaList, 'Formula', 'APFID');
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
