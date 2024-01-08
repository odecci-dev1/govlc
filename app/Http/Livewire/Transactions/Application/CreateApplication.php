<?php

namespace App\Http\Livewire\Transactions\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Traits\Common;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Symfony\Component\Console\Input\Input;

class CreateApplication extends Component
{

    use Common;
    use WithFileUploads;

    public $naID;
    public $searchedmemId;
    public $usertype;
    public $modules = [];
    public $type;
    public $member; 
    public $comaker;
    public $loanDetails;
    public $loanTypeID;
    public $loanTypeName = '';
    public $termsOfPaymentList = [];
    public $loansummary = [];

    public $cntmemchild;
    public $inpchild = []; 

    public $membusinfo;
    public $businfo = [];
    public $hasvehicle;
    public $hasproperties;

    public $vehicle = [];
    public $inpvehicle;

    public $properties = [];
    public $inpproperties;

    public $appliances = [];
    public $inpappliances;

    public $bank = [];
    public $inpbank;

    public $emplist = [];
    public $searchempkeyword = '';

    public $imgprofile;
    public $imgcoprofile;
    public $imgmemsign;
    public $imgcosign;

    public $paymenthistory;
    public $loanhistory;

    public $reason;
    public $showDecline = false;

    //city rendering
    public $regions;
    public $provinces;
    public $cities;
    public $barangays;

