<?php

namespace App\Http\Livewire\Transactions\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class CreateApplication extends Component
{

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
        $rules['member.fname'] = '';  
        $rules['member.lname'] = '';  
        $rules['member.mname'] = '';  
        $rules['member.suffix'] = '';  
        $rules['member.age'] = '';  
        $rules['member.barangay'] = '';  
        $rules['member.city'] = '';  
        $rules['member.civil_Status'] = '';  
        $rules['member.cno'] = ''; 
        $rules['member.country'] = ''; 
        $rules['member.dob'] = ''; 
        $rules['member.emailAddress'] = ''; 
        $rules['member.gender'] = ''; 
        $rules['member.hender'] = ''; 
        $rules['member.houseNo'] = ''; 
        $rules['member.house_Stats'] = ''; 
        $rules['member.pob'] = ''; 
        $rules['member.province'] = ''; 
        $rules['member.yearsStay'] = ''; 
        $rules['member.zipCode'] = ''; 
        $rules['member.status'] = ''; 
        $rules['member.electricBill'] = '';
        $rules['member.waterBill'] = '';
        $rules['member.otherBills'] = '';
        $rules['member.dailyExpenses'] = '';
        $rules['member.jobDescription'] = '';
        $rules['member.yos'] = '';
        $rules['member.monthlySalary'] = '';
        $rules['member.otherSOC'] = '';
        $rules['member.bO_Status'] = '';
        $rules['member.companyName'] = '';
        $rules['member.emp_Status'] = '';
        $rules['member.f_Fname'] = '';
        $rules['member.f_Lname'] = '';
        $rules['member.f_Mname'] = '';
        $rules['member.f_Suffix'] = '';
        $rules['member.f_DOB'] = '';
        $rules['member.f_Age'] = '';
        $rules['member.f_NOD'] = '';
        $rules['member.f_YOS'] = '';
        $rules['member.f_Emp_Status'] = '';
        $rules['member.f_Job'] = '';
        $rules['member.f_CompanyName'] = '';
        $rules['member.f_RTTB'] = '';      
        $rules['member.loanAmount'] = '';
        $rules['member.termsOfPayment'] = '';
        $rules['member.purpose'] = '';

        $rules['comaker.co_Fname'] = '';
        $rules['comaker.co_Lname'] = '';
        $rules['comaker.co_Mname'] = '';
        $rules['comaker.co_Suffix'] = '';
        $rules['comaker.co_Age'] = '';
        $rules['comaker.co_Barangay'] = '';
        $rules['comaker.co_City'] = '';
        $rules['comaker.co_Civil_Status'] = '';
        $rules['comaker.co_Cno'] = '';
        $rules['comaker.co_Country'] = '';
        $rules['comaker.co_DOB'] = '';
        $rules['comaker.co_EmailAddress'] = '';
        $rules['comaker.co_Gender'] = '';
        $rules['comaker.co_HouseNo'] = '';
        $rules['comaker.co_HouseNo'] = '';
        $rules['comaker.co_House_Stats'] = '';
        $rules['comaker.co_POB'] = '';
        $rules['comaker.co_Province'] = '';
        $rules['comaker.co_YearsStay'] = '';
        $rules['comaker.co_ZipCode'] = '';
        $rules['comaker.co_RTTB'] = '';
        $rules['comaker.co_Status'] = '';
        $rules['comaker.co_JobDescription'] = '';
        $rules['comaker.co_YOS'] = '';
        $rules['comaker.co_MonthlySalary'] = '';
        $rules['comaker.co_OtherSOC'] = '';
        $rules['comaker.co_BO_Status'] = '';
        $rules['comaker.co_CompanyName'] = '';
        $rules['comaker.co_CompanyID'] = '';
        $rules['comaker.co_Emp_Status'] = '';
        $rules['comaker.remarks'] = '';
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
        return $messages;        
    }

    public function store(){               
        try {                  
            $input = $this->validate(); 

            //get child inputs
            $childs = [];
            $businesses = [];
            $appliances = [];
            $banks = [];
         
            // if(count($this->cntmemchild) > 0){
            //     foreach($this->cntmemchild as $cntmemchild){
            //         $childs[] = [   'fname' => $this->inpchild['fname'.$cntmemchild] ??= '', 
            //                         'mname' => $this->inpchild['mname'.$cntmemchild] ??= '',
            //                         'lname' => $this->inpchild['lname'.$cntmemchild] ??= '',
            //                         'age' => $this->inpchild['age'.$cntmemchild] ??= '0',
            //                         'nos' => $this->inpchild['school'.$cntmemchild] ??= '',
            //                         'famId' => null,    ];
            //     }
            // }
           
            // if(count( $this->businfo) > 0){
            //     foreach($this->businfo as $key => $value){
            //         $businesses[] = [   'businessName' => $value['businessName'], 
            //                         'businessType' => $value['businessType'],
            //                         'businessAddress' => $value['businessAddress'],
            //                         'b_status' => $value['b_status'],
            //                         'yob' => $value['yob'],
            //                         'noe' => $value['noe'],
            //                         'salary' => $value['salary'],
            //                         'vos' => $value['vos'],
            //                         'aos' => $value['aos']    ];
            //     }
            // }

            if(count( $this->appliances) > 0){
                foreach($this->appliances as $key => $value){
                    $appliances[] = [   'brand' => $this->inpappliances['applaince'.$key], 
                                        'appliances' => $this->inpappliances['brand'.$key],
                                        'naid' => ''   ];
                }
            }

            if(count( $this->bank) > 0){
                foreach($this->bank as $key => $value){
                    $banks[] = [   'bankName' => $this->inpbank['account'.$key], 
                                   'address' => $this->inpbank['address'.$key]   ];
                }
            }

            // dd();
            //dito
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
                                "f_Emp_Status"=> '1', //$input['member']['f_Emp_Status'], //err
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
                                "remarks"=> ''
                    ]];
                    // dd($data);            
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/SaveAll', $data);                
            dd($crt);
        }
        catch (\Exception $e) {           
            throw $e;            
        }
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

    public function mount(){
        $this->member['civil_Status'] = '';       
        $this->member['emp_Status'] = '1';
        $this->member['f_Emp_Status'] = '';
        $this->member['bO_Status'] = 1;
        $this->cntmemchild = [1];        
        $this->vehicle[1] = [  'vehicle' => '' ];
        $this->properties[1] = [  'property' => '' ];
        $this->appliances[1] = [  'appliance' => '', 'brand' => '' ];
        $this->bank[1] = [  'account' => '', 'address' => '' ];

        $this->comaker['co_Emp_Status'] = '1';
    }

    public function render()
    {
        
        return view('livewire.transactions.application.create-application');
    }
}
