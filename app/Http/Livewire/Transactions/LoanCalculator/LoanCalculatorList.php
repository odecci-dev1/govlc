<?php

namespace App\Http\Livewire\Transactions\LoanCalculator;

use App\Models\AdvancePaymentFormula;
use App\Models\LoanCalculator;
use App\Models\LoanType;
use App\Models\TermsOfPayment;
use App\Models\Holiday;
use App\Models\LoanDetails;
use App\Traits\Calculator;
use Carbon\Carbon;
use Livewire\Component;

class LoanCalculatorList extends Component
{
    use Calculator;
    public $data;
    public $paginate = [];
    public $paginationPaging = [];
    public $openCalculator = false;

    public $loanDetails = [];

    public $termsOfPaymentList;
    public  $loantypeList=[];
    
    public $loantype;

    public $TopId;
    public $principalLoan;
    public $usedSavings;
    public $holidayPay;
    public $notarialFee;
    public $loanInsurance;
    public $lifeInsurance;
    public $loanAmount;
    public $interestRate;
    public $interestAmount;
    public $advancePayment;
    public $releasingAmount;
    public $dailyAmountDue;
    public $outstandingBalance;


    public function rules(){
        return [
            'principalLoan'=>'required',
            'loantype'=>'required',
            'TopId'=>'required',
        ];
    }
    
    public function mount()
    {
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 15;
    }

    public function setPage($page = 1)
    {
        $this->paginate['page'] = $page;
    }

    public function goToFirstPage()
    {
        $this->paginate['page'] = 1;
    }

    public function goToLastPage()
    {
        $this->paginate['page'] = $this->paginationPaging['totalPage'];
    }

    public function calculatorToggle()
    {
        $this->openCalculator = !$this->openCalculator;
    }

    public function render()
    {
       $this->getTermsOfPayment();
       $this->getLoanType();
    return view('livewire.transactions.loan-calculator.loan-calculatorlist');
    }

    public function clear(){

        $this->usedSavings = 0;
        $this->holidayPay =0;
        $this->notarialFee=0;
        $this->loanInsurance=0;
        $this->lifeInsurance=0;
        $this->loanAmount=0;
        $this->interestRate=0;
        $this->interestAmount=0;
        $this->advancePayment=0;
        $this->releasingAmount=0;
        $this->dailyAmountDue=0;
        $this->outstandingBalance=0;
    }
    public function getLoanType(){
     
        $getloans = LoanType::where('Status',1)->get();
        if(count($getloans) > 0){
            foreach($getloans as $getloans){
                $this->loantypeList[$getloans['Id']] = ['loanTypeName' => $getloans['LoanTypeName'], 'loanTypeID' => $getloans['Id']];
            }
        }
    }
    public function getTermsOfPayment(){
        $this->termsOfPaymentList =[];
        $loanterms = TermsOfPayment::where('LoanTypeId',$this->loantype)->get();
                if( $loanterms ){
                    foreach( $loanterms  as  $loanterm ){
                
                        $this->termsOfPaymentList[$loanterm['Id']] = ['Id' => $loanterm['Id'],'NameOfTerms' => $loanterm['NameOfTerms'],'loanTypeId' => $loanterm['loanTypeId']];   
                    }
        }
    }
    public function calculateLoanDetails(){

        $this->validate();

        $terms = TermsOfPayment::where('Id',$this->TopId)->first();
        $formulas = AdvancePaymentFormula::where('APFID', $terms->Formula)->first();
        $loanStart = date_create(Carbon::now()->format('Y-m-d'));
        $loanEnd = date_create(date_format(date_add(date_create(Carbon::now()->format('Y-m-d')), date_interval_create_from_date_string($terms->Terms." Days")),'Y-m-d'));
        $days = $loanStart->diff($loanEnd, true)->days;
        $sundays = intval($days / 7) + ($loanStart->format('N') + $days % 7 >= 7);
        $loanEndWithSundays = date_create(date_format(date_add( $loanEnd, date_interval_create_from_date_string($sundays." Days")),'Y-m-d'));
        $getHolidays = Holiday::whereBetween('Date',[$loanStart,$loanEndWithSundays])->count();

        
        $this->interestRate = ($terms->InterestRate  * 100)."%";
        $loanAmount = $this->principalLoan + ($this->principalLoan * $terms->InterestRate);
        $this->loanAmount = number_Format($loanAmount,2);
        $this->interestAmount = ($this->principalLoan * $terms->InterestRate);
        $this->notarialFee =  $this->calculateNotarialFee($terms->NotarialFeeOrigin,$this->principalLoan,$this->loanAmount,$terms->LessThanAmount,$terms->LessThanAmountTYpe,$terms->LessThanNotarialAmount,$terms->GreaterThanEqualAmountTYpe,$terms->GreaterThanEqualNotarialAmount);
        $this->loanInsurance = $this->calculateLoanInsurance($terms->LoanInsuranceAmountType,$terms->LoanInsuranceAmount,$this->principalLoan);
        $this->lifeInsurance = $this->calculateLifeInsurance($terms->LifeInsuranceAmountType,$terms->LifeInsuranceAmount,$this->principalLoan);
        $calculate = $this->calculateLoan($formulas->Id,$terms->InterestRate,$this->principalLoan,$terms->Terms,$terms->oldFormula);
        $this->advancePayment = $calculate['advancePayment'];
        $this->holidayPay = $calculate['collectible'] * $getHolidays ;
        $this->releasingAmount = $this->principalLoan - ($this->notarialFee + $this->loanInsurance + $this->lifeInsurance + $this->holidayPay + $calculate['advancePayment'] + $this->usedSavings);
        $isDeductInterest = $terms->DeductInterest;
        $deductInterest=0;
        if($isDeductInterest == 1){
            $deductInterest = $this->interestAmount;
        }
        $this->outstandingBalance = $loanAmount - ($this->holidayPay + $deductInterest + $this->advancePayment);
        $this->dailyAmountDue = $calculate['collectible'];
        
        
    }   
    private function getdata($paginate = true, $includeInactive = true)
    {
        $data = LoanCalculator::all();

        if ($paginate) {
            $totalItems = $data->count();
    
            $this->paginationPaging['totalPage'] = ceil($data->count() / $this->paginate['pageSize']);
            $this->paginationPaging['totalRecord'] = $totalItems;
            $this->paginationPaging['currentPage'] = $this->paginate['page'];
            $this->paginationPaging['nextPage'] = $this->paginate['page'] < $this->paginationPaging['totalPage'] ? $this->paginate['page'] + 1 : $this->paginationPaging['totalPage'];
            $this->paginationPaging['prevPage'] = $this->paginate['page'] > 1 ? $this->paginate['page'] - 1 : 1;
    
            $startItem = ($this->paginate['page'] - 1) * $this->paginate['pageSize'] + 1;
            $endItem = min($this->paginate['page'] * $this->paginate['pageSize'], $totalItems);
    
            $this->paginationPaging['startItem'] = $startItem;
            $this->paginationPaging['endItem'] = $endItem;
    
            $paginatedMembers = $data->slice(($this->paginate['page'] - 1) * $this->paginate['pageSize'], $this->paginate['pageSize']);
    
            return $paginatedMembers;
        }

        return $data;
    }
}