    public $coregions;
    public $coprovinces;
    public $cocities;
    public $cobarangays;
    
    
    public function rules(){                
        $rules = [];      
        $rules['member.fname'] = 'required';  
        $rules['member.lname'] = 'required';  
        $rules['member.mname'] = '';  
        $rules['member.suffix'] = '';  
        $rules['member.age'] = 'required';  
        $rules['member.barangay'] = 'required';  
        $rules['member.city'] = 'required';  
        $rules['member.civil_Status'] = 'required';  
        $rules['member.cno'] = 'required'; 
        $rules['member.country'] = 'required'; 
        $rules['member.dob'] = 'required'; 
        $rules['member.emailAddress'] = ''; 
        $rules['member.gender'] = 'required';         
        $rules['member.houseNo'] = 'required'; 
        $rules['member.house_Stats'] = 'required'; 
        $rules['member.pob'] = 'required'; 
        $rules['member.province'] = 'required'; 
        $rules['member.yearsStay'] = 'required'; 
        $rules['member.zipCode'] = ''; 
        $rules['member.status'] = ''; 
        $rules['member.electricBill'] = 'required';
        $rules['member.waterBill'] = 'required';
        $rules['member.otherBills'] = 'required';
        $rules['member.dailyExpenses'] = 'required';
        $rules['member.jobDescription'] = isset($this->member['emp_Status']) ? ($this->member['emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['member.yos'] = isset($this->member['emp_Status']) ? ($this->member['emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['member.monthlySalary'] =  isset($this->member['emp_Status']) ? ($this->member['emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['member.otherSOC'] =  isset($this->member['emp_Status']) ? ($this->member['emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['member.bO_Status'] = 'required';
        $rules['member.companyName'] = isset($this->member['emp_Status']) ? ($this->member['emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['member.companyAddress'] =  isset($this->member['emp_Status']) ? ($this->member['emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['member.emp_Status'] = 'required';
        $rules['member.f_Fname'] = 'required';
        $rules['member.f_Lname'] = 'required';
        $rules['member.f_Mname'] = '';
        $rules['member.f_Suffix'] = '';
        $rules['member.f_DOB'] = 'required';
        $rules['member.f_Age'] = 'required';
        $rules['member.f_NOD'] = 'required';
        $rules['member.f_YOS'] = isset($this->member['f_Emp_Status']) ? ($this->member['f_Emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['member.f_Emp_Status'] = 'required';
        $rules['member.f_Job'] = isset($this->member['f_Emp_Status']) ? ($this->member['f_Emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['member.f_CompanyName'] = isset($this->member['f_Emp_Status']) ? ($this->member['f_Emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['member.f_RTTB'] = '';      
        $rules['member.loanAmount'] = 'required';
        $rules['member.termsOfPayment'] = 'required';
        $rules['member.purpose'] = 'required';
        $rules['member.profile'] = '';  
        $rules['imgprofile'] = isset($this->member['profile']) ? '' : 'required';  
        $rules['member.attachments'] = 'required'; 
        $rules['imgmemsign'] = isset($this->member['profile']) ? '' : 'required';  

        $rules['comaker.co_Fname'] = 'required';
        $rules['comaker.co_Lname'] = 'required';
        $rules['comaker.co_Mname'] = '';
        $rules['comaker.co_Suffix'] = '';
        $rules['comaker.co_Age'] = 'required';
        $rules['comaker.co_Barangay'] = 'required';
        $rules['comaker.co_City'] = 'required';
        $rules['comaker.co_Civil_Status'] = 'required';
        $rules['comaker.co_Cno'] = 'required';
        $rules['comaker.co_Country'] = 'required';
        $rules['comaker.co_DOB'] = 'required';
        $rules['comaker.co_EmailAddress'] = '';
        $rules['comaker.co_Gender'] = 'required';
        $rules['comaker.co_HouseNo'] = 'required';
        $rules['comaker.co_House_Stats'] = 'required';
        $rules['comaker.co_POB'] = 'required';
        $rules['comaker.co_Province'] = 'required';
        $rules['comaker.co_YearsStay'] = 'required';
        $rules['comaker.co_ZipCode'] = '';
        $rules['comaker.co_RTTB'] = 'required';
        $rules['comaker.co_Status'] = '';
        $rules['comaker.co_JobDescription'] = isset($this->comaker['co_Emp_Status']) ? ($this->comaker['co_Emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['comaker.co_YOS'] = isset($this->comaker['co_Emp_Status']) ? ($this->comaker['co_Emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['comaker.co_MonthlySalary'] = isset($this->comaker['co_Emp_Status']) ? ($this->comaker['co_Emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['comaker.co_OtherSOC'] = isset($this->comaker['co_Emp_Status']) ? ($this->comaker['co_Emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['comaker.co_BO_Status'] = 'required';
        $rules['comaker.co_CompanyName'] = isset($this->comaker['co_Emp_Status']) ? ($this->comaker['co_Emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['comaker.co_CompanyID'] = isset($this->comaker['co_Emp_Status']) ? ($this->comaker['co_Emp_Status'] == 0 ? '' : 'required') : 'required';
        $rules['comaker.co_Emp_Status'] = 'required';
        $rules['comaker.profile'] = '';  
        $rules['imgcoprofile'] = isset($this->comaker['profile']) ? '' : 'required';  
        $rules['comaker.attachments'] = 'required';  
        $rules['imgcosign'] = isset($this->comaker['profile']) ? '' : 'required';  
        // $rules['comaker.remarks'] = '';             
        

        if(isset($this->member['civil_Status'])){
            if($this->member['civil_Status'] == 'Married' || $this->member['civil_Status']=='Single'){
                if(count($this->cntmemchild) > 1){
                    foreach($this->cntmemchild as $cntchild){
                        $rules['inpchild.fname'.$cntchild] = 'required';   
                        $rules['inpchild.mname'.$cntchild] = '';      
                        $rules['inpchild.lname'.$cntchild] = 'required';      
                        $rules['inpchild.age'.$cntchild] = 'required';      
                        $rules['inpchild.school'.$cntchild] = 'required';                  
                    }            
                }
                else{
                    //if(isset($this->inpchild['fname1']) || isset($this->inpchild['mname1']) || isset($this->inpchild['lname1']) || isset($this->inpchild['age1']) || isset($this->inpchild['school1'])){
                    if((isset($this->inpchild['fname1']) ? $this->inpchild['fname1'] != '' : false)  || (isset($this->inpchild['mname1']) ? $this->inpchild['mname1'] != '' : false) || (isset($this->inpchild['lname1']) ? $this->inpchild['lname1'] != '' : false) || (isset($this->inpchild['age1']) ? $this->inpchild['age1'] != '' : false) || (isset($this->inpchild['school1']) ? $this->inpchild['school1'] != '' : false)){
                        $rules['inpchild.fname1'] = 'required';      
                        $rules['inpchild.mname1'] = '';      
                        $rules['inpchild.lname1'] = 'required';      
                        $rules['inpchild.age1'] = 'required';      
                        $rules['inpchild.school1'] = 'required';      
                    }
                }
            }
        }

        if($this->hasvehicle == 1){
            if(count($this->vehicle) > 0){
                foreach($this->vehicle as $key => $value){
                    $rules['inpvehicle.vehicle'.$key] = 'required';               
                }            
            }
        }

        if($this->hasproperties == 1){
            if(count($this->properties) > 0){
                foreach($this->properties as $key => $value){
                    $rules['inpproperties.property'.$key] = 'required';               
                }            
            }
        }  
    
        // public $bank = [];
        // public $inpbank;

        if(count($this->appliances) > 1){
            foreach($this->appliances as $key => $value){
                $rules['inpappliances.appliance'.$key] = 'required';               
                $rules['inpappliances.brand'.$key] = 'required';               
            }            
        }
        else{            
            if((isset($this->inpappliances['appliance1']) ? $this->inpappliances['appliance1'] != '' : false)  || (isset($this->inpappliances['brand1']) ? $this->inpappliances['brand1'] != '' : false)){
                $rules['inpappliances.appliance1'] = 'required';               
                $rules['inpappliances.brand1'] = 'required';   
            }
        }

        if(count($this->bank) > 1){
            foreach($this->bank as $key => $value){
                $rules['inpbank.account'.$key] = 'required';               
                $rules['inpbank.address'.$key] = 'required';               
            }            
        }
        else{            
            if((isset($this->inpbank['account1']) ? $this->inpbank['account1'] != '' : false)  || (isset($this->inpbank['address1']) ? $this->inpbank['address1'] != '' : false)){
                $rules['inpbank.account1'] = 'required';               
                $rules['inpbank.address1'] = 'required';   
            }
        }

        return  $rules;                                    
    }

    public function messages(){
        $messages = [];
        $messages['member.fname.required'] = 'Borrower first name is required';        
        $messages['member.lname.required'] = 'Borrower last name is required';             
        $messages['member.mname.required'] = 'Borrower middle name is required';  
        $messages['member.age.required'] = 'Borrower age is required';    
        $messages['member.barangay.required'] = 'Borrower barangay is required';  
        $messages['member.city.required'] = 'Borrower city is required';  
        $messages['member.civil_Status.required'] = 'Borrower civil status is required';  
        $messages['member.cno.required'] = 'Borrower contact number is required';  
        $messages['member.country.required'] = 'Borrower country is required';  
        $messages['member.dob.required'] = 'Borrower date of birth is required';  
        $messages['member.emailAddress.required'] = 'Borrower email is required';  
        $messages['member.gender.required'] = 'Borrower gender is required';            
        $messages['member.houseNo.required'] = 'Borrower house no. is required';            
        $messages['member.house_Stats.required'] = 'Borrower house stat is required';            
        $messages['member.pob.required'] = 'Borrower place of birth is required';            
        $messages['member.province.required'] = 'Borrower province is required';            
        $messages['member.yearsStay.required'] = 'Enter year of stay of borrower';            
        $messages['member.electricBill.required'] = 'Enter electric bill of borrower';  
        $messages['member.waterBill.required'] = 'Enter water bill of borrower';  
        $messages['member.otherBills.required'] = 'Enter other bills of borrower';  
        $messages['member.dailyExpenses.required'] = 'Enter daily expenses of borrower';  
        $messages['member.jobDescription.required'] = 'Enter job description of borrower';  
        $messages['member.yos.required'] = 'Enter years of service of borrower';  
        $messages['member.monthlySalary.required'] = 'Enter monthly salary of borrower';    
        $messages['member.otherSOC.required'] = 'Enter other source of income of borrower';
        $messages['member.bO_Status.required'] = 'Enter business status of borrower';
        $messages['member.companyName.required'] = 'Enter company name of borrower';
        $messages['member.companyAddress.required'] = 'Enter company address of borrower';
        $messages['member.emp_Status.required'] = 'Enter employment status of borrower';
        $messages['member.f_Fname.required'] = 'First name is required - borrower family info';
        $messages['member.f_Lname.required'] = 'Last name is required - borrower family info';
        $messages['member.f_Mname.required'] = 'Middle name is required - borrower family info';
        $messages['member.f_DOB.required'] = 'Enter date of birth';
        $messages['member.f_Age.required'] = 'Enter age';
        $messages['member.f_NOD.required'] = 'Enter number of dependants';
        $messages['member.f_YOS.required'] = 'Enter years of service';
        $messages['member.f_Emp_Status.required'] = 'Enter employment status';
        $messages['member.f_Job.required'] = 'Enter job description';
        $messages['member.f_CompanyName.required'] = 'Enter company name';
        $messages['member.loanAmount.required'] = 'Enter loan amount';
        $messages['member.termsOfPayment.required'] = 'Enter terms of payment';
        $messages['member.purpose.required'] = 'Enter purpose of loan';
        $messages['member.profile.required'] = 'Please insert picture of borrower';
        $messages['imgprofile'] = 'Please insert picture of borrower';
        $messages['member.attachments.required'] = 'Please include at least one documents referring to borrower';
        $messages['imgmemsign'] = 'Please insert signature image for member';

        $messages['comaker.co_Fname.required'] = 'Enter first name';
        $messages['comaker.co_Lname.required'] = 'Enter last name';
        $messages['comaker.co_Mname.required'] = 'Enter middle name';
        $messages['comaker.co_Barangay.required'] = 'Enter barangay';    
        $messages['comaker.co_Age.required'] = 'Enter age';    
        $messages['comaker.co_Civil_Status.required'] = 'Enter civil status';    
        $messages['comaker.co_City.required'] = 'Enter city';    
        $messages['comaker.co_Cno.required'] = 'Enter contact number';    
        $messages['comaker.co_Country.required'] = 'Enter country';    
        $messages['comaker.co_DOB.required'] = 'Enter date of birth';    
        $messages['comaker.co_EmailAddress.required'] = 'Enter email add';    
        $messages['comaker.co_Gender.required'] = 'Select gender';    
        $messages['comaker.co_HouseNo.required'] = 'Enter house no.';    
        $messages['comaker.co_House_Stats.required'] = 'Enter house status';    
        $messages['comaker.co_POB.required'] = 'Enter place of birth';    
        $messages['comaker.co_Province.required'] = 'Enter province';    
        $messages['comaker.co_YearsStay.required'] = 'Enter years of stay';    
        $messages['comaker.co_JobDescription.required'] = 'Enter job description';    
        $messages['comaker.co_YOS.required'] = 'Enter years of service';    
        $messages['comaker.co_MonthlySalary.required'] = 'Enter monthly salary';    
        $messages['comaker.co_OtherSOC.required'] = 'Enter other source of income'; 
        $messages['comaker.co_BO_Status.required'] = 'Enter business status';    
        $messages['comaker.co_CompanyName.required'] = 'Enter company name';    
        $messages['comaker.co_CompanyID.required'] = 'Enter company address';    
        $messages['comaker.co_Emp_Status.required'] = 'Enter employement status';   
        $messages['comaker.co_RTTB.required'] = 'Enter relationship to client';   
        $messages['imgcoprofile'] = 'Please insert picture of comaker';
        $messages['comaker.attachments.required'] = 'Please include at least one documents referring to comaker';
        $messages['imgcosign'] = 'Please insert signature image for co maker';

        $messages['loanDetails.loanAmount.required'] = 'Please enter loan amount'; 
        $messages['loanDetails.loanAmount.min'] = 'Loan amount must be greater that 0';
        $messages['loanDetails.loanAmount.numeric'] = 'Please enter a valid number';
        $messages['loanDetails.topId.required'] = 'Please select terms'; 

        $messages['loanDetails.notarialFee.required'] = 'Notarial fee is required'; 
        $messages['loanDetails.advancePayment.required'] = 'Advance payment is required';   
        $messages['loanDetails.total_InterestAmount.required'] = 'Interest amount is required'; 
        $messages['loanDetails.total_LoanReceivable.required'] = 'Receivable amount is required'; 
        $messages['loanDetails.dailyCollectibles.required'] = 'Daily amount due is required'; 
        
        $messages['loanDetails.notarialFee.numeric'] = 'Notarial fee must be a number'; 
        $messages['loanDetails.advancePayment.numeric'] = 'Advance payment must be a number';   
        $messages['loanDetails.total_InterestAmount.numeric'] = 'Interest amount must be a number'; 
        $messages['loanDetails.total_LoanReceivable.numeric'] = 'Receivable amount must be a number'; 
        $messages['loanDetails.dailyCollectibles.numeric'] = 'Daily amount due must be a number'; 

        $messages['loanDetails.notarialFee.min'] = 'Notarial fee must not be negative'; 
        $messages['loanDetails.advancePayment.min'] = 'Advance payment must not be negative';   
        $messages['loanDetails.total_InterestAmount.min'] = 'Interest amount must be greater than 1'; 
        $messages['loanDetails.total_LoanReceivable.min'] = 'Receivable amount must be greater than 1'; 
        $messages['loanDetails.dailyCollectibles.min'] = 'Daily amount due must be greater than 1'; 
        
        $messages['loanDetails.modeOfRelease.required'] = 'Please select mode of release'; 
        $messages['loanDetails.denomination.required'] = 'Please select denomination'; 
        $messages['loanDetails.savingsToUse.required'] = 'Please select savings to be used'; 
        $messages['loanDetails.courier.required'] = 'Please select courrier'; 
        $messages['loanDetails.couriercno.required'] = 'Please enter contact number'; 
        $messages['loanDetails.courierclient.required'] = 'Please enter client name'; 
        $messages['loanDetails.courieremployee.required'] = 'Please select employee'; 


        if(isset($this->member['civil_Status'])){
            if($this->member['civil_Status'] == 'Married' || $this->member['civil_Status']=='Single'){
                if(count($this->cntmemchild) > 1){
                    foreach($this->cntmemchild as $cntchild){
                        $messages['inpchild.fname'.$cntchild.'.required'] = 'Enter first name'; 
                        $messages['inpchild.mname'.$cntchild.'.required'] = 'Enter middle name'; 
                        $messages['inpchild.lname'.$cntchild.'.required'] = 'Enter last name'; 
                        $messages['inpchild.age'.$cntchild.'.required'] = 'Enter age'; 
                        $messages['inpchild.school'.$cntchild.'.required'] = 'Enter school';                                     
                    }            
                }
                else{
                    //if(isset($this->inpchild['fname1']) || isset($this->inpchild['mname1']) || isset($this->inpchild['lname1']) || isset($this->inpchild['age1']) || isset($this->inpchild['school1'])){
                    if((isset($this->inpchild['fname1']) ? $this->inpchild['fname1'] != '' : false)  || (isset($this->inpchild['mname1']) ? $this->inpchild['mname1'] != '' : false) || (isset($this->inpchild['lname1']) ? $this->inpchild['lname1'] != '' : false) || (isset($this->inpchild['age1']) ? $this->inpchild['age1'] != '' : false) || (isset($this->inpchild['school1']) ? $this->inpchild['school1'] != '' : false)){
                        $messages['inpchild.fname1.required'] = 'Enter first name'; 
                        $messages['inpchild.mname1.required'] = 'Enter middle name'; 
                        $messages['inpchild.lname1.required'] = 'Enter last name'; 
                        $messages['inpchild.age1.required'] = 'Enter age'; 
                        $messages['inpchild.school1.required'] = 'Enter school';                  
                    }
                }
            }
        }

        if($this->hasvehicle == 1){
            if(count($this->vehicle) > 0){
                foreach($this->vehicle as $key => $value){                   
                    $messages['inpvehicle.vehicle'.$key.'.required'] = 'Enter vehicle description';      
                }            
            }
        }

        if($this->hasproperties == 1){
            if(count($this->properties) > 0){
                foreach($this->properties as $key => $value){                    
                    $messages['inpproperties.property'.$key.'.required'] = 'Enter property description';                  
                }            
            }
        }  
    
        // public $bank = [];
        // public $inpbank;

        if(count($this->appliances) > 1){
            foreach($this->appliances as $key => $value){                     
                $messages['inpappliances.appliance'.$key.'.required'] = 'Enter appliance name';      
                $messages['inpappliances.brand'.$key.'.required'] = 'Enter brand';             
            }            
        }
        else{            
            if((isset($this->inpappliances['appliance1']) ? $this->inpappliances['appliance1'] != '' : false)  || (isset($this->inpappliances['brand1']) ? $this->inpappliances['brand1'] != '' : false)){               
                $messages['inpappliances.appliance1.required'] = 'Enter appliance name';      
                $messages['inpappliances.brand1.required'] = 'Enter brand';        
            }
        }

        if(count($this->bank) > 1){
            foreach($this->bank as $key => $value){              
                $messages['inpbank.account'.$key.'.required'] = 'Enter bank account';      
                $messages['inpbank.address'.$key.'.required'] = 'Enter bank address';                        
            }            
        }
        else{            
            if((isset($this->inpbank['account1']) ? $this->inpbank['account1'] != '' : false)  || (isset($this->inpbank['address1']) ? $this->inpbank['address1'] != '' : false)){              
                $messages['inpbank.account1.required'] = 'Enter bank account';      
                $messages['inpbank.address1.required'] = 'Enter bank address';          
            }
        }

        // 'membusinfo.businessName' => ['required'],
        //                             'membusinfo.businessType' => ['required'],
        //                             'membusinfo.businessAddress' => ['required'],                                   
        //                             'membusinfo.b_status' => ['required'],
        //                             'membusinfo.yob' => ['required'],
        //                             'membusinfo.noe' => ['required'],
        //                             'membusinfo.salary' => ['required'],
        //                             'membusinfo.vos' => ['required'],
        //                             'membusinfo.aos' => ['required'],

        $messages['membusinfo.businessName.required'] = 'Business name is required';
        $messages['membusinfo.businessType.required'] = 'Business type is required';
        $messages['membusinfo.businessAddress.required'] = 'Address is required';
        $messages['membusinfo.b_status.required'] = 'Status is required';
        $messages['membusinfo.yob.required'] = 'Year of business is required';
        $messages['membusinfo.noe.required'] = 'No. of employee is required';
        $messages['membusinfo.salary.required'] = 'Salary amount is required';
        $messages['membusinfo.vos.required'] = 'Value of stocks is required';
        $messages['membusinfo.aos.required'] = 'Amount of sales is required';
        $messages['membusinfo.attachments.required'] = 'Attachements are required';

        $messages['reason.required'] = 'Enter reason for declining';

        return $messages;        
    }

    public function clearJobInfo(){
        if(isset($this->member['emp_Status'])){
            if($this->member['emp_Status'] == 0){
                $this->member['jobDescription'] = '';
                $this->member['yos'] = '';
                $this->member['companyName'] = '';
                $this->member['companyAddress'] = '';
                $this->member['monthlySalary'] = '';
                $this->member['otherSOC'] = '';
            }
        }
    }

    
    public function clearComakerJobInfo(){
        if(isset($this->comaker['co_Emp_Status'])){
            if($this->comaker['co_Emp_Status'] == 0){
                $this->comaker['co_JobDescription'] = '';
                $this->comaker['co_YOS'] = '';
                $this->comaker['co_CompanyName'] = '';
                $this->comaker['co_CompanyID'] = '';
                $this->comaker['co_MonthlySalary'] = '';
                $this->comaker['co_OtherSOC'] = '';
            }
        }
    }

    public function clearFJobInfo(){
        if(isset($this->member['f_Emp_Status'])){
            if($this->member['f_Emp_Status'] == 0){
                $this->member['f_Job'] = '';
                $this->member['f_YOS'] = '';
                $this->member['f_CompanyName'] = '';              
            }
        }
    }

    public function storeProfileImage(){           
        $profilename = '';
        if($this->imgprofile){
            $deletefiles = [];
            if(isset($this->member['profile'])){
                $deletefiles[] = 'public/members_profile/'.$this->member['profile'];
            }
            Storage::delete($deletefiles);       
            
            $time = time();          
            $profilename = 'members_profile_'.$time.'.'.$this->imgprofile->getClientOriginalExtension();         
            $this->imgprofile->storeAs('public/members_profile', $profilename);    
        }
        else{
            $profilename = $this->member['profile'];  
        }  
        return $profilename;       
    }

    public function storeCoProfileImage(){           
        $profilename = '';
        if($this->imgcoprofile){
            $deletefiles = [];
            if(isset($this->comaker['profile'])){
                $deletefiles[] = 'public/comakers_profile/'.$this->comaker['profile'];
            }
            Storage::delete($deletefiles);       
            
            $time = time();          
            $profilename = 'comakers_profile'.$time.'.'.$this->imgcoprofile->getClientOriginalExtension();         
            $this->imgcoprofile->storeAs('public/comakers_profile', $profilename);    
        }
        else{
            $profilename = $this->comaker['profile'];  
        }  
        return $profilename;       
    }
    
    public function storeAttachments(){
        $memattachements = [];      
        if($this->member['attachments'] == $this->member['old_attachments']){
            $memattachements = $this->member['attachments'];
        }
        else{            
            if(isset($this->member['attachments'])){    
                $deletefiles = [];
                if(isset($this->member['old_attachments'])){
                    foreach($this->member['old_attachments'] as $oldfiles){
                        $deletefiles[] = 'public/members_attachments/'.$oldfiles['filePath'];
                    }
                }
                Storage::delete($deletefiles);       
                foreach ($this->member['attachments'] as $attachments) {
                    $time = time();
                    $filename = 'members_attachments_'.$time.'_'.$attachments->getClientOriginalName();
                    $attachments->storeAs('public/members_attachments', $filename);   
                    $memattachements[] = [ 'fileName' => $filename , 'filePath' => $filename ];
                }
            }
        }

        return $memattachements;
        //
        
    }

    public function storeCoAttachments(){
        if($this->comaker['attachments'] == $this->comaker['old_attachments']){
            $memattachements = $this->comaker['attachments'];
        }
        else{            
            if(isset($this->comaker['attachments'])){    
                $deletefiles = [];
                if(isset($this->comaker['old_attachments'])){
                    foreach($this->comaker['old_attachments'] as $oldfiles){
                        $deletefiles[] = 'public/comakers_attachments/'.$oldfiles['filePath'];
                    }
                }
                Storage::delete($deletefiles);       
                foreach ($this->comaker['attachments'] as $attachments) {
                    $time = time();
                    $filename = 'comakers_attachments_'.$time.'_'.$attachments->getClientOriginalName();
                    $attachments->storeAs('public/comakers_attachments', $filename);   
                    $memattachements[] = [ 'fileName' => $filename , 'filePath' => $filename ];
                }
            }
        }
        return $memattachements;
    }

    public function storeSignature(){           
        $profilename = '';
        if($this->imgmemsign){
            $deletefiles = [];
            if(isset($this->member['signature'])){
                $deletefiles[] = 'public/members_signature/'.$this->member['signature'];
            }
            Storage::delete($deletefiles);       
            
            $time = time();          
            $profilename = 'members_signature_'.$time.'.'.$this->imgmemsign->getClientOriginalExtension();         
            $this->imgmemsign->storeAs('public/members_signature', $profilename);    
        }
        else{
            $profilename = $this->member['signature'];  
        }  
        return $profilename;       
    }

    public function storeCoSignature(){           
        $profilename = '';
        if($this->imgcosign){
            $deletefiles = [];
            if(isset($this->comaker['signature'])){
                $deletefiles[] = 'public/comakers_signature/'.$this->comaker['signature'];
            }
            Storage::delete($deletefiles);       
            
            $time = time();          
            $profilename = 'comakers_signature_'.$time.'.'.$this->imgcosign->getClientOriginalExtension();         
            $this->imgcosign->storeAs('public/comakers_signature', $profilename);    
        }
        else{
            $profilename = $this->comaker['signature'];  
        }  
        return $profilename;       
    }

    public function archive($naID){      
        $delete = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Application/DeleteApplication', ['naid' => $naID]);                                               
        return redirect()->to('/tranactions/application/list')->with('mmessage', 'Application has been deleted');  
    }

    public function restore($naID){        
        $restore = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Application/RestoreApplication', ['naid' => $naID]);                                               
        return redirect()->to('/tranactions/trashed/application/list')->with('mmessage', 'Application has been restore');  
    }

    public function saving($type = 1){        
        $data = [
            'fname'=> $this->member['fname'] ??= '',
            'mname'=> $this->member['mname'] ??= '',
            'lname'=> $this->member['lname'] ??= '',
            'pob'=> $this->member['pob'] ??= '',
            'barangay'=> $this->member['barangay'] ??= '',
            'dob'=> $this->member['dob'] ??= '',
            'age'=> $this->member['age'] ??= '',
        ];
        $checkmem = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/Member_PromptExistingLoan', $data);                                               
        $checkmem = $checkmem->body();        
        if($checkmem == 'Member has a Existing Loans'){  
            session()->flash('EXISTINGMEMBERTYPE', $type);         
            session()->flash('EXISTINGMEMBER', $checkmem);        
        }
        else{
            $this->store($type);
        }
        //$this->store($type);
    }


    public function store($type = 1){               
        try {                        
            $this->resetValidation();          
            $input = $this->validate();     
            $childs = [];
            $businesses = [];
            $appliances = [];
            $banks = [];
            $assets = [];
            $properties = [];

            if($this->hasvehicle == 1){
                if(count($this->vehicle) > 0){
                    foreach($this->vehicle as $key => $value){                   
                        $assets[] = [ 'motorVehicles' => $this->inpvehicle['vehicle'.$key] ];  
                    }            
                }
            }
    
            if($this->hasproperties == 1){
                if(count($this->properties) > 0){
                    foreach($this->properties as $key => $value){                    
                        $properties[] = [ 'property' => $this->inpproperties['property'.$key] ];                
                    }            
                }
            }  
         
            if(count($this->cntmemchild) > 0){
                if((isset($this->inpchild['fname1']) ? $this->inpchild['fname1'] != '' : false)  || (isset($this->inpchild['mname1']) ? $this->inpchild['mname1'] != '' : false) || (isset($this->inpchild['lname1']) ? $this->inpchild['lname1'] != '' : false) || (isset($this->inpchild['age1']) ? $this->inpchild['age1'] != '' : false) || (isset($this->inpchild['school1']) ? $this->inpchild['school1'] != '' : false)){
                    foreach($this->cntmemchild as $cntmemchild){
                        $childs[] = [   'fname' => $this->inpchild['fname'.$cntmemchild] ??= '', 
                                        'mname' => $this->inpchild['mname'.$cntmemchild] ??= '',
                                        'lname' => $this->inpchild['lname'.$cntmemchild] ??= '',
                                        'age' => $this->inpchild['age'.$cntmemchild] ??= '0',
                                        'nos' => $this->inpchild['school'.$cntmemchild] ??= '',
                                        'famId' => null,    ];
                    }
                }
            }
           
            if(count( $this->businfo) > 0){
                foreach($this->businfo as $key => $value){
                    $businesses[] = [   'businessName' => $value['businessName'], 
                                        'businessType' => $value['businessType'],
                                        'businessAddress' => $value['businessAddress'],
                                        'b_status' => $value['b_status'],
                                        'yob' => $value['yob'],
                                        'noe' => $value['noe'],
                                        'salary' => $value['salary'],
                                        'vos' => $value['vos'],
                                        'aos' => $value['aos'],
                                        'businessFiles' => $this->storeBusinessInfoAttachments( $value['old_attachments'], $value['attachments'] )  
                                    ];
                }
            }

            if(count( $this->appliances) > 0){
                if((isset($this->inpappliances['appliance1']) ? $this->inpappliances['appliance1'] != '' : false)  || (isset($this->inpappliances['brand1']) ? $this->inpappliances['brand1'] != '' : false)){
                    foreach($this->appliances as $key => $value){
                        $appliances[] = [   'brand' => $this->inpappliances['brand'.$key], 
                                            'appliances' => $this->inpappliances['appliance'.$key],
                                            'naid' => ''   ];
                    }
                }               
            }

            if(count( $this->bank) > 0){
                if((isset($this->inpbank['account1']) ? $this->inpbank['account1'] != '' : false)  || (isset($this->inpbank['address1']) ? $this->inpbank['address1'] != '' : false)){
                    foreach($this->bank as $key => $value){
                        $banks[] = [   'bankName' => $this->inpbank['account'.$key], 
                                    'address' => $this->inpbank['address'.$key]   ];
                    }
                }
            }

            // $profilename = '';
            // if(isset($this->member['profile'])){
            //     $time = time();
            //     $profilename = 'members_profile_'.$time;
            //     $this->member['profile']->storeAs('public/members_profile', $profilename);   
            //     // $profileimages = [ [ 'additionalProp1' => [$profilename] ] ]; 
            //     // $upprofile = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/UploadProfileImage', $profileimages);              
            // }          
            
            // $memattachements = [];
            // if(isset($this->member['attachments'])){
            //     //dd( $this->member['attachments'] );
            //     foreach ($this->member['attachments'] as $attachments) {
            //         $time = time();
            //         $filename = 'members_attachments_'.$time.'_'.$attachments->getClientOriginalName();
            //         $attachments->storeAs('public/members_attachments', $filename);   
            //         $memattachements[] = [ 'fileName' =>  $filename, 'filePath' => $filename ];
            //     }
            // }           

            $data = [[          "fname"=> $input['member']['fname'] ??= '',
                                "lname"=> $input['member']['lname'] ??= '',
                                "mname"=> $input['member']['mname'] ??= '',
                                "suffix"=> $input['member']['suffix'] ??= '',
                                "age"=> $input['member']['age'] ??= '0',
                                "barangay"=> $input['member']['barangay'] ??= '',
                                "city"=> $input['member']['city'] ??= '',
                                "civil_Status"=> $input['member']['civil_Status'] ??= 'Single',
                                "cno"=> $input['member']['cno'] ??= '',
                                "country"=> $input['member']['country'] ??= '',
                                "dob"=> $input['member']['dob'] ??= null, //not saving if null or blank
                                "emailAddress"=> $input['member']['emailAddress'] ??= '',
                                "gender"=> $input['member']['gender'] ??= '',
                                "houseNo"=> $input['member']['houseNo'] ??= '',
                                "house_Stats"=> $input['member']['house_Stats'] ??= '0',
                                "pob"=> $input['member']['pob'] ??= '',
                                "province"=> $input['member']['province'] ??= '',
                                "yearsStay"=> $input['member']['yearsStay'] ??= '0',
                                "zipCode"=> $input['member']['zipCode'] ??= '',
                                "status"=> '1',
                                "dateCreated"=> null,
                                "dateUpdated"=> null,
                                "memId"=> null,
                                "electricBill"=> $input['member']['electricBill'] ??= '0',
                                "waterBill"=> $input['member']['waterBill'] ??= '0',
                                "otherBills"=> $input['member']['otherBills'] ??= '0',
                                "dailyExpenses"=> $input['member']['dailyExpenses'] ??= '0',
                                "jobDescription"=> $input['member']['jobDescription'] ??= '',
                                "yos"=> !empty($input['member']['yos']) ? $input['member']['yos'] : '0',
                                "monthlySalary"=> !empty($input['member']['monthlySalary']) ? $input['member']['monthlySalary'] : '0',
                                "otherSOC"=> $input['member']['otherSOC'] ??= '',
                                "bO_Status"=> $input['member']['bO_Status'] ??= '0',
                                "companyName"=> $input['member']['companyName'] ??= '',
                                "companyAddress"=> $input['member']['companyAddress'] ??= '',
                                "emp_Status"=> $input['member']['emp_Status'] ??= '0',
                                "f_Fname"=> $input['member']['f_Fname'] ??= '',
                                "f_Lname"=> $input['member']['f_Lname'] ??= '',
                                "f_Mname"=> $input['member']['f_Mname'] ??= '',
                                "f_Suffix"=> $input['member']['f_Suffix'] ??= '',
                                "f_DOB"=> $input['member']['f_DOB'] ??= null,
                                "f_Age"=> $input['member']['f_Age'] ??= '0',
                                "f_NOD"=> $input['member']['f_NOD'] ??= '0',
                                "f_YOS"=> !empty($input['member']['f_YOS']) ? $input['member']['f_YOS'] : '0',
                                "f_Emp_Status"=>  $input['member']['f_Emp_Status'] ??= '0',
                                "f_Job"=> $input['member']['f_Job'] ??= '',
                                "f_CompanyName"=> $input['member']['f_CompanyName'] ??= '',
                                "f_RTTB"=> '', 
                                "famId"=> "string", ///check if caused error not exist latest working
                                "business"=> $businesses,
                                "loanAmount"=> $input['member']['loanAmount'] ??= '0',
                                'loanTypeId' => $this->loanDetails['loanTypeID'],
                                "termsOfPayment"=> $this->loanDetails['loantermsID'] ??= '',
                                "purpose"=> $input['member']['purpose'] ??= '',
                                "child"=> $childs,
                                "appliances"=> $appliances,
                                "property"=> $properties,
                                "assets"=> $assets,
                                "bank"=> $banks,
                                "co_Fname"=> $input['comaker']['co_Fname'] ??= '',
                                "co_Lname"=> $input['comaker']['co_Lname'] ??= '',
                                "co_Mname"=> $input['comaker']['co_Mname'] ??= '',
                                "co_Suffix"=> $input['comaker']['co_Suffix'] ??= '',
                                "co_Age"=> $input['comaker']['co_Age'] ??= '0',
                                "co_Barangay"=> $input['comaker']['co_Barangay'] ??= '',
                                "co_City"=> $input['comaker']['co_City'] ??= '',
                                "co_Civil_Status"=> $input['comaker']['co_Civil_Status'] ??= '',
                                "co_Cno"=> $input['comaker']['co_Cno'] ??= '',
                                "co_Country"=> $input['comaker']['co_Country'] ??= '',
                                "co_DOB"=>  $input['comaker']['co_DOB'] ??= null,
                                "co_EmailAddress"=> $input['comaker']['co_EmailAddress'] ??= '',
                                "co_Gender"=> $input['comaker']['co_Gender'] ??= '',
                                "co_HouseNo"=> $input['comaker']['co_HouseNo'] ??= '',
                                "co_House_Stats"=> $input['comaker']['co_House_Stats'] ??= '0',
                                "co_POB"=> $input['comaker']['co_POB'] ??= '',
                                "co_Province"=> $input['comaker']['co_Province'] ??= '',
                                "co_YearsStay"=> $input['comaker']['co_YearsStay'] ??= '0',
                                "co_ZipCode"=> $input['comaker']['co_ZipCode'] ??= '',
                                "co_RTTB"=> $input['comaker']['co_RTTB'] ??= '',
                                "co_Status"=> '1',
                                "co_JobDescription"=> $input['comaker']['co_JobDescription'] ??= '',
                                "co_YOS"=> !empty($input['comaker']['co_YOS'] ??= '0') ? $input['comaker']['co_YOS'] ??= '0' : '0',
                                "co_MonthlySalary"=> !empty($input['comaker']['co_MonthlySalary']) ? $input['comaker']['co_MonthlySalary'] : '0',
                                "co_OtherSOC"=> $input['comaker']['co_OtherSOC'] ??= '',
                                "co_BO_Status"=> $input['comaker']['co_BO_Status'] ??= '0',
                                "co_CompanyName"=> $input['comaker']['co_CompanyName'] ??= '',
                                "co_CompanyAddress"=>  $input['comaker']['co_CompanyID'] ??= '',///check if caused error not exist latest working
                                "co_CompanyID"=> $input['comaker']['co_CompanyID'] ??= '',
                                "co_Emp_Status"=> $input['comaker']['co_Emp_Status'] ??= '0', //'1', //$input['comaker']['co_Emp_Status'],
                                "remarks"=> '',
                                "applicationStatus" => $type == 1 ? 7 : 8,
                                "profileName"=> $this->storeProfileImage(),
                                "profileFilePath"=> $this->storeProfileImage(),
                                "co_ProfileName"=> $this->storeCoProfileImage(),
                                "co_ProfileFilePath"=> $this->storeCoProfileImage(),
                                "requirementsFile"=> $this->storeAttachments(),                                                                                   
                                "signatureUpload"=> [
                                    [
                                      "fileName"=> $this->storeSignature(),
                                      "filePath"=> $this->storeSignature()
                                    ]
                                  ],
                                  "co_RequirementsFile"=> $this->storeCoAttachments(),
                                  "co_SignatureUpload"=> [
                                    [
                                      "fileName"=> $this->storeCoSignature(),
                                      "filePath"=> $this->storeCoSignature()
                                    ]
                                  ],
                                  "userId"=> session()->get('auth_userid'),
                                  "naid"=>  $this->naID
                    ]];
      
                    //$extension = $request->file('filename')->getClientOriginalExtension();
                    //dd( $data );       
            if($this->type == 'create'){                            
                $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/SaveAll', $data); 
                //dd($crt);                                                                                    
                $apiresp = $crt->getStatusCode();                
                if($apiresp == 200){                         
                    if($crt->json()['status'] == 'ERROR'){
                        session()->flash('errmmessage', $crt->json()['result']);        
                    }   
                    else{         
                        // $getlast = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Application/GetLastApplication');                                
                        // $getlast = $getlast->json();
                        //dd($getlast);   
                        // $modules = session()->get('auth_usermodules');
                        // $usertype = session()->get('auth_usertype'); 

                        // if(in_array('Module-09', $modules) || in_array($usertype, [1,2])){
                        //     $this->resetValidation();         
                        //     return redirect()->to('/tranactions/application/view/'.$crt->json()['naid'])->with(['mmessage'=> 'Application successfully saved', 'mword'=> 'Success']);    
                        // }
                        // else{
                        //     $this->resetValidation();         
                        //     return redirect()->to('/tranactions/application/list')->with(['mmessage'=> 'Application successfully saved', 'mword'=> 'Success']);    
                        // }

                        $this->resetValidation();         
                        return redirect()->to('/tranactions/application/view/'.$crt->json()['naid'])->with(['mmessage'=> 'Application successfully saved', 'mword'=> 'Success']);    
                    }
                }
                else{
                    $this->resetValidation();         
                    session()->flash('erroraction', 'saving(1)');                   
                    $this->emit('EMIT_ERROR_ASKING_DIALOG');
                }
            }
            else{              
                $membersongroup = session('memdata') !==null ? session('memdata') : [];
                $errorcount = 0;
                if(count($membersongroup) > 0){
                    foreach($membersongroup as $mem){                        
                        if( $mem['fname'] == $input['member']['fname']){
                            $errorcount = $errorcount + 1;                           
                        }
                    }
                }
               
                if($errorcount > 0){
                    session()->flash('errmmessage', 'Member already exist in group');
                }
                else{
                    session()->push('memdata', $data[0]);
                    return redirect()->to('/tranactions/group/application/create');
                }
            }
        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }
   
    public function storeBusinessInfoAttachments($oldattachments, $businessattachments){
        $memattachements = [];            
        if($businessattachments == $oldattachments){
            $memattachements = $businessattachments;
        }
        else{            
            if(isset($businessattachments)){    
                $deletefiles = [];
                if(isset($oldattachments)){
                    foreach($oldattachments as $oldfiles){
                        $deletefiles[] = 'public/business_attachments/'.$oldfiles['filePath'];
                    }
                }
                Storage::delete($deletefiles);       
                foreach ($businessattachments as $attachments) {
                    $time = time();
                    $filename = 'business_attachments_'.$time.'_'.$attachments->getClientOriginalName();
                    $attachments->storeAs('public/business_attachments', $filename);   
                    $memattachements[] = [ 'filePath' => $filename , 'fileName' => $filename, 'fileType' => $filename ];
                }
            }
        }
        return $memattachements;
    }

    public function update($type = 7){             
        try {                                  
            $this->resetValidation();          
            $input = $this->validate();          
            $childs = [];
            $businesses = [];
            $appliances = [];
            $banks = [];
            $assets = [];
            $properties = [];
         
            if(count($this->cntmemchild) > 0){
                if((isset($this->inpchild['fname1']) ? $this->inpchild['fname1'] != '' : false)  || (isset($this->inpchild['mname1']) ? $this->inpchild['mname1'] != '' : false) || (isset($this->inpchild['lname1']) ? $this->inpchild['lname1'] != '' : false) || (isset($this->inpchild['age1']) ? $this->inpchild['age1'] != '' : false) || (isset($this->inpchild['school1']) ? $this->inpchild['school1'] != '' : false)){
                    foreach($this->cntmemchild as $cntmemchild){
                        $childs[] = [   'fname' => $this->inpchild['fname'.$cntmemchild] ??= '', 
                                        'mname' => $this->inpchild['mname'.$cntmemchild] ??= '',
                                        'lname' => $this->inpchild['lname'.$cntmemchild] ??= '',
                                        'age' => $this->inpchild['age'.$cntmemchild] ??= '0',
                                        'nos' => $this->inpchild['school'.$cntmemchild] ??= '',
                                        'famId' => null,    ];
                    }
                }
            }
           
           
            if(count( $this->businfo) > 0){          
                foreach($this->businfo as $key => $value){
                    
                    $businesses[] = [   
                                        'businessName' => $value['businessName'], 
                                        'businessType' => $value['businessType'],
                                        'businessAddress' => $value['businessAddress'],
                                        'b_status' => 1, //$value['b_status'], error
                                        'yob' => $value['yob'],
                                        'noe' => $value['noe'],
                                        'salary' => $value['salary'],
                                        'vos' => $value['vos'],
                                        'aos' => $value['aos'],   
                                        'businessFiles' => $this->storeBusinessInfoAttachments( $value['old_attachments'], $value['attachments'] )
                                    ];
                }
            }  

            if(count( $this->appliances) > 0){
                if((isset($this->inpappliances['appliance1']) ? $this->inpappliances['appliance1'] != '' : false)  || (isset($this->inpappliances['brand1']) ? $this->inpappliances['brand1'] != '' : false)){
                    foreach($this->appliances as $key => $value){
                        $appliances[] = [   'brand' => $this->inpappliances['brand'.$key], 
                                            'appliances' => $this->inpappliances['appliance'.$key],
                                            'naid' => ''   ];
                    }
                }               
            }

            if(count( $this->bank) > 0){
                if((isset($this->inpbank['account1']) ? $this->inpbank['account1'] != '' : false)  || (isset($this->inpbank['address1']) ? $this->inpbank['address1'] != '' : false)){
                    foreach($this->bank as $key => $value){
                        $banks[] = [   'bankName' => $this->inpbank['account'.$key], 
                                    'address' => $this->inpbank['address'.$key]   ];
                    }
                }
            }

            /////////////////////////
            if($this->hasvehicle == 1){
                if(count($this->vehicle) > 0){
                    foreach($this->vehicle as $key => $value){                   
                        $assets[] = [ 'motorVehicles' => $this->inpvehicle['vehicle'.$key] ];  
                    }            
                }
            }
    
            if($this->hasproperties == 1){
                if(count($this->properties) > 0){
                    foreach($this->properties as $key => $value){                    
                        $properties[] = [ 'property' => $this->inpproperties['property'.$key] ];                
                    }            
                }
            }                      
            /////////////////////////

            $bdate = date('Y-m-d', strtotime($input['member']['dob']));            
            $data = [
                        [
                            "fname"=> $input['member']['fname'] ??= '',
                            "lname"=> $input['member']['lname'] ??= '',
                            "mname"=> $input['member']['mname'] ??= '',
                            "suffix"=> $input['member']['suffix'] ??= '',
                            "age"=> $input['member']['age'] ??= '0',
                            "barangay"=> $input['member']['barangay'] ??= '',
                            "city"=> $input['member']['city'] ??= '',
                            "civil_Status"=> $input['member']['civil_Status'] ??= 'Single',
                            "cno"=> $input['member']['cno'] ??= '',
                            "country"=> $input['member']['country'] ??= '',
                            "dob"=>  $bdate ??= null, //not saving if null or blank
                            "emailAddress"=> $input['member']['emailAddress'] ??= '',
                            "gender"=> $input['member']['gender'] ??= '',
                            "houseNo"=> $input['member']['houseNo'] ??= '',
                            "house_Stats"=> $input['member']['house_Stats'] ??= '0',
                            "pob"=> $input['member']['pob'] ??= '',
                            "province"=> $input['member']['province'] ??= '',
                            "yearsStay"=> $input['member']['yearsStay'] ??= '0',
                            "zipCode"=> $input['member']['zipCode'] ??= '',
                            "status"=> '1',
                            "dateCreated"=> null,
                            "dateUpdated"=> null,
                            "memId"=> $this->searchedmemId,
                            "electricBill"=> $input['member']['electricBill'] ??= '0',
                            "waterBill"=> $input['member']['waterBill'] ??= '0',
                            "otherBills"=> $input['member']['otherBills'] ??= '0',
                            "dailyExpenses"=> $input['member']['dailyExpenses'] ??= '0',
                            "jobDescription"=> $input['member']['jobDescription'] ??= '',
                            "yos"=> !empty($input['member']['yos']) ? $input['member']['yos'] : '0',
                            "monthlySalary"=> !empty($input['member']['monthlySalary']) ? $input['member']['monthlySalary'] : '0',
                            "otherSOC"=> $input['member']['otherSOC'] ??= '',
                            "bO_Status"=> $input['member']['bO_Status'] ??= '0', //mali
                            "companyName"=> $input['member']['companyName'] ??= '',
                            "companyAddress"=> $input['member']['companyAddress'] ??= '',
                            "emp_Status"=> $input['member']['emp_Status'] ??= '0',
                            "f_Fname"=> $input['member']['f_Fname'] ??= '',
                            "f_Lname"=> $input['member']['f_Lname'] ??= '',
                            "f_Mname"=> $input['member']['f_Mname'] ??= '',
                            "f_Suffix"=> $input['member']['f_Suffix'] ??= '',
                            "f_DOB"=>  $input['member']['f_DOB'] ??= null,
                            "f_Age"=> $input['member']['f_Age'] ??= '0',
                            "f_NOD"=> $input['member']['f_NOD'] ??= '0',
                            "f_YOS"=> !empty($input['member']['f_YOS']) ? $input['member']['f_YOS'] : '0',
                            "f_Emp_Status"=> $input['member']['f_Emp_Status'] ??= '0',
                            "f_Job"=> $input['member']['f_Job'] ??= '',
                            "f_CompanyName"=> $input['member']['f_CompanyName'] ??= '',
                            "f_RTTB"=> '',
                            "famId"=> $this->member['famId'], 
                            "business"=> $businesses,
                            "loanAmount"=> $input['member']['loanAmount'] ??= '0',
                            'loanTypeId' => $this->loanDetails['loanTypeID'],
                            "termsOfPayment"=>  $this->loanDetails['loantermsID'] ??= '',
                            "purpose"=> $input['member']['purpose'] ??= '',
                            "child"=> $childs,
                            "appliances"=> $appliances,                           
                            "assets"=> $assets,
                            "property"=> $properties,
                            "bank"=> $banks,
                            "co_Fname"=> $input['comaker']['co_Fname'] ??= '',
                            "co_Lname"=> $input['comaker']['co_Lname'] ??= '',
                            "co_Mname"=> $input['comaker']['co_Mname'] ??= '',
                            "co_Suffix"=> $input['comaker']['co_Suffix'] ??= '',
                            "co_Age"=> $input['comaker']['co_Age'] ??= '0',
                            "co_Barangay"=> $input['comaker']['co_Barangay'] ??= '',
                            "co_City"=> $input['comaker']['co_City'] ??= '',
                            "co_Civil_Status"=> $input['comaker']['co_Civil_Status'] ??= '',
                            "co_Cno"=> $input['comaker']['co_Cno'] ??= '',
                            "co_Country"=> $input['comaker']['co_Country'] ??= '',
                            "co_DOB"=>  $input['comaker']['co_DOB'] ??= null,
                            "co_EmailAddress"=> $input['comaker']['co_EmailAddress'] ??= '',
                            "co_Gender"=> $input['comaker']['co_Gender'] ??= '',
                            "co_HouseNo"=> $input['comaker']['co_HouseNo'] ??= '',
                            "co_House_Stats"=> $input['comaker']['co_House_Stats'] ??= '0',
                            "co_POB"=> $input['comaker']['co_POB'] ??= '',
                            "co_Province"=> $input['comaker']['co_Province'] ??= '',
                            "co_YearsStay"=> $input['comaker']['co_YearsStay'] ??= '0',
                            "co_ZipCode"=> $input['comaker']['co_ZipCode'] ??= '',
                            "co_RTTB"=> $input['comaker']['co_RTTB'] ??= '',
                            "co_Status"=> '1',
                            "co_JobDescription"=> $input['comaker']['co_JobDescription'] ??= '',
                            "co_YOS"=> !empty($input['comaker']['co_YOS']) ? $input['comaker']['co_YOS'] : '0',
                            "co_MonthlySalary"=> !empty($input['comaker']['co_MonthlySalary']) ? $input['comaker']['co_MonthlySalary'] : '0',
                            "co_OtherSOC"=> $input['comaker']['co_OtherSOC'] ??= '',
                            "co_BO_Status"=> $input['comaker']['co_BO_Status'] ??= '0',
                            "co_CompanyName"=> $input['comaker']['co_CompanyName'] ??= '',
                            "co_CompanyAddress" => $input['comaker']['co_CompanyID'] ??= '',
                            "co_CompanyID"=> $input['comaker']['co_CompanyID'] ??= '', //mali
                            "co_Emp_Status"=> $input['comaker']['co_Emp_Status'] ??= '0',
                            "remarks"=> '',
                            "applicationStatus" => $type,
                            "profileName"=> $this->storeProfileImage(),
                            "profileFilePath"=> $this->storeProfileImage(),                            
                            "co_ProfileName"=>  $this->storeCoProfileImage(),
                            "co_ProfileFilePath"=>  $this->storeCoProfileImage(),
                            "requirementsFile"=> $this->storeAttachments(),    
                            "signatureUpload"=> [
                                    [
                                        "fileName"=> $this->storeSignature(),
                                        "filePath"=> $this->storeSignature()
                                    ]
                                ],                                    
                            "co_RequirementsFile"=> $this->storeCoAttachments(),
                            "co_SignatureUpload"=> [
                                    [
                                        "fileName"=> $this->storeCoSignature(),
                                        "filePath"=> $this->storeCoSignature()
                                    ]
                                ],
                            "userId"=> session()->get('auth_userid'),
                            "naid"=> $this->naID
                            //                          
                            //
                        ]
                    ];                                                   
                    // $extension = $request->file('filename')->getClientOriginalExtension();                    
                    //dd( json_encode($data));
                    //dd( $data );       
                    $this->resetValidation();  
                    $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/UpdateMemberInfo', $data);                                                          
                    $apiresp = $crt->getStatusCode();             
                    if($apiresp == 200){    
                        if(in_array($type, [7,8])){ 
                            return redirect()->to('/tranactions/application/view/'.$this->naID)->with(['mmessage'=> $type == 8 ? 'Application successfully updated' : 'Application successfully submited for CI', 'mword'=> 'Success']);
                        }
                        else{
                            return redirect()->to('/members/details/'.$this->naID)->with(['mmessage'=> 'Application successfully updated', 'mword'=> 'Success']);
                        }
                    }
                    else{
                        session()->flash('erroraction', 'update('. $type.')');
                        $this->emit('EMIT_ERROR_ASKING_DIALOG');
                    }
        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function submitForApproval(){
        try{
            $this->validate(['member.loanAmount' => ['required', 'numeric', 'min:0']]);
            $data = [
                        'naid' => $this->naID,
                        'remarks' => $this->loanDetails['remarks'] ??= '',
                        'loanAmount'=> $this->member['loanAmount'] ??= 0,
                        'userId' => session()->get('auth_userid'),                        
                    ];

                 
                    //amount
                    //add loan amount here
                  
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Credit/CreditSubmitforApproval', $data);  
            //dd($crt);
            return redirect()->to('/tranactions/application/view/'.$this->naID)->with(['mmessage'=> 'Application successfully submited', 'mword'=> 'Success']);
        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function approveForReleasing(){
        try{   
            $this->validate([
                                'loanDetails.loanAmount' => ['required', 'numeric', 'min:1'],
                                'loanDetails.topId' => ['required'],
                                'loanDetails.notarialFee' => ['required', 'numeric', 'min:0'],
                                'loanDetails.advancePayment' => ['required', 'numeric', 'min:0'],
                                'loanDetails.total_InterestAmount' => ['required', 'numeric', 'min:1'],
                                'loanDetails.total_LoanReceivable' => ['required', 'numeric', 'min:1'],
                                'loanDetails.dailyCollectibles' => ['required', 'numeric', 'min:1'],
                            ]);

            $data = [
                        'ldid' => $this->loanDetails['ldid'],
                        'memId' => $this->searchedmemId,
                        'note' => isset($this->loanDetails['notes']) ? $this->loanDetails['notes'] : '',
                        'approvedby' => session()->get('auth_userid'),
                        'naid' => $this->naID,
                        'approvedReleasingAmount' => $this->loanDetails['loanAmount'],
                        'approvedNotarialFee' => $this->loanDetails['notarialFee'],
                        'approvedAdvancePayment' => $this->loanDetails['advancePayment'],
                        'approveedInterest' => $this->loanDetails['total_InterestAmount'],                       
                        'approvedDailyAmountDue' => $this->loanDetails['dailyCollectibles'],
                        'loanAmount' => $this->loanDetails['loanAmount'],
                        'topId' => isset($this->loanDetails['topId']) ? $this->loanDetails['topId'] : $this->member['termsOfPayment'],
                        'courier' => '',
                        'courierName' => '',
                        'courierCno' => '',
                        'modeOfRelease' => '',
                        'modeOfReleaseReference' => '', 
                        'totalSavingsUsed' => $this->loanDetails['totalSavingsAmount'] != '' ? $this->loanDetails['totalSavingsAmount'] : 0,                             
                    ];

            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Approval/ApproveReleasing', $data);          
            //dd($crt);
            return redirect()->to('/tranactions/application/view/'.$this->naID)->with(['mmessage'=> 'Application successfully approve for releasing', 'mword'=> 'Success']);
        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function signForRelease(){
        try{          
           
            $this->validate([
                                'loanDetails.modeOfRelease' => ['required'],
                                'loanDetails.denomination' => ['required'],
                                'loanDetails.courier' => ['required'],          
                                'loanDetails.courierclient' => isset($this->loanDetails['courier']) ? ($this->loanDetails['courier'] == 'Client' ? ['required'] : '') : '',  
                                'loanDetails.courieremployee' => isset($this->loanDetails['courier']) ? ($this->loanDetails['courier'] == 'Employee' ? ['required'] : '') : '',  
                                'loanDetails.couriercno' => ['required'], 
                                'loanDetails.savingsToUse' => '',                                                                
                            ]);

            $data = [
                        'ldid' => $this->loanDetails['ldid'],
                        "note"=> $this->loanDetails['notes'],
                        'approvedby' => session()->get('auth_userid'),
                        'naid' => $this->naID,
                        "approvedReleasingAmount"=> 0,
                        "approvedNotarialFee"=> 0,
                        "approvedAdvancePayment"=> 0,
                        "approveedInterest"=> 0,
                        "approvedDailyAmountDue"=> 0,
                        'approvedLoanAmount' => $this->loanDetails['loanAmount'],                        
                        'topId' => isset($this->loanDetails['topId']) ? $this->loanDetails['topId'] : $this->member['termsOfPayment'],                                            
                        "courier"=> $this->loanDetails['courier'],
                        "courierName"=> $this->loanDetails['courier'] == 'Employee' ? $this->loanDetails['courieremployee'] : $this->loanDetails['courierclient'],
                        "courierCno"=> $this->loanDetails['couriercno'],
                        "modeOfRelease"=> $this->loanDetails['modeOfRelease'],                       
                        "modeOfReleaseReference"=> $this->loanDetails['denomination'], 
                        "totalSavingsUsed" => isset($this->loanDetails['savingsToUse']) ? $this->loanDetails['savingsToUse'] : 0,         
                    ];
                 
             
            $this->emit('openUrlPrintingVoucher', ['url' => URL::to('/').'/tranactions/application/printing/'.$this->naID , 'title' => 'This is the title', 'message' => 'This is the message']);
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Releasing/ReleasingComplete', $data);                                 
            //dd($crt);     
            return redirect()->to('/tranactions/application/view/'.$this->naID)->with(['mmessage'=> 'Application successfully signed for releasing', 'mword'=> 'Success']);
        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function completeApplication(){
        try{          

            $this->validate([
                                'loanDetails.modeOfRelease' => ['required'],
                                'loanDetails.denomination' => ['required'],
                                'loanDetails.courier' => ['required'],          
                                'loanDetails.courierclient' => isset($this->loanDetails['courier']) ? ($this->loanDetails['courier'] == 'Client' ? ['required'] : '') : '',  
                                'loanDetails.courieremployee' => isset($this->loanDetails['courier']) ? ($this->loanDetails['courier'] == 'Employee' ? ['required'] : '') : '',  
                                'loanDetails.couriercno' => ['required'],                                             
                            ]);

            $data = [
                        'ldid' => $this->loanDetails['ldid'],
                        "note"=> $this->loanDetails['notes'],
                        'approvedby' => session()->get('auth_userid'),
                        'naid' => $this->naID,
                        "approvedReleasingAmount" => 0,
                        "approvedNotarialFee" => 0,
                        "approvedAdvancePayment" => 0,
                        "approveedInterest" => 0,
                        "approvedDailyAmountDue" => 0,
                        'approvedLoanAmount' => $this->loanDetails['loanAmount'],                        
                        'topId' => isset($this->loanDetails['topId']) ? $this->loanDetails['topId'] : $this->member['termsOfPayment'],                                            
                        "courier"=> $this->loanDetails['courier'],
                        "courierName"=> $this->loanDetails['courier'] == 'Employee' ? $this->loanDetails['courieremployee'] : $this->loanDetails['courierclient'],
                        "courierCno"=> $this->loanDetails['couriercno'],
                        "modeOfRelease"=> $this->loanDetails['modeOfRelease'],                       
                        "modeOfReleaseReference"=> $this->loanDetails['denomination'],  
                        "totalSavingsUsed" => 0                                
                    ];
      
           
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Releasing/ComppleteTransaction', $data);                    
            //dd($crt);       
            return redirect()->to('tranactions/application/releasing/list')->with(['mmessage'=> 'Application is complete and ready for releasing', 'mword'=> 'Success']);
        }
        catch (\Exception $e) {           
            throw $e;            
        }

        //$crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Releasing/ReleasingComplete', $data);          
        //return redirect()->to('tranactions/application/releasing/list')->with(['mmessage'=> 'Application is complete and ready for releasing', 'mword'=> 'Success']);
    }

    public function reprintApplication(){
        try{          
            $this->emit('openUrlPrintingVoucher', ['url' => URL::to('/').'/tranactions/application/printing/'.$this->naID , 'title' => 'This is the title', 'message' => 'This is the message']);
        }
        catch (\Exception $e) {           
            throw $e;            
        }

        //$crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Releasing/ReleasingComplete', $data);          
        //return redirect()->to('tranactions/application/releasing/list')->with(['mmessage'=> 'Application is complete and ready for releasing', 'mword'=> 'Success']);
    }

    public function decline(){
        $this->validate(['reason' => 'required']);     
        $data = [
                    "ldid"=> $this->loanDetails['ldid'],
                    "remarks"=> $this->reason,
                    "declinedBy"=> session()->get('auth_userid'),
                    "naid"=> $this->naID
                ];

        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Approval/DeclineLoans', $data);                      
        //dd($data);
        return redirect()->to('/tranactions/application/list')->with(['mmessage'=> 'Application has been declined', 'mword'=> 'Success']);
    }

    public function openSearchEmployee(){              
        $this->emit('openSearchEmployeeModal', ['data' => '' , 'title' => 'This is the title', 'message' => 'This is the message']);
        $this->searchEmployee();
    }

    public function selectEmployee($empname = ''){
        $this->loanDetails['courieremployee'] = $empname;
        $this->emit('closeSearchEmployeeModal', ['data' => '' , 'title' => 'This is the title', 'message' => 'This is the message']);
    }

    public function getmemberAge(){
        $age = $this->calculateAge($this->member['dob']);
        $this->member['age'] = $age;           
    }

    public function getcomakerAge(){
        $age = $this->calculateAge($this->comaker['co_DOB']);
        $this->comaker['co_Age'] = $age;           
    }

    public function getmemberFAge(){
        $age = $this->calculateAge($this->member['f_DOB']);
        $this->member['f_Age'] = $age;           
    }

    public function addVehicle(){
        $lastcnt = array_key_last($this->vehicle);   
        $this->vehicle[$lastcnt + 1] = [  'vehicle' => '' ];
    }

    public function subVehicle($cnt){
        unset($this->vehicle[$cnt]);       
    }

    public function addProperty(){
        $lastcnt = array_key_last($this->properties);   
        $this->properties[$lastcnt + 1] = [  'property' => '' ];
    }

    public function subProperty($cnt){
        unset($this->properties[$cnt]);       
    }

    public function addChild(){
        $lastcnt = end($this->cntmemchild);
        $this->cntmemchild[] = $lastcnt + 1;        
    }

    public function subChild($cnt){            
        if (($key = array_search($cnt, $this->cntmemchild)) !== false) {        
            unset($this->cntmemchild[$key]); 
        }      
    }

    public function addAppliances(){
        $lastcnt = array_key_last($this->appliances);   
        $this->appliances[$lastcnt + 1] = [  'appliance' => '', 'brand' => '' ];
    }

    public function subAppliances($cnt){
        unset($this->appliances[$cnt]);       
    }

    public function addBank(){
        $lastcnt = array_key_last($this->bank);   
        $this->bank[$lastcnt + 1] = [  'account' => '', 'address' => '' ];
    }

    public function subBank($cnt){
        unset($this->bank[$cnt]);       
    }
    
    public function addBusinessInfo(){
        $lastcnt = array_key_last($this->businfo);  
        if(isset($this->membusinfo['cnt'])){
            $lastcnt = $this->membusinfo['cnt'];
        }
        else{
            $lastcnt = $lastcnt  + 1;
        }
        //dd($this->membusinfo['attachments']);  
        $data = $this->validate([                                    
                                    'membusinfo.businessName' => ['required'],
                                    'membusinfo.businessType' => ['required'],
                                    'membusinfo.businessAddress' => ['required'],                                   
                                    'membusinfo.b_status' => ['required'],
                                    'membusinfo.yob' => ['required'],
                                    'membusinfo.noe' => ['required'],
                                    'membusinfo.salary' => ['required'],
                                    'membusinfo.vos' => ['required'],
                                    'membusinfo.aos' => ['required'],
                                    'membusinfo.attachments' => ['required'],
                                ]);
       
        $this->businfo[$lastcnt] = [  'businessName' => $data['membusinfo']['businessName'],
                                          'businessType' => $data['membusinfo']['businessType'],
                                          'businessAddress' => $data['membusinfo']['businessAddress'],                                         
                                          'b_status' => $data['membusinfo']['b_status'],
                                          'yob' => $data['membusinfo']['yob'],
                                          'noe' => $data['membusinfo']['noe'],
                                          'salary' => $data['membusinfo']['salary'],
                                          'vos' => $data['membusinfo']['vos'],
                                          'aos' => $data['membusinfo']['aos'],    
                                          'attachments' => $this->membusinfo['attachments'],     
                                          'old_attachments' => []                                           
                                        ];
                                
        $this->resetmembusinfo();                        
    }

    public function editBusinessInfo($cnt){    
        $businfo = $this->businfo[$cnt];      
        $this->membusinfo['cnt']  = $cnt;
        $this->membusinfo['businessName']  = $businfo['businessName'];
        $this->membusinfo['businessType']  = $businfo['businessType'];
        $this->membusinfo['businessAddress']  = $businfo['businessAddress'];
        $this->membusinfo['b_status']  = $businfo['b_status'];
        $this->membusinfo['yob']  = $businfo['yob'];
        $this->membusinfo['noe']  = $businfo['noe'];
        $this->membusinfo['salary']  = $businfo['salary'];
        $this->membusinfo['vos']  = $businfo['vos'];
        $this->membusinfo['aos']  = $businfo['aos'];
        $this->membusinfo['attachments']  = $businfo['attachments'];
        $this->membusinfo['old_attachments']  = $businfo['old_attachments'];
        $this->resetValidationOnBusinessinfo();
    }

    public function resetmembusinfo(){
        $this->membusinfo['cnt']  = null;
        $this->membusinfo['businessName'] = '';
        $this->membusinfo['businessType'] = '';
        $this->membusinfo['businessAddress'] = '';
        $this->membusinfo['b_status'] = '';
        $this->membusinfo['yob'] = '';
        $this->membusinfo['noe'] = '';
        $this->membusinfo['salary'] = '';
        $this->membusinfo['vos'] = '';
        $this->membusinfo['aos'] = '';
        $this->membusinfo['attachments'] = [];
        $this->membusinfo['old_attachments'] = [];
        $this->resetValidationOnBusinessinfo();       
    }

    public function removeBusinessInfo($cnt){
        //if (($key = array_search($cnt, $this->businfo)) !== false) {                 
            unset($this->businfo[$cnt]); 
        //}      
        $this->resetValidationOnBusinessinfo();
    }

    public function resetValidationOnBusinessinfo(){
        $this->resetValidation([
                                'membusinfo.businessName',
                                'membusinfo.businessType',
                                'membusinfo.businessAddress',
                                'membusinfo.b_status',
                                'membusinfo.yob',
                                'membusinfo.noe',
                                'membusinfo.salary',
                                'membusinfo.vos',
                                'membusinfo.aos',
                                'membusinfo.attachments',
                                ]);
    }

    // public function getLoanTermsname($topid = ''){
    //     $termsofPayment = '';
    //     $loantypelist = $this->termsOfPaymentList->where('topId', $topid)->first();
       
    //     if($loantypelist){
    //         $termsofPayment = $loantypelist['termsofPayment'];
    //     }
    //     return $termsofPayment;
    // }

    public function getLoanHistory(){         
        $loanhistory = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Credit/LoanHistory', ['memid' => $this->searchedmemId]);                 
        $apiresp = $loanhistory->getStatusCode();
        if($apiresp != 400){
            $loanhistory = $loanhistory->json();                             
            $paymenthistory = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Credit/PaymentHistory', ['memid' => $this->searchedmemId]);                 
            $paymenthistory = $paymenthistory->json();  
            
            if($loanhistory){
                $this->loanhistory = collect($loanhistory);        
                //dd($this->loanhistory);          
            }
            if($paymenthistory){
                $this->paymenthistory = collect($paymenthistory);          
            }
        }
    }    

    public function resetLoanHistory(){
        $this->loanhistory = collect([]); 
        $this->paymenthistory = collect([]);            
    }

    public function computeLoanAmount(){      
        //if(!empty($this->naID)){
            $data = [
                "naid"=> $this->naID,
                "loanamount"=> $this->member['statusID'] == 8 ? $this->member['loanAmount'] ??= 0 : $this->loanDetails['loanAmount'] ??= 0,
                "loantype"=> $this->loanDetails['loanTypeID'],          
            ];
            $compute = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanSummary/GetLoanSummaryComputation', $data);       
            $computed = !empty($compute->json()[0]) ? $compute->json()[0] : [];
            if(!empty($computed)){
                //dd($computed);
                $this->loanDetails['totalSavingsAmount'] = $computed['totalSavingsAmount'];
                $this->loanDetails['notarialFee'] = $computed['notarialFee'];
                $this->loanDetails['advancePayment'] = $computed['advancePayment'];
                $this->loanDetails['total_InterestAmount'] = $computed['total_InterestAmount'];
                $this->loanDetails['total_LoanReceivable'] = $computed['total_LoanReceivable'];
                $this->loanDetails['dailyCollectibles'] = $computed['dailyCollectibles'];
            }
        //}
        // $this->ChangeLoanAmount();
    }

    public function ChangeLoanAmount(){
        $data = [
                    "approvedLoanAmount"=> $this->member['statusID'] == 8 ? $this->member['loanAmount'] : $this->loanDetails['loanAmount'],
                    "topId"=> $this->loanDetails['topId'],
                    "ldid"=> $this->loanDetails['ldid'],
                    "userId"=> session()->get('auth_userid')
                ];
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Approval/ChangeLoanAmount', $data);       
    }

    public function renderProvince(){
        // if(file_exists(public_path('storage/barangay_files/refregion.csv'))){
        //     $getfileregion = public_path('storage/barangay_files/refregion.csv');
        //     $fileregion = fopen($getfileregion, "r");
        //     $this->regions = collect([]);          
        //     while ( ($fdata = fgetcsv($fileregion, 200, ",")) !==FALSE ) {                           
        //         $this->regions->put($fdata[0], [ 'psgcCode' => $fdata[1], 'regDesc' => $fdata[2], 'regCode' => $fdata[3]]);
        //     }             
        // }   

        if(file_exists(public_path('storage/barangay_files/refprovince.csv'))){
            $getfileprovince = public_path('storage/barangay_files/refprovince.csv');
            $fileprovince = fopen($getfileprovince, "r");
            $this->provinces = collect([]);          
            while ( ($fdata = fgetcsv($fileprovince, 200, ",")) !==FALSE ) {                           
                $this->provinces->put($fdata[0], [ 'psgcCode' => $fdata[1], 'provDesc' => $fdata[2], 'regCode' => $fdata[3], 'provCode' => $fdata[4]]);
            }           
        }  

        $this->cities = collect([]);  
        $this->barangays = collect([]);                       
    }

    public function renderCity(){
        if(file_exists(public_path('storage/barangay_files/refcitymun.csv'))){
            $getfilecity = public_path('storage/barangay_files/refcitymun.csv');
            $filecity = fopen($getfilecity, "r");
            $this->cities = collect([]);     
            $getprovince =  $this->provinces->where('provDesc', $this->member['province'])->first();     
            if(  $getprovince ){         
                while ( ($fdata = fgetcsv($filecity, 200, ",")) !==FALSE ) {   
                    if($getprovince['provCode'] == $fdata[4]){
                        $this->cities->put($fdata[0], [ 'psgcCode' => $fdata[1], 'citymunDesc' => $fdata[2], 'regDesc' => $fdata[3], 'provCode' => $fdata[4], 'citymunCode' => $fdata[5]]);
                    }                                        
                }   
            }        
        }       
        $this->barangays = collect([]);       
    }

    public function renderBarangay(){
        if(file_exists(public_path('storage/barangay_files/refbrgy.csv'))){
            $getfilebarangay = public_path('storage/barangay_files/refbrgy.csv');
            $filebarangay = fopen($getfilebarangay, "r");
            $this->barangays = collect([]);       
            $getcity =  $this->cities->where('citymunDesc', $this->member['city'])->first();   
            if( $getcity ){          
                while ( ($fdata = fgetcsv($filebarangay, 200, ",")) !==FALSE ) {    
                    if($getcity['citymunCode'] == $fdata[5]){                       
                        $this->barangays->put($fdata[0], [ 'brgyCode' => $fdata[1], 'brgyDesc' => $fdata[2], 'regCode' => $fdata[3], 'provCode' => $fdata[4], 'citymunCode' => $fdata[5]]);
                    }
                } 
            }          
        }       
    }

    public function renderCoCity(){     
        if(file_exists(public_path('storage/barangay_files/refcitymun.csv'))){
            $getfilecity = public_path('storage/barangay_files/refcitymun.csv');
            $filecity = fopen($getfilecity, "r");
            $this->cocities = collect([]);     
            $getprovince =  $this->provinces->where('provDesc', $this->comaker['co_Province'])->first();    
            if( $getprovince ){          
                while ( ($fdata = fgetcsv($filecity, 200, ",")) !==FALSE ) {   
                    if($getprovince['provCode'] == $fdata[4]){
                        $this->cocities->put($fdata[0], [ 'psgcCode' => $fdata[1], 'citymunDesc' => $fdata[2], 'regDesc' => $fdata[3], 'provCode' => $fdata[4], 'citymunCode' => $fdata[5]]);
                    }                                        
                }      
            }     
        }             
        $this->cobarangays = collect([]);       
    }

    public function renderCoBarangay(){
        if(file_exists(public_path('storage/barangay_files/refbrgy.csv'))){
            $getfilebarangay = public_path('storage/barangay_files/refbrgy.csv');
            $filebarangay = fopen($getfilebarangay, "r");
            $this->cobarangays = collect([]);       
            $getcity =  $this->cocities->where('citymunDesc', $this->comaker['co_City'])->first();  
            if( $getcity ){           
                while ( ($fdata = fgetcsv($filebarangay, 200, ",")) !==FALSE ) {    
                    if($getcity['citymunCode'] == $fdata[5]){                       
                        $this->cobarangays->put($fdata[0], [ 'brgyCode' => $fdata[1], 'brgyDesc' => $fdata[2], 'regCode' => $fdata[3], 'provCode' => $fdata[4], 'citymunCode' => $fdata[5]]);
                    }
                }         
            }  
        }       
    }

    public function checkExistingMember(){      
        if(!empty($this->member['fname']) && !empty($this->member['fname']) && !empty($this->member['lname']) && !empty($this->member['pob']) && !empty($this->member['barangay']) && !empty($this->member['dob']) && !empty($this->member['age'])){  
            $data = [
                        'fname'=> $this->member['fname'],
                        'mname'=> $this->member['mname'],
                        'lname'=> $this->member['lname'],
                        'pob'=> $this->member['pob'],
                        'barangay'=> $this->member['barangay'],
                        'dob'=> $this->member['dob'],
                        'age'=> $this->member['age'],
                    ];
            $checkmem = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/Member_ValidationOnChange', $data);                                   
            $checkmem = $checkmem->json();    
            if(isset( $checkmem[0] )){                         
                if(empty($this->member['gender'])){                 
                    $this->member['gender'] = $checkmem[0]['gender'];                   
                }
                if(empty($this->member['civil_Status'])){                 
                    $this->member['civil_Status'] = $checkmem[0]['civil_Status'];                   
                }
                if(empty($this->member['cno'])){                 
                    $this->member['cno'] = $checkmem[0]['cno'];                   
                }
                if(empty($this->member['emailAddress'])){                 
                    $this->member['emailAddress'] = $checkmem[0]['emailAddress'];                   
                }                
                if(empty($this->member['house_Stats'])){                                   
                    $this->member['house_Stats'] = $checkmem[0]['houseStatusId'];                   
                }
                if(empty($this->member['houseNo'])){                                   
                    $this->member['houseNo'] = $checkmem[0]['houseNo'];                   
                }
                if(empty($this->member['country'])){                                   
                    $this->member['country'] = $checkmem[0]['country'];                   
                }
                if(empty($this->member['zipCode'])){                                   
                    $this->member['zipCode'] = $checkmem[0]['zipCode'];                   
                }
                if(empty($this->member['yearsStay'])){                                   
                    $this->member['yearsStay'] = $checkmem[0]['yearsStay'];                   
                }
                if(empty($this->member['electricBill'])){                                   
                    $this->member['electricBill'] = $checkmem[0]['electricBill'];                   
                }
                if(empty($this->member['waterBill'])){                                   
                    $this->member['waterBill'] = $checkmem[0]['waterBill'];                   
                }
                if(empty($this->member['otherBills'])){                                   
                    $this->member['otherBills'] = $checkmem[0]['otherBills'];                   
                }
                if(empty($this->member['dailyExpenses'])){                                   
                    $this->member['dailyExpenses'] = $checkmem[0]['dailyExpenses'];                   
                }
                //dd($checkmem[0]);
            }       
        }
    }

    public function mount($type = 'create', Request $request){
        $this->regions = collect([]);
        $this->provinces = collect([]);
        $this->cities = collect([]);
        $this->barangays = collect([]);

        $this->coregions = collect([]);
        $this->coprovinces = collect([]);
        $this->cocities = collect([]);
        $this->cobarangays = collect([]);
           
        $this->usertype = session()->get('auth_usertype'); 
        $this->modules = session()->get('auth_usermodules'); 
        $this->member['old_profile'] = '';
        $this->member['old_signature'] = '';
        $this->member['old_attachments'] = [];

        $this->comaker['old_attachments'] = [];
        $this->comaker['old_profile'] = '';
        $this->comaker['old_signature'] = '';
        $this->type = $type;     
        $this->termsOfPaymentList = collect([]); 
        $this->paymenthistory = collect([]);
        $this->loanhistory = collect([]);  
        
        $this->membusinfo['old_attachments'] = [];
      
        $this->member['civil_Status'] = '';       
        $this->member['emp_Status'] = '';
        $this->member['f_Emp_Status'] = '';
        $this->member['bO_Status'] = '';
        $this->cntmemchild = [1];        
        $this->vehicle[1] = [  'vehicle' => '' ];
        $this->properties[1] = [ 'property' => '' ];
        $this->appliances[1] = [ 'appliance' => '', 'brand' => '' ];
        $this->bank[1] = [  'account' => '', 'address' => '' ];

        $this->comaker['co_Emp_Status'] = '';
        $this->member['statusID'] = '7';

        $loandetails = session('sessloandetails') !==null ? session('sessloandetails') : null; 
        $this->member['loanAmount'] = isset($loandetails['loamamount']) ? $loandetails['loamamount'] : '';
        $this->member['termsOfPayment'] = isset($loandetails['paymentterms']) ? $loandetails['paymentterms'] : '';
        $this->member['purpose'] = isset($loandetails['purpose']) ? $loandetails['purpose'] : '';  
        $this->renderProvince();    
        if($this->type == 'create'){       
                               
                $this->loanDetails['loanTypeID'] = $request->loanTypeID;  
                $this->loanDetails['loanTypeName'] = $request->loanTypeName;    
                $this->loanDetails['loantermsID'] = $request->loantermsID; 
                $this->loanDetails['loantermsName'] = $request->loantermsName;  
                $this->member['termsOfPayment'] = $this->loanDetails['loantermsName'];     

                if($request->naID != ''){                        
                    $value = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/PostMemberSearching', [['column' => 'tbl_Member_Model.MemId', 'values' => $request->naID]]);                         
                    $resdata = $value->json();                                                                                           
                    if(!empty($resdata[0])){
                        $data = $resdata[0];                        
                        $this->searchedmemId =  $request->naID;
                        $this->member['fname'] = $data['fname'];  
                        $this->member['lname'] = $data['lname'];
                        $this->member['mname'] = $data['mname'];
                        $this->member['suffix'] = $data['suffix']; 
                        $this->member['age'] = $data['age']; 
                        $this->member['barangay'] = $data['barangay'];  
                        $this->member['city'] = $data['city']; 
                        $this->member['civil_Status'] = $data['civil_Status'];  
                        $this->member['cno'] = $data['cno']; 
                        $this->member['country'] = $data['country']; 
                        $this->member['dob'] = date('Y-m-d', strtotime($data['dob']));
                        $this->member['emailAddress'] = $data['emailAddress']; 
                        $this->member['gender'] = $data['gender'];
                        $this->member['houseNo'] = $data['houseNo'];
                        $this->member['house_Stats'] = $data['houseStatus_Id']; 
                        $this->member['pob'] = $data['pob'];
                        $this->member['province'] = $data['province']; 
                        $this->member['yearsStay'] = $data['yearsStay'];
                        $this->member['zipCode'] = $data['zipCode'];
                        $this->member['profile'] = $data['profilePath'];   
                        $this->renderCity();
                        $this->renderBarangay();                       
                    }            
                }
                else{                     
                    $this->member['fname'] = 'Jumar';  
                    $this->member['lname'] = 'Badajos';
                    $this->member['mname'] = '';
                    $this->member['suffix'] = ''; 
                    $this->member['age'] = '22'; 
                    $this->member['barangay'] = 'Rivera';  
                    $this->member['city'] = 'CITY OF SAN JUAN'; 
                    $this->member['civil_Status'] = 'Married';  
                    $this->member['cno'] = '02233666666'; 
                    $this->member['country'] = 'Philippines'; 
                    $this->member['dob'] = date('Y-m-d', strtotime('12/27/1991'));
                    $this->member['emailAddress'] = 'test@gmail.com'; 
                    $this->member['gender'] = 'Male';
                    $this->member['houseNo'] = 'No. 9 GB';
                    $this->member['house_Stats'] = '2'; 
                    $this->member['pob'] = 'Bani, Pangasinan';
                    $this->member['province'] = 'NCR, SECOND DISTRICT'; 
                    $this->member['yearsStay'] = '5';
                    $this->member['zipCode'] = '';  
                    $this->renderCity();
                    $this->renderBarangay();         
                }
              
                $this->member['electricBill'] = '250'; 
                $this->member['waterBill'] = '100'; 
                $this->member['otherBills'] = '1000'; 
                $this->member['dailyExpenses'] = '10000'; 
                $this->member['jobDescription'] = 'Programmer'; 
                $this->member['yos'] = '7'; 
                $this->member['monthlySalary'] = '15000'; 
                $this->member['otherSOC'] = 'Freelancer'; 
                $this->member['bO_Status'] = '1'; 
                $this->member['companyName'] = 'SOEN'; 
                $this->member['companyAddress'] = 'ORTIGAS'; 
                $this->member['emp_Status'] = '1'; 
                $this->member['f_Fname'] = 'Jezz'; 
                $this->member['f_Lname'] = 'Eurolfan'; 
                $this->member['f_Mname'] = 'Javier'; 
                $this->member['f_Suffix'] = ''; 
                $this->member['f_DOB'] = date('Y-m-d', strtotime('12/27/1991'));
                $this->member['f_Age'] = '30'; 
                $this->member['f_NOD'] = '0'; 
                $this->member['f_YOS'] = '5'; 
                $this->member['f_Emp_Status'] = '1'; 
                $this->member['f_Job'] = 'Cashier'; 
                $this->member['f_CompanyName'] = 'SOEN'; 
                $this->member['f_RTTB'] = '';     
                $this->member['loanAmount'] = '30000';                
                $this->member['purpose'] = 'For Business'; 
        
                $this->comaker['co_Fname'] = 'Thea'; 
                $this->comaker['co_Lname'] = 'Badajos'; 
                $this->comaker['co_Mname'] = 'Eurolfan'; 
                $this->comaker['co_Suffix'] = ''; 
                $this->comaker['co_Age'] = '26'; 
                $this->comaker['co_Barangay'] = 'Rivera'; 
                $this->comaker['co_City'] = 'CITY OF SAN JUAN'; 
                $this->comaker['co_Civil_Status'] = 'Single'; 
                $this->comaker['co_Cno'] = '023369990'; 
                $this->comaker['co_Country'] = 'Philippines'; 
                $this->comaker['co_DOB'] = date('Y-m-d', strtotime('12/27/1991'));
                $this->comaker['co_EmailAddress'] = 'test@gmail.com'; 
                $this->comaker['co_Gender'] = 'Female'; 
                $this->comaker['co_HouseNo'] = '566233';         
                $this->comaker['co_House_Stats'] = '2'; 
                $this->comaker['co_POB'] = 'Pangasinan'; 
                $this->comaker['co_Province'] = 'NCR, SECOND DISTRICT'; 
                $this->comaker['co_YearsStay'] = '5'; 
                $this->comaker['co_ZipCode'] = ''; 
                $this->comaker['co_RTTB'] = 'Sister'; 
                $this->comaker['co_Status'] = ''; 
                $this->comaker['co_JobDescription'] = 'Cashier'; 
                $this->comaker['co_YOS'] = '0'; 
                $this->comaker['co_MonthlySalary'] = '15000'; 
                $this->comaker['co_OtherSOC'] = 'none'; 
                $this->comaker['co_BO_Status'] = '1'; 
                $this->comaker['co_CompanyName'] = 'SOEN'; 
                $this->comaker['co_CompanyID'] = 'asd'; 
                $this->comaker['co_Emp_Status'] = '1'; 
                $this->comaker['remarks'] = ''; 
                $this->renderCoCity();
                $this->renderCoBarangay();
        }
        else if($this->type == 'view' || $this->type == 'details'){
            $value = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/ApplicationMemberDetails', ['applicationID' => $this->naID]); 
            $resdata = $value->json();             
            if(isset($resdata[0])){        
                $data = $resdata[0];    
                //dd($data);    
                //ditoviewing     
                $this->searchedmemId =  $data['memId'];
                $this->member['statusID'] = $data['applicationStatus'];
                if($this->type == 'view'){
                    if( $this->member['statusID'] == 8 ){
                        if(!in_array('Module-09',$this->modules)){
                            return redirect()->to('/tranactions/application/list')->with(['mmessage'=> 'Application successfully saved', 'mword'=> 'Success']);
                        }
                    }
                    if( $this->member['statusID'] == 9 ){
                        if(!in_array('Module-010',$this->modules)){
                            return redirect()->to('/tranactions/application/credit/investigation/list')->with(['mmessage'=> 'Application successfully saved', 'mword'=> 'Success']);
                        }
                    }
                    if( $this->member['statusID'] == 10 ){
                        if(!in_array('Module-011',$this->modules)){
                            return redirect()->to('/tranactions/application/approval/list')->with(['mmessage'=> 'Application successfully saved', 'mword'=> 'Success']);
                        }
                    }
                    if( $this->member['statusID'] == 14 ){
                        if(!in_array('Module-011',$this->modules)){
                            return redirect()->to('/tranactions/application/approval/list')->with(['mmessage'=> 'Application successfully saved', 'mword'=> 'Success']);
                        }
                    }
                }
                //dd( $this->searchedmemId );
                //get loan payment and history
              
                //$loanHistory = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Credit/LoanHistory', ['memid' => $this->searchedmemId]);                                    
                //$loanHistory = $loanHistory->json();
                //dd($loanHistory);
                //get loan payment and history
                //dd($data['individualLoan']);
                $this->loanDetails['loanTypeID'] = $data['individualLoan'][0]['loanTypeID'];
                $this->loanDetails['loanTypeName'] = $data['individualLoan'][0]['loanType'];
                $this->loanDetails['loantermsID'] = $data['termsOfPayment']; 
                $this->loanDetails['loantermsName'] = $data['individualLoan'][0]['nameOfTerms'];  
                //if($data['applicationStatus'] >= 9){
                    $this->loanDetails['loanType'] = isset($data['individualLoan'][0]['loanType']) ? $data['individualLoan'][0]['loanType'] : '';                  
                    $this->loanDetails['loanAmount'] = in_array($data['applicationStatus'], [8,9]) ? ($data['individualLoan'][0]['loanAmount'] ??= 0) : $data['individualLoan'][0]['approvedLoanAmount'];
                    $this->loanDetails['purpose'] = $data['purpose'];
                    //$this->loanDetails['terms'] = $data['termsOfPayment']; //$data['individualLoan'][0]['terms'];
                                    
                    $this->loanDetails['noofnopayment'] = 0; 
                    $this->loanDetails['noofloans'] = 0; 
                                        
                    $this->loanDetails['app_ApprovedBy_1'] = $data['individualLoan'][0]['app_ApprovedBy_1'];
                    $this->loanDetails['app_ApprovalDate_1'] = $data['individualLoan'][0]['app_ApprovalDate_1'];

                    $this->loanDetails['app_ApprovedBy_1_name'] = $this->getUserName($data['individualLoan'][0]['app_ApprovedBy_1']);
                    $this->loanDetails['app_ApprovalDate_1_timeint'] = $this->calculateTimeDifference($data['individualLoan'][0]['app_ApprovalDate_1'], Carbon::now());
                    
                    $ciuserid = isset($data['individualLoan'][0]['cI_ApprovedBy']) ? $data['individualLoan'][0]['cI_ApprovedBy'] : '';                
                    $this->loanDetails['approvedBy'] = $this->getUserName($ciuserid);                                                           
                    $this->loanDetails['notes'] = isset($data['individualLoan'][0]['app_Note']) ? $data['individualLoan'][0]['app_Note'] : ''; 
                    $this->loanDetails['ldid'] = $data['individualLoan'][0]['ldid'];
                    $this->loanDetails['topId'] = $data['termsOfPayment'];  

                    $this->loanDetails['modeOfRelease'] = $data['individualLoan'][0]['modeOfRelease'];
                    $this->loanDetails['denomination'] = $data['individualLoan'][0]['modeOfReleaseReference'];
                    $this->loanDetails['courier'] = $data['individualLoan'][0]['courerier'];
                    $this->loanDetails['courieremployee'] = $data['individualLoan'][0]['courerierName'];
                    $this->loanDetails['courierclient'] = $data['individualLoan'][0]['courerierName'];
                    $this->loanDetails['couriercno'] = $data['individualLoan'][0]['courierCNo'];

                    $loanterms = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Approval/getTermsListByLoanType', ['loantypeid' => $this->loanDetails['loanTypeID']]);                                    
                    $loanterms = $loanterms->json();
                    //dd($loanterms);
                   
                    if( $loanterms ){
                        foreach( $loanterms  as  $loanterms ){
                            $this->termsOfPaymentList[$loanterms['topId']] = ['topId' => $loanterms['topId'],'termsofPayment' => $loanterms['termsofPayment'],'loanTypeId' => $loanterms['loanTypeId']];   
                        }
                    }

                    //loan summary
                    $getloansummary = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/LoanSummary/GetLoanSummary', [ 'naid' => $this->naID ]);                  
                    $this->loansummary = isset($getloansummary[0]) ? $getloansummary[0] : [];   
                    //dd($this->loansummary);                              

                    $this->loanDetails['totalSavingsAmount'] = isset($getloansummary[0]) ? $this->loansummary['totalSavingsAmount'] : '';
                    $this->loanDetails['notarialFee'] = isset($getloansummary[0]) ? ($this->loansummary['app_ApprovedBy_1_UserId'] == '' ? $this->loansummary['notarialFee'] :  $this->loansummary['approvedNotarialFee']) : ''; 
                    $this->loanDetails['advancePayment'] = isset($getloansummary[0]) ? ($this->loansummary['app_ApprovedBy_1_UserId'] == '' ? $this->loansummary['advancePayment'] :  $this->loansummary['approvedAdvancePayment']) : ''; 
                    $this->loanDetails['total_InterestAmount'] = isset($getloansummary[0]) ? ($this->loansummary['app_ApprovedBy_1_UserId'] == '' ? $this->loansummary['total_InterestAmount'] :  $this->loansummary['approveedInterest']) : ''; 
                    $this->loanDetails['total_LoanReceivable'] = isset($getloansummary[0]) ? ($this->loansummary['app_ApprovedBy_1_UserId'] == '' ? $this->loansummary['total_LoanReceivable'] :  $this->loansummary['approvedReleasingAmount']) : ''; 
                    $this->loanDetails['dailyCollectibles'] = isset($getloansummary[0]) ? ($this->loansummary['app_ApprovedBy_1_UserId'] == '' ? $this->loansummary['dailyCollectibles'] :  $this->loansummary['approvedDailyAmountDue']) : ''; 
                    $this->loanDetails['totalSavings'] = isset($getloansummary[0]) ? $this->loansummary['totalSavingsAmount'] : '';
                   
                                                                     
                //}
                $this->loanDetails['remarks'] = $data['individualLoan'][0]['remarks'];
                $this->loanDetails['ci_time'] = $this->calculateTimeDifference($data['dateCreated'], Carbon::now());    
                //dd( Carbon::now() );
                
                //images and files
                $files = $data['files'];
                $this->member['attachments'] = [];
                $this->member['profile'] = '';
                $this->member['signature'] = '';
                if($files){
                    foreach($files as $mfiles){
                        if($mfiles['fileType'] == 'Profile'){
                            $this->member['profile'] = $mfiles['filePath'];
                        }

                        if($mfiles['fileType'] == 'File'){
                            $this->member['attachments'][] = [ 'fileName' => $mfiles['filePath'] , 'filePath' => $mfiles['filePath'] ];
                        }

                        if($mfiles['fileType'] == 'Singature'){
                            $this->member['signature'] = $mfiles['filePath'];
                        }
                    }
                    $this->member['old_attachments'] = $this->member['attachments'];
                    $this->member['old_profile'] = $this->member['profile'];                  
                    $this->member['old_signature'] = $this->member['signature'];
                }

                $cofiles = $data['co_Files'];
                $this->comaker['attachments'] = [];
                $this->comaker['profile'] = '';
                $this->comaker['signature'] = '';
                if($cofiles){
                    
                    foreach($cofiles as $cfiles){                      
                        if($cfiles['fileType'] == 'Profile'){
                            $this->comaker['profile'] = $cfiles['filePath'];
                            
                        }

                        if($cfiles['fileType'] == 'File'){
                            $this->comaker['attachments'][] = [ 'fileName' => $cfiles['filePath'] , 'filePath' => $cfiles['filePath'] ];                
                        }

                        if($cfiles['fileType'] == 'Singature'){
                            $this->comaker['signature'] = $cfiles['filePath'];
                        }
                    }                   

                    $this->comaker['old_attachments'] = $this->comaker['attachments'];
                    $this->comaker['old_profile'] = $this->comaker['profile'];   
                    $this->comaker['old_signature'] = $this->comaker['signature'];
                }
                //images and files
            
                $this->member['fname'] = $data['fname'];  
                $this->member['lname'] = $data['lname'];
                $this->member['mname'] = $data['mname'];
                $this->member['suffix'] = $data['suffix']; 
                $this->member['age'] = $data['age'];         
                $this->member['barangay'] = $data['barangay'];  
                if($this->member['statusID'] != 7){                 
                    $this->barangays->put(1, ['brgyDesc' => $data['barangay']]);        
                }
                $this->member['city'] = $data['city'];   
                if($this->member['statusID'] != 7){                
                    $this->cities->put(1, ['citymunDesc' => $data['city']]);          
                }                           
                $this->member['civil_Status'] = $data['civil_Status'];  
                $this->member['cno'] = $data['cno']; 
                $this->member['country'] = $data['country']; 
                $this->member['dob'] = date('Y-m-d', strtotime($data['dob']));
                $this->member['emailAddress'] = $data['emailAddress']; 
                $this->member['gender'] = $data['gender'];
                $this->member['houseNo'] = $data['houseNo'];
                $this->member['house_Stats'] = $data['houseStatusId'];          
                $this->member['pob'] = $data['pob'];
                $this->member['province'] = $data['province']; 
                if($this->member['statusID'] != 7){                   
                    $this->provinces->put(1, ['provDesc' => $data['province']]);                  
                } 
                $this->member['yearsStay'] = $data['yearsStay'];
                $this->member['zipCode'] = $data['zipCode'];
                $this->member['status'] = $data['status'];              
                $this->member['electricBill'] = $data['electricBill']; 
                $this->member['waterBill'] = $data['waterBill']; 
                $this->member['otherBills'] = $data['otherBills']; 
                $this->member['dailyExpenses'] = $data['dailyExpenses']; 
                $this->member['jobDescription'] = $data['jobDescription']; 
                $this->member['yos'] = $data['yos']; 
                $this->member['monthlySalary'] = $data['monthlySalary']; 
                $this->member['otherSOC'] = $data['otherSOC']; 
                $this->member['bO_Status'] = $data['bO_Status'] == 'True' ? 1 : 0;               
                $this->member['companyName'] = $data['companyName'];
                $this->member['companyAddress'] = $data['companyAddress'];  
                $this->member['emp_Status'] = $data['emp_Status'];              
                $this->member['f_Fname'] = $data['f_Fname']; 
                $this->member['f_Lname'] = $data['f_Lname']; 
                $this->member['f_Mname'] = $data['f_Mname']; 
                $this->member['f_Suffix'] = $data['f_Suffix']; 
                $this->member['f_DOB'] = date('Y-m-d', strtotime($data['f_DOB'])); 
                $this->member['f_Age'] = $data['f_Age']; 
                $this->member['f_NOD'] = $data['f_NOD']; 
                $this->member['f_YOS'] = $data['f_YOS']; 
                $this->member['f_Emp_Status'] = $data['f_Emp_Status']; 
                $this->member['f_Job'] = $data['f_Job']; 
                $this->member['f_CompanyName'] = $data['f_CompanyName']; 
                $this->member['f_RTTB'] = $data['f_RTTB'];    
                $this->member['famId'] = $data['famId'];     
                $this->member['loanAmount'] = !empty($data['individualLoan'][0]['loanAmount']) ?$data['individualLoan'][0]['loanAmount'] : 0; //$data['loanAmount'];  cant find in api
                $this->member['termsOfPayment'] = $data['individualLoan'][0]['nameOfTerms'];
                $this->member['purpose'] = $data['purpose'];                
           
                $this->comaker['co_Fname'] = $data['co_Fname']; 
                $this->comaker['co_Lname'] = $data['co_Lname']; 
                $this->comaker['co_Mname'] = $data['co_Mname']; 
                $this->comaker['co_Suffix'] = $data['co_Suffix']; 
                $this->comaker['co_Age'] = $data['co_Age']; 
                $this->comaker['co_Barangay'] = $data['co_Barangay']; 
                $this->comaker['co_City'] = $data['co_City']; 
                $this->comaker['co_Civil_Status'] = $data['co_Civil_Status']; 
                $this->comaker['co_Cno'] = $data['co_Cno']; 
                $this->comaker['co_Country'] = $data['co_Country']; 
                $this->comaker['co_DOB'] = $data['co_DOB']; 
                $this->comaker['co_EmailAddress'] = $data['co_EmailAddress']; 
                $this->comaker['co_Gender'] = $data['co_Gender']; 
                $this->comaker['co_HouseNo'] = $data['co_HouseNo'];         
                $this->comaker['co_House_Stats'] = $data['co_HouseStatusId']; 
                $this->comaker['co_POB'] = $data['co_POB']; 
                $this->comaker['co_Province'] = $data['co_Province']; 
                
                if($this->member['statusID'] != 7){                  
                    $this->cobarangays->put(1, ['brgyDesc' => $data['co_Barangay']]);        
                }
                $this->member['city'] = $data['city'];   
                if($this->member['statusID'] != 7){                 
                    $this->cocities->put(1, ['citymunDesc' => $data['co_City']]);    
                }            
                if($this->member['statusID'] != 7){                   
                    $this->coprovinces->put(1, ['provDesc' => $data['co_Province']]);    
                } 
                $this->comaker['co_YearsStay'] = $data['co_YearsStay']; 
                $this->comaker['co_ZipCode'] = $data['co_ZipCode']; 
                $this->comaker['co_RTTB'] = $data['co_RTTB']; 
                $this->comaker['co_Status'] = ''; 
                $this->comaker['co_JobDescription'] = $data['co_JobDescription']; 
                $this->comaker['co_YOS'] = $data['co_YearsStay'];  
                $this->comaker['co_MonthlySalary'] = $data['co_MonthlySalary']; 
                $this->comaker['co_OtherSOC'] = $data['co_OtherSOC']; 
                $this->comaker['co_BO_Status'] = $data['co_BO_Status'] == "True" ? 1 : 0; 
                $this->comaker['co_CompanyName'] = $data['co_CompanyName']; 
                $this->comaker['co_CompanyID'] = $data['co_CompanyAddress']; 
                $this->comaker['co_Emp_Status'] = $data['co_Emp_Status'];                
                //dd($data);
                // $this->cntmemchild
                
                $child = $data['child'];              
                if(count($child) > 0){
                    $this->cntmemchild = [];
                    $cntchild = 0;
                    foreach($child as $mchild){     
                        $cntchild = $cntchild + 1;               
                        $this->cntmemchild[] = $cntchild;
                        $this->inpchild['fname'.$cntchild] = $mchild['fname'];   
                        $this->inpchild['mname'.$cntchild] = $mchild['mname'];                             
                        $this->inpchild['lname'.$cntchild] = $mchild['lname'];  
                        $this->inpchild['age'.$cntchild] = $mchild['age'];    
                        $this->inpchild['school'.$cntchild] = $mchild['nos'];                           
                    }                   
                }                                   

                $businessInfo = $data['business'];   
                //dd($businessInfo);
                if(count($businessInfo)>0){
                    $cntbusinfo = 0;                  
                    foreach($businessInfo as $businfo){
                        $cntbusinfo = $cntbusinfo + 1;
                        $this->businfo[$cntbusinfo] = [ 
                                                        'businessName' => $businfo['businessName'],
                                                        'businessType' => $businfo['businessType'],
                                                        'businessAddress' => $businfo['businessAddress'],                                   
                                                        'b_status' => $businfo['b_statusID'],
                                                        'yob' => $businfo['yob'],
                                                        'noe' => $businfo['noe'],
                                                        'salary' => $businfo['salary'],
                                                        'vos' => $businfo['vos'],
                                                        'aos' => $businfo['aos'],
                                                        'attachments' => $businfo['businessFiles'],
                                                        'old_attachments' => $businfo['businessFiles'],
                                                      ];    
                    }
                }
              
                $motors= $data['assets'];
                if(count($motors) > 0){
                    $this->hasvehicle = 1;
                    $motorscnt = 0;
                    foreach($motors as $mmotors){
                        $motorscnt = $motorscnt + 1;
                        $this->vehicle[$motorscnt] = [ 'vehicle' => $mmotors['motorVehicles'] ];  
                        $this->inpvehicle['vehicle'.$motorscnt] = $mmotors['motorVehicles'];                       
                    }
                }
                else{
                    $this->hasvehicle = 0;
                }
                 
                $properties= $data['property'];
                if(count($properties) > 0){
                    $this->hasproperties = 1;
                    $propertiescnt = 0;
                    foreach($properties as $mproperties){
                        $propertiescnt = $propertiescnt + 1;
                        $this->properties[$propertiescnt] = [ 'property' => $mproperties['property'] ];  
                        $this->inpproperties['property'.$propertiescnt] = $mproperties['property'];                       
                    }
                }       
                else{
                    $this->hasproperties = 0;
                }           

                $appliances= $data['appliances'];
                //dd($appliances);
                if(count($appliances) > 0){                   
                    $appliancescnt = 0;
                    foreach($appliances as $mappliances){
                        $appliancescnt = $appliancescnt + 1;
                        $this->appliances[$appliancescnt] = [ 'appliance' => $mappliances['appliances'], 'brand' => $mappliances['brand'] ];  
                        $this->inpappliances['appliance'.$appliancescnt] = $mappliances['appliances'];   
                        $this->inpappliances['brand'.$appliancescnt] = $mappliances['brand'];                        
                    }
                }   

                $bank= $data['bank'];
                if(count($bank) > 0){                   
                    $bankcnt = 0;
                    foreach($bank as $mbank){
                        $bankcnt = $bankcnt + 1;
                        $this->bank[$bankcnt] = [ 'account' => $mbank['bankName'], 'address' => $mbank['address'] ];  
                        $this->inpbank['account'.$bankcnt] = $mbank['bankName'];   
                        $this->inpbank['address'.$bankcnt] = $mbank['address'];                        
                    }
                }   
                if($this->member['statusID'] == 7){
                    $this->renderCity();
                    $this->renderBarangay();
                    $this->renderCoCity();
                    $this->renderCoBarangay();
                }
              
            }
        }
        else if($this->type == 'add'){
            if($this->naID != ''){             
                $value = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/PostMemberSearching', [['column' => 'tbl_Member_Model.MemId', 'values' => $this->naID]]);                 
                
                $resdata = $value->json();                          
                $data =  $resdata[0];                 

                $this->member['fname'] = $data['fname'];  
                $this->member['lname'] = $data['lname'];
                $this->member['mname'] = $data['mname'];
                $this->member['suffix'] = $data['suffix']; 
                $this->member['age'] = $data['age']; 
                $this->member['barangay'] = $data['barangay'];  
                $this->member['city'] = $data['city']; 
                $this->member['civil_Status'] = $data['civil_Status'];  
                $this->member['cno'] = $data['cno']; 
                $this->member['country'] = $data['country']; 
                $this->member['dob'] = date('Y-m-d', strtotime($data['dob']));
                $this->member['emailAddress'] = $data['emailAddress']; 
                $this->member['gender'] = $data['gender'];
                $this->member['houseNo'] = $data['houseNo'];
                $this->member['house_Stats'] = $data['houseStatus_Id']; 
                $this->member['pob'] = $data['pob'];
                $this->member['province'] = $data['province']; 
                $this->member['yearsStay'] = $data['yearsStay'];
                $this->member['zipCode'] = $data['zipCode'];
            }
            //else{
                // $this->member['fname'] = '1Jumar';  
                // $this->member['lname'] = '1Cave';
                // $this->member['mname'] = '1Badajos';
                // $this->member['suffix'] = ''; 
                // $this->member['age'] = '22'; 
                // // $this->member['barangay'] = 'Rivera';  
                // // $this->member['city'] = 'San Juan'; 
                // $this->member['civil_Status'] = 'Married';  
                // $this->member['cno'] = '02233666666'; 
                // $this->member['country'] = 'Philippines'; 
                // $this->member['dob'] = date('Y-m-d', strtotime('12/27/2000'));
                // $this->member['emailAddress'] = 'test@gmail.com'; 
                // $this->member['gender'] = 'Male';
                // $this->member['houseNo'] = 'No. 9 GB';
                // $this->member['house_Stats'] = '2'; 
                // $this->member['pob'] = 'Bani, Pangasinan';
                // // $this->member['province'] = 'NCR'; 
                // $this->member['yearsStay'] = '5';
                // $this->member['zipCode'] = '';   

                // $this->member['electricBill'] = '250'; 
                // $this->member['waterBill'] = '100'; 
                // $this->member['otherBills'] = '1000'; 
                // $this->member['dailyExpenses'] = '10000'; 
                // $this->member['jobDescription'] = 'Programmer'; 
                // $this->member['yos'] = '7'; 
                // $this->member['monthlySalary'] = '15000'; 
                // $this->member['otherSOC'] = 'Freelancer'; 
                // $this->member['bO_Status'] = '1'; 
                // $this->member['companyName'] = 'SOEN'; 
                // $this->member['emp_Status'] = '1'; 
                // $this->member['f_Fname'] = 'Jezz'; 
                // $this->member['f_Lname'] = 'Eurolfan'; 
                // $this->member['f_Mname'] = 'Javier'; 
                // $this->member['f_Suffix'] = ''; 
                // $this->member['f_DOB'] = date('Y-m-d', strtotime('12/27/2000'));
                // $this->member['f_Age'] = '30'; 
                // $this->member['f_NOD'] = '0'; 
                // $this->member['f_YOS'] = '5'; 
                // $this->member['f_Emp_Status'] = '1'; 
                // $this->member['f_Job'] = 'Cashier'; 
                // $this->member['f_CompanyName'] = 'SOEN'; 
                // $this->member['f_RTTB'] = '';     
             
                // $this->comaker['co_Fname'] = 'Thea'; 
                // $this->comaker['co_Lname'] = 'Badajos'; 
                // $this->comaker['co_Mname'] = 'Eurolfan'; 
                // $this->comaker['co_Suffix'] = ''; 
                // $this->comaker['co_Age'] = '26'; 
                // // $this->comaker['co_Barangay'] = 'Rivera'; 
                // // $this->comaker['co_City'] = 'San Juan'; 
                // $this->comaker['co_Civil_Status'] = 'Single'; 
                // $this->comaker['co_Cno'] = '023369990'; 
                // $this->comaker['co_Country'] = 'Philippines'; 
                // $this->comaker['co_DOB'] = date('Y-m-d', strtotime('12/27/2000'));
                // $this->comaker['co_EmailAddress'] = ''; 
                // $this->comaker['co_Gender'] = 'Female'; 
                // $this->comaker['co_HouseNo'] = '566233';         
                // $this->comaker['co_House_Stats'] = '2'; 
                // $this->comaker['co_POB'] = 'Pangasinan'; 
                // // $this->comaker['co_Province'] = 'Iloilo'; 
                // $this->comaker['co_YearsStay'] = '5'; 
                // $this->comaker['co_ZipCode'] = ''; 
                // $this->comaker['co_RTTB'] = ''; 
                // $this->comaker['co_Status'] = ''; 
                // $this->comaker['co_JobDescription'] = 'Cashier'; 
                // $this->comaker['co_YOS'] = '0'; 
                // $this->comaker['co_MonthlySalary'] = '15000'; 
                // $this->comaker['co_OtherSOC'] = 'none'; 
                // $this->comaker['co_BO_Status'] = '1'; 
                // $this->comaker['co_CompanyName'] = 'SOEN'; 
                // $this->comaker['co_CompanyID'] = 'string'; 
                // $this->comaker['co_Emp_Status'] = '1'; 
                // $this->comaker['remarks'] = ''; 
            //}
            $sessloandetails = session('sessloandetails') !==null ? session('sessloandetails') : null; 
            //dd(  $sessloandetails);
            $this->member['loanAmount'] = isset($sessloandetails['loamamount']) ? $sessloandetails['loamamount'] : '';
            $this->member['termsOfPayment'] = isset($sessloandetails['paymentterms']) ? $sessloandetails['paymentterms'] : '';
            $this->member['purpose'] = isset($sessloandetails['purpose']) ? $sessloandetails['purpose'] : '';

            $this->loanDetails['loanTypeID'] = isset($sessloandetails['loanTypeID']) ? $sessloandetails['loanTypeID'] : '';   
            $this->loanDetails['loantermsID'] = isset($sessloandetails['topId']) ? $sessloandetails['topId'] : '';
            $this->loanDetails['loantermsName'] = $this->member['termsOfPayment'];  
        }
    }

    public function viewApplication($naid = ''){       
        return redirect()->to('/tranactions/application/view/'.$naid);
    }

    public function searchEmployee(){
        $emplist = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/UserRegistration/GetUserListFilter', [ 'page' => 1, 'pageSize' => 50, 'fullname' => $this->searchempkeyword ]);         
        $this->emplist = $emplist->json();          
    }

    public function render()
    {       
        //dd(session()->get('auth_userid'));        
        // $getLoanTermsname = $this->getLoanTermsname(isset($this->loanDetails['topId']) ? $this->loanDetails['topId'] : '');
        return view('livewire.transactions.application.create-application');        
    }
}
