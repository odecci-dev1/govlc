<?php

namespace App\Http\Livewire\Transactions\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class CreateApplication extends Component
{

    public $member; 
    public $cntmemchild;
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
        $rules['member.Suffix'] = '';  
        $rules['member.Age'] = 'required';  
        $rules['member.Barangay'] = 'required';  
        $rules['member.City'] = 'required';  
        $rules['member.Civil_Status'] = 'required';  
        $rules['member.Cno'] = 'required'; 
        $rules['member.Country'] = 'required'; 
        $rules['member.DOB'] = 'required'; 
        $rules['member.EmailAddress'] = 'required'; 
        $rules['member.Gender'] = 'required'; 
        $rules['member.HouseNo'] = 'required'; 
        $rules['member.House_Stats'] = 'required'; 
        $rules['member.POB'] = 'required'; 
        $rules['member.Province'] = 'required'; 
        $rules['member.YearsStay'] = 'required'; 
        $rules['member.ZipCode'] = ''; 
        $rules['member.Status'] = ''; 
        return  $rules;
    }

    public function messages(){
        $messages = [];
        $messages['member.Fname.required'] = 'First name is required';        
        $messages['member.Lname.required'] = 'Last name is required';             
        $messages['member.Mname.required'] = 'Middle name is required';  
        $messages['member.Age.required'] = 'Age is required';    
        $messages['member.Barangay.required'] = 'Barangay is required';  
        $messages['member.City.required'] = 'City is required';  
        $messages['member.Civil_Status.required'] = 'Civil Status is required';  
        $messages['member.Cno.required'] = 'Contact number is required';  
        $messages['member.Country.required'] = 'Country is required';  
        $messages['member.DOB.required'] = 'Date of birth is required';  
        $messages['member.EmailAddress.required'] = 'Email address is required';  
        $messages['member.Gender.required'] = 'Gender is required';            
        $messages['member.HouseNo.required'] = 'House no. is required';            
        $messages['member.House_Stats.required'] = 'Select one option';            
        $messages['member.POB.required'] = 'Place of birth is required';            
        $messages['member.Province.required'] = 'Province is required';            
        $messages['member.YearsStay.required'] = 'Enter year of stay';                        
        return $messages;        
    }

    public function store(){               
        try {             
            // $input = $this->validate();         
            $input['member'] =            [["fname"=> "1",
                                "lname"=> "2",
                                "mname"=> "3",
                                "suffix"=> "asss",
                                "age"=> "string",
                                "barangay"=> "string",
                                "city"=> "string",
                                "civil_Status"=> "string",
                                "cno"=> "string",
                                "country"=> "string",
                                "dob"=> '2023-07-15',
                                "emailAddress"=> "string",
                                "gender"=> "string",
                                "houseNo"=> "string",
                                "house_Stats"=> '0',
                                "pob"=> "string",
                                "province"=> "string",
                                "yearsStay"=> '0',
                                "zipCode"=> "string",
                                "status"=> '1',
                                "dateCreated"=> null,
                                "dateUpdated"=> null,
                                "memId"=> "string",
                                "electricBill"=> '0',
                                "waterBill"=> '0',
                                "otherBills"=> '0',
                                "dailyExpenses"=> '0',
                                "jobDescription"=> "string",
                                "yos"=> '0',
                                "monthlySalary"=> '0',
                                "otherSOC"=> "string",
                                "bO_Status"=> '0',
                                "companyName"=> "string",
                                "emp_Status"=> '0',
                                "f_Fname"=> "string",
                                "f_Lname"=> "string",
                                "f_Mname"=> "string",
                                "f_Suffix"=> "string",
                                "f_DOB"=> null,
                                "f_Age"=> '0',
                                "f_NOD"=> '0',
                                "f_YOS"=> '0',
                                "f_Emp_Status"=> '0',
                                "f_Job"=> "string",
                                "f_CompanyName"=> "string",
                                "f_RTTB"=> "string",
                                "business"=> [],
                                "loanAmount"=> '0',
                                "termsOfPayment"=> "string",
                                "purpose"=> "string",
                                "child"=> [],
                                "appliances"=> [],
                                "assets"=> [],
                                "bank"=> [],
                                "co_Fname"=> "string",
                                "co_Lname"=> "string",
                                "co_Mname"=> "string",
                                "co_Suffix"=> "string",
                                "co_Age"=> '0',
                                "co_Barangay"=> "string",
                                "co_City"=> "string",
                                "co_Civil_Status"=> "string",
                                "co_Cno"=> "string",
                                "co_Country"=> "string",
                                "co_DOB"=> null,
                                "co_EmailAddress"=> "string",
                                "co_Gender"=> "string",
                                "co_HouseNo"=> "string",
                                "co_House_Stats"=> '0',
                                "co_POB"=> "string",
                                "co_Province"=> "string",
                                "co_YearsStay"=> '0',
                                "co_ZipCode"=> "string",
                                "co_RTTB"=> "string",
                                "co_Status"=> '0',
                                "co_JobDescription"=> "string",
                                "co_YOS"=> '0',
                                "co_MonthlySalary"=> '0',
                                "co_OtherSOC"=> "string",
                                "co_BO_Status"=> '0',
                                "co_CompanyName"=> "string",
                                "co_CompanyID"=> "string",
                                "co_Emp_Status"=> '0',
                                "remarks"=> "string"
                                ]];
            // dd($test);
            // $test = ['fname' => 'test'];
            // dd(getenv('APP_API_URL').'/api/Member/SaveAll');
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post('http://localhost:8081/api/Member/SaveAll', $input['member']);            
            dd( $crt);
        
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

        $this->businfo[$lastcnt + 1] = [  'business_name' => $data['membusinfo']['businessName'],
                                          'business_type' => $data['membusinfo']['businessType'],
                                          'business_address' => $data['membusinfo']['businessAddress'],
                                          'year_of_business' => $data['membusinfo']['yob'],
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
        $this->member['emp_Status'] = '';
        $this->member['f_Emp_Status'] = '';
        $this->member['bO_Status'] = 1;
        $this->cntmemchild = [1];
        //$this->businfo = [1 => ['business_name' => 'business 1'], 2 => ['business_name' => 'business 2']];               
        $this->vehicle[1] = [  'vehicle' => '' ];
        $this->properties[1] = [  'property' => '' ];
        $this->appliances[1] = [  'appliance' => '', 'brand' => '' ];
        $this->bank[1] = [  'account' => '', 'address' => '' ];
    }

    public function render()
    {
        
        return view('livewire.transactions.application.create-application');
    }
}
