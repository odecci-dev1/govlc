<?php

namespace App\Http\Livewire\Transactions\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use App\Traits\Common;

use Livewire\Component;

class CreateApplication extends Component
{

    use Common;

    public $naID;
    public $searchedmemId;
    public $test = 'hello';
    public $type;
    public $member; 
    public $comaker;

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
    
    public function rules(){                
        $rules = [];      
        $rules['member.fname'] = 'required';  
        $rules['member.lname'] = 'required';  
        $rules['member.mname'] = 'required';  
        $rules['member.suffix'] = '';  
        $rules['member.age'] = 'required';  
        $rules['member.barangay'] = 'required';  
        $rules['member.city'] = 'required';  
        $rules['member.civil_Status'] = 'required';  
        $rules['member.cno'] = 'required'; 
        $rules['member.country'] = 'required'; 
        $rules['member.dob'] = 'required'; 
        $rules['member.emailAddress'] = 'required'; 
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
        $rules['member.jobDescription'] = 'required';
        $rules['member.yos'] = 'required';
        $rules['member.monthlySalary'] = 'required';
        $rules['member.otherSOC'] = 'required';
        $rules['member.bO_Status'] = 'required';
        $rules['member.companyName'] = 'required';
        $rules['member.emp_Status'] = 'required';
        $rules['member.f_Fname'] = 'required';
        $rules['member.f_Lname'] = 'required';
        $rules['member.f_Mname'] = 'required';
        $rules['member.f_Suffix'] = '';
        $rules['member.f_DOB'] = 'required';
        $rules['member.f_Age'] = 'required';
        $rules['member.f_NOD'] = 'required';
        $rules['member.f_YOS'] = 'required';
        $rules['member.f_Emp_Status'] = 'required';
        $rules['member.f_Job'] = 'required';
        $rules['member.f_CompanyName'] = 'required';
        $rules['member.f_RTTB'] = '';      
        $rules['member.loanAmount'] = 'required';
        $rules['member.termsOfPayment'] = 'required';
        $rules['member.purpose'] = 'required';

        $rules['comaker.co_Fname'] = 'required';
        $rules['comaker.co_Lname'] = 'required';
        $rules['comaker.co_Mname'] = 'required';
        $rules['comaker.co_Suffix'] = '';
        $rules['comaker.co_Age'] = 'required';
        $rules['comaker.co_Barangay'] = 'required';
        $rules['comaker.co_City'] = 'required';
        $rules['comaker.co_Civil_Status'] = 'required';
        $rules['comaker.co_Cno'] = 'required';
        $rules['comaker.co_Country'] = 'required';
        $rules['comaker.co_DOB'] = 'required';
        $rules['comaker.co_EmailAddress'] = 'required';
        $rules['comaker.co_Gender'] = 'required';
        $rules['comaker.co_HouseNo'] = 'required';
        $rules['comaker.co_House_Stats'] = 'required';
        $rules['comaker.co_POB'] = 'required';
        $rules['comaker.co_Province'] = 'required';
        $rules['comaker.co_YearsStay'] = 'required';
        $rules['comaker.co_ZipCode'] = '';
        $rules['comaker.co_RTTB'] = '';
        $rules['comaker.co_Status'] = '';
        $rules['comaker.co_JobDescription'] = 'required';
        $rules['comaker.co_YOS'] = 'required';
        $rules['comaker.co_MonthlySalary'] = 'required';
        $rules['comaker.co_OtherSOC'] = 'required';
        $rules['comaker.co_BO_Status'] = 'required';
        $rules['comaker.co_CompanyName'] = 'required';
        $rules['comaker.co_CompanyID'] = '';
        $rules['comaker.co_Emp_Status'] = 'required';
        $rules['comaker.remarks'] = '';      
        

        if(isset($this->member['civil_Status'])){
            if($this->member['civil_Status'] == 'Married' || $this->member['civil_Status']=='Single'){
                if(count($this->cntmemchild) > 1){
                    foreach($this->cntmemchild as $cntchild){
                        $rules['inpchild.fname'.$cntchild] = 'required';   
                        $rules['inpchild.mname'.$cntchild] = 'required';      
                        $rules['inpchild.lname'.$cntchild] = 'required';      
                        $rules['inpchild.age'.$cntchild] = 'required';      
                        $rules['inpchild.school'.$cntchild] = 'required';                  
                    }            
                }
                else{
                    //if(isset($this->inpchild['fname1']) || isset($this->inpchild['mname1']) || isset($this->inpchild['lname1']) || isset($this->inpchild['age1']) || isset($this->inpchild['school1'])){
                    if((isset($this->inpchild['fname1']) ? $this->inpchild['fname1'] != '' : false)  || (isset($this->inpchild['mname1']) ? $this->inpchild['mname1'] != '' : false) || (isset($this->inpchild['lname1']) ? $this->inpchild['lname1'] != '' : false) || (isset($this->inpchild['age1']) ? $this->inpchild['age1'] != '' : false) || (isset($this->inpchild['school1']) ? $this->inpchild['school1'] != '' : false)){
                        $rules['inpchild.fname1'] = 'required';      
                        $rules['inpchild.mname1'] = 'required';      
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
                $rules['inpappliances.applaince'.$key] = 'required';               
                $rules['inpappliances.brand'.$key] = 'required';               
            }            
        }
        else{            
            if((isset($this->inpappliances['applaince1']) ? $this->inpappliances['applaince1'] != '' : false)  || (isset($this->inpappliances['brand1']) ? $this->inpappliances['brand1'] != '' : false)){
                $rules['inpappliances.applaince1'] = 'required';               
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
        $messages['member.fname.required'] = 'First name is required';        
        $messages['member.lname.required'] = 'Last name is required';             
        $messages['member.mname.required'] = 'Middle name is required';  
        $messages['member.age.required'] = 'Age is required';    
        $messages['member.barangay.required'] = 'Barangay is required';  
        $messages['member.city.required'] = 'City is required';  
        $messages['member.civil_Status.required'] = 'Civil Status is required';  
        $messages['member.cno.required'] = 'Contact number is required';  
        $messages['member.country.required'] = 'Country is required';  
        $messages['member.dob.required'] = 'Date of birth is required';  
        $messages['member.emailAddress.required'] = 'Email address is required';  
        $messages['member.gender.required'] = 'Gender is required';            
        $messages['member.houseNo.required'] = 'House no. is required';            
        $messages['member.house_Stats.required'] = 'Select one option';            
        $messages['member.pob.required'] = 'Place of birth is required';            
        $messages['member.province.required'] = 'Province is required';            
        $messages['member.yearsStay.required'] = 'Enter year of stay';            
        $messages['member.electricBill.required'] = 'Enter electric bill';  
        $messages['member.waterBill.required'] = 'Enter water bill';  
        $messages['member.otherBills.required'] = 'Enter other bills';  
        $messages['member.dailyExpenses.required'] = 'Enter daily expenses';  
        $messages['member.jobDescription.required'] = 'Enter job description';  
        $messages['member.yos.required'] = 'Enter years of service';  
        $messages['member.monthlySalary.required'] = 'Enter monthly salary';    
        $messages['member.otherSOC.required'] = 'Enter other source of income';
        $messages['member.bO_Status.required'] = 'Enter business status';
        $messages['member.companyName.required'] = 'Enter company name';
        $messages['member.emp_Status.required'] = 'Enter employment status';
        $messages['member.f_Fname.required'] = 'Enter first name';
        $messages['member.f_Lname.required'] = 'Enter last name';
        $messages['member.f_Mname.required'] = 'Enter middle name';
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
                $messages['inpappliances.applaince'.$key.'.required'] = 'Enter appliance name';      
                $messages['inpappliances.brand'.$key.'.required'] = 'Enter brand';             
            }            
        }
        else{            
            if((isset($this->inpappliances['applaince1']) ? $this->inpappliances['applaince1'] != '' : false)  || (isset($this->inpappliances['brand1']) ? $this->inpappliances['brand1'] != '' : false)){               
                $messages['inpappliances.applaince1.required'] = 'Enter appliance name';      
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
        return $messages;        
    }

    public function store(){               
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
                                    'aos' => $value['aos']    ];
                }
            }

            if(count( $this->appliances) > 0){
                if((isset($this->inpappliances['applaince1']) ? $this->inpappliances['applaince1'] != '' : false)  || (isset($this->inpappliances['brand1']) ? $this->inpappliances['brand1'] != '' : false)){
                    foreach($this->appliances as $key => $value){
                        $appliances[] = [   'brand' => $this->inpappliances['applaince'.$key], 
                                            'appliances' => $this->inpappliances['brand'.$key],
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
                                "yos"=> $input['member']['yos'] ??= '0',
                                "monthlySalary"=> $input['member']['monthlySalary'] ??= '0',
                                "otherSOC"=> $input['member']['otherSOC'] ??= '',
                                "bO_Status"=> $input['member']['bO_Status'] ??= '0',
                                "companyName"=> $input['member']['companyName'] ??= '',
                                "emp_Status"=> $input['member']['emp_Status'] ??= '0',
                                "f_Fname"=> $input['member']['f_Fname'] ??= '',
                                "f_Lname"=> $input['member']['f_Lname'] ??= '',
                                "f_Mname"=> $input['member']['f_Mname'] ??= '',
                                "f_Suffix"=> $input['member']['f_Suffix'] ??= '',
                                "f_DOB"=> null,
                                "f_Age"=> $input['member']['f_Age'] ??= '0',
                                "f_NOD"=> $input['member']['f_NOD'] ??= '0',
                                "f_YOS"=> $input['member']['f_YOS'] ??= '0',
                                "f_Emp_Status"=> '1', 
                                "f_Job"=> $input['member']['f_Job'] ??= '',
                                "f_CompanyName"=> $input['member']['f_CompanyName'] ??= '',
                                "f_RTTB"=> '',
                                "business"=> $businesses,
                                "loanAmount"=> $input['member']['loanAmount'] ??= '0',
                                "termsOfPayment"=> $input['member']['termsOfPayment'] ??= '',
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
                                "co_RTTB"=> '',
                                "co_Status"=> '1',
                                "co_JobDescription"=> $input['comaker']['co_JobDescription'] ??= '',
                                "co_YOS"=> $input['comaker']['co_YOS'] ??= '0',
                                "co_MonthlySalary"=> $input['comaker']['co_MonthlySalary'] ??= '0',
                                "co_OtherSOC"=> $input['comaker']['co_OtherSOC'] ??= '',
                                "co_BO_Status"=> $input['comaker']['co_BO_Status'] ??= '0',
                                "co_CompanyName"=> $input['comaker']['co_CompanyName'] ??= '',
                                "co_CompanyID"=> $input['comaker']['co_CompanyID'] ??= '',
                                "co_Emp_Status"=> '1', //$input['comaker']['co_Emp_Status'],
                                "remarks"=> '',
                                "applicationStatus" => '7'
                    ]];
                    // dd($data);   
                    
                    // $extension = $request->file('filename')->getClientOriginalExtension();
                 
            if($this->type == 'create'){                            
                $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/SaveAll', $data);  
                $getlast = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Application/GetLastApplication');                 
                $getlast = $getlast->json();
                return redirect()->to('/tranactions/application/view/'.$getlast['naid'])->with(['mmessage'=> 'Application successfully saved', 'mword'=> 'Success']);    
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
                    return redirect()->to('/tranactions/application/group/create');
                }
            }
        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function update($type = 1){             
        try {                                  
            $this->resetValidation();          
            $input = $this->validate();          
            $childs = [];
            $businesses = [];
            $appliances = [];
            $banks = [];
         
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
                                    'aos' => $value['aos']    ];
                }
            }

            if(count( $this->appliances) > 0){
                if((isset($this->inpappliances['applaince1']) ? $this->inpappliances['applaince1'] != '' : false)  || (isset($this->inpappliances['brand1']) ? $this->inpappliances['brand1'] != '' : false)){
                    foreach($this->appliances as $key => $value){
                        $appliances[] = [   'brand' => $this->inpappliances['applaince'.$key], 
                                            'appliances' => $this->inpappliances['brand'.$key],
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
            $bdate = date('Y-m-d', strtotime($input['member']['dob']));
            //dd($input['member']['house_Stats']);
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
                            "house_Stats"=> 2, //mali owned and lumalabas $input['member']['house_Stats'] ??= '0',
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
                            "yos"=> $input['member']['yos'] ??= '0',
                            "monthlySalary"=> $input['member']['monthlySalary'] ??= '0',
                            "otherSOC"=> $input['member']['otherSOC'] ??= '',
                            "bO_Status"=> $input['member']['bO_Status'] ??= '0',
                            "companyName"=> $input['member']['companyName'] ??= '',
                            "emp_Status"=> $input['member']['emp_Status'] ??= '0',
                            "f_Fname"=> $input['member']['f_Fname'] ??= '',
                            "f_Lname"=> $input['member']['f_Lname'] ??= '',
                            "f_Mname"=> $input['member']['f_Mname'] ??= '',
                            "f_Suffix"=> $input['member']['f_Suffix'] ??= '',
                            "f_DOB"=> null, //mali
                            "f_Age"=> $input['member']['f_Age'] ??= '0',
                            "f_NOD"=> $input['member']['f_NOD'] ??= '0',
                            "f_YOS"=> $input['member']['f_YOS'] ??= '0',
                            "f_Emp_Status"=> '1', 
                            "f_Job"=> $input['member']['f_Job'] ??= '',
                            "f_CompanyName"=> $input['member']['f_CompanyName'] ??= '',
                            "f_RTTB"=> '',
                            "business"=> $businesses,
                            "loanAmount"=> $input['member']['loanAmount'] ??= '0',
                            "termsOfPayment"=> $input['member']['termsOfPayment'] ??= '',
                            "purpose"=> $input['member']['purpose'] ??= '',
                            "child"=> $childs,
                            "appliances"=> $appliances,
                            "property"=> [],
                            "assets"=> [],
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
                            "co_House_Stats"=> 2, //mali $input['comaker']['co_House_Stats'] ??= '0',
                            "co_POB"=> $input['comaker']['co_POB'] ??= '',
                            "co_Province"=> $input['comaker']['co_Province'] ??= '',
                            "co_YearsStay"=> $input['comaker']['co_YearsStay'] ??= '0',
                            "co_ZipCode"=> $input['comaker']['co_ZipCode'] ??= '',
                            "co_RTTB"=> '',
                            "co_Status"=> '1',
                            "co_JobDescription"=> $input['comaker']['co_JobDescription'] ??= '',
                            "co_YOS"=> $input['comaker']['co_YOS'] ??= '0',
                            "co_MonthlySalary"=> $input['comaker']['co_MonthlySalary'] ??= '0',
                            "co_OtherSOC"=> $input['comaker']['co_OtherSOC'] ??= '',
                            "co_BO_Status"=> $input['comaker']['co_BO_Status'] ??= '0',
                            "co_CompanyName"=> $input['comaker']['co_CompanyName'] ??= '',
                            "co_CompanyID"=> $input['comaker']['co_CompanyID'] ??= '',
                            "co_Emp_Status"=> '1', //$input['comaker']['co_Emp_Status'],
                            "remarks"=> '',
                            "applicationStatus" => 8,
                        ]
                    ];
                                                           
                    // $extension = $request->file('filename')->getClientOriginalExtension();
                 
                    $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/UpdateMemberInfo', $data);  
                    return redirect()->to('/tranactions/application/view/'.$this->naID)->with(['mmessage'=> 'Application successfully updated', 'mword'=> 'Success']);
        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function getmemberAge(){
        $age = $this->calculateAge($this->member['dob']);
        $this->member['age'] = $age;           
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
                                ]);

        $this->businfo[$lastcnt + 1] = [  'businessName' => $data['membusinfo']['businessName'],
                                          'businessType' => $data['membusinfo']['businessType'],
                                          'businessAddress' => $data['membusinfo']['businessAddress'],                                         
                                          'b_status' => $data['membusinfo']['b_status'],
                                          'yob' => $data['membusinfo']['yob'],
                                          'noe' => $data['membusinfo']['noe'],
                                          'salary' => $data['membusinfo']['salary'],
                                          'vos' => $data['membusinfo']['vos'],
                                          'aos' => $data['membusinfo']['aos']
                                        ];

        $this->resetmembusinfo();                        
    }

    public function resetmembusinfo(){
        $this->membusinfo['businessName'] = '';
        $this->membusinfo['businessType'] = '';
        $this->membusinfo['businessAddress'] = '';
        $this->membusinfo['b_status'] = '';
        $this->membusinfo['yob'] = '';
        $this->membusinfo['noe'] = '';
        $this->membusinfo['salary'] = '';
        $this->membusinfo['vos'] = '';
        $this->membusinfo['aos'] = '';
    }

    public function mount($type = '1'){
        $this->type = $type;     
        $this->member['civil_Status'] = '';       
        $this->member['emp_Status'] = '';
        $this->member['f_Emp_Status'] = '';
        $this->member['bO_Status'] = '';
        $this->cntmemchild = [1];        
        $this->vehicle[1] = [  'vehicle' => '' ];
        $this->properties[1] = [  'property' => '' ];
        $this->appliances[1] = [  'appliance' => '', 'brand' => '' ];
        $this->bank[1] = [  'account' => '', 'address' => '' ];

        $this->comaker['co_Emp_Status'] = '';

        $loandetails = session('sessloandetails') !==null ? session('sessloandetails') : null; 
        $this->member['loanAmount'] = isset($loandetails['loamamount']) ? $loandetails['loamamount'] : '';
        $this->member['termsOfPayment'] = isset($loandetails['paymentterms']) ? $loandetails['paymentterms'] : '';
        $this->member['purpose'] = isset($loandetails['purpose']) ? $loandetails['purpose'] : '';

        if($this->type == 'create'){
                $this->member['fname'] = '1Jumar';  
                $this->member['lname'] = '1Cave';
                $this->member['mname'] = '1Badajos';
                $this->member['suffix'] = ''; 
                $this->member['age'] = '20'; 
                $this->member['barangay'] = 'Rivera';  
                $this->member['city'] = 'San Juan'; 
                $this->member['civil_Status'] = 'Married';  
                $this->member['cno'] = '02233666666'; 
                $this->member['country'] = 'Philippines'; 
                $this->member['dob'] = date('Y-m-d', strtotime('12/27/1991'));
                $this->member['emailAddress'] = 'test@gmail.com'; 
                $this->member['gender'] = 'Male';
                $this->member['houseNo'] = 'No. 9 GB';
                $this->member['house_Stats'] = '2'; 
                $this->member['pob'] = 'Bani, Pangasinan';
                $this->member['province'] = 'NCR'; 
                $this->member['yearsStay'] = '5';
                $this->member['zipCode'] = '';            
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
                $this->member['termsOfPayment'] = '12 months'; 
                $this->member['purpose'] = 'For Business'; 
        
                $this->comaker['co_Fname'] = 'Thea'; 
                $this->comaker['co_Lname'] = 'Badajos'; 
                $this->comaker['co_Mname'] = 'Eurolfan'; 
                $this->comaker['co_Suffix'] = ''; 
                $this->comaker['co_Age'] = '26'; 
                $this->comaker['co_Barangay'] = 'Rivera'; 
                $this->comaker['co_City'] = 'San Juan'; 
                $this->comaker['co_Civil_Status'] = 'Single'; 
                $this->comaker['co_Cno'] = '023369990'; 
                $this->comaker['co_Country'] = 'Philippines'; 
                $this->comaker['co_DOB'] = date('Y-m-d', strtotime('12/27/1991'));
                $this->comaker['co_EmailAddress'] = 'test@gmail.com'; 
                $this->comaker['co_Gender'] = 'Female'; 
                $this->comaker['co_HouseNo'] = '566233';         
                $this->comaker['co_House_Stats'] = '2'; 
                $this->comaker['co_POB'] = 'Pangasinan'; 
                $this->comaker['co_Province'] = 'Iloilo'; 
                $this->comaker['co_YearsStay'] = '5'; 
                $this->comaker['co_ZipCode'] = ''; 
                $this->comaker['co_RTTB'] = ''; 
                $this->comaker['co_Status'] = ''; 
                $this->comaker['co_JobDescription'] = 'Cashier'; 
                $this->comaker['co_YOS'] = '0'; 
                $this->comaker['co_MonthlySalary'] = '15000'; 
                $this->comaker['co_OtherSOC'] = 'none'; 
                $this->comaker['co_BO_Status'] = '1'; 
                $this->comaker['co_CompanyName'] = 'SOEN'; 
                $this->comaker['co_CompanyID'] = ''; 
                $this->comaker['co_Emp_Status'] = '1'; 
                $this->comaker['remarks'] = ''; 
        }
        else if($this->type == 'view'){
            $value = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/ApplicationMemberDetails', ['applicationID' => $this->naID]); 
            $resdata = $value->json();             
            if(isset($resdata[0])){        
                $data =  $resdata[0];
            
                $this->searchedmemId =  $data['memId'];
            
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
                $this->member['dob'] = date('m/d/Y', strtotime($data['dob']));
                $this->member['emailAddress'] = $data['emailAddress']; 
                $this->member['gender'] = $data['gender'];
                $this->member['houseNo'] = $data['houseNo'];
                $this->member['house_Stats'] = $data['houseStatusId']; 
                $this->member['pob'] = $data['pob'];
                $this->member['province'] = $data['province']; 
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
                $this->member['bO_Status'] = $data['bO_Status']; 
                $this->member['companyName'] = $data['companyName']; 
                $this->member['emp_Status'] = $data['emp_Status']; 
                $this->member['f_Fname'] = $data['f_Fname']; 
                $this->member['f_Lname'] = $data['f_Lname']; 
                $this->member['f_Mname'] = $data['f_Mname']; 
                $this->member['f_Suffix'] = $data['f_Suffix']; 
                $this->member['f_DOB'] = $data['f_DOB']; 
                $this->member['f_Age'] = $data['f_Age']; 
                $this->member['f_NOD'] = $data['f_NOD']; 
                $this->member['f_YOS'] = $data['f_YOS']; 
                $this->member['f_Emp_Status'] = $data['f_Emp_Status']; 
                $this->member['f_Job'] = $data['f_Job']; 
                $this->member['f_CompanyName'] = $data['f_CompanyName']; 
                $this->member['f_RTTB'] = $data['f_RTTB'];     
                $this->member['loanAmount'] = $data['loanAmount']; 
                $this->member['termsOfPayment'] = $data['termsOfPayment']; 
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
                $this->comaker['co_YearsStay'] = $data['co_YearsStay']; 
                $this->comaker['co_ZipCode'] = $data['co_ZipCode']; 
                $this->comaker['co_RTTB'] = $data['co_RTTB']; 
                $this->comaker['co_Status'] = ''; 
                $this->comaker['co_JobDescription'] = $data['co_JobDescription']; 
                $this->comaker['co_YOS'] = $data['co_YearsStay'];  
                $this->comaker['co_MonthlySalary'] = $data['co_MonthlySalary']; 
                $this->comaker['co_OtherSOC'] = $data['co_OtherSOC']; 
                $this->comaker['co_BO_Status'] = $data['co_BO_Status'] == true ? 1 : 0; 
                $this->comaker['co_CompanyName'] = $data['co_CompanyName']; 
                $this->comaker['co_CompanyID'] = ''; 
                $this->comaker['co_Emp_Status'] = $data['co_Emp_Status']; 
                $this->comaker['remarks'] = '';    
                
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
            }
        }
        else if($this->type == 'add'){
            
        }
    }

    public function render()
    {       
        return view('livewire.transactions.application.create-application');        
    }
}
