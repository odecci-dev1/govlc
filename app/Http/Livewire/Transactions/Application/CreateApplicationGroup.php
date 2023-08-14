<?php

namespace App\Http\Livewire\Transactions\Application;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CreateApplicationGroup extends Component
{

    public $test = 'hello';
    public $members = [];
    public $groupname;
    public $loandetails;

    public function mount(){
       
        // session(['fname' => 'test']);
        // $this->members[] = ['fname' => ];
    }

    public function store(){

        // $data = [
        //             'member' => session('memdata'),
        //             "groupName"=> 'as',
        //             "groupId"=> "test"
        //         ];

        $data = [
                "member"=> [
                                ["fname"=> "string123",
                                "lname"=> "string123",
                                "mname"=> "string123",
                                "suffix"=> "string",
                                "age"=> "string",
                                "barangay"=> "string",
                                "city"=> "string",
                                "civil_Status"=> "string",
                                "cno"=> "string",
                                "country"=> "string",
                                "dob"=> "2023-08-13T03:01:34.887Z",
                                "emailAddress"=> "string",
                                "gender"=> "string",
                                "houseNo"=> "string",
                                "house_Stats"=> '0',
                                "pob"=> "string",
                                "province"=> "string",
                                "yearsStay"=> '0',
                                "zipCode"=> "string",
                                "status"=> '0',
                                "dateCreated"=> "2023-08-13T03:01:34.887Z",
                                "dateUpdated"=> "2023-08-13T03:01:34.887Z",
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
                                "f_DOB"=> "2023-08-13T03:01:34.887Z",
                                "f_Age"=> '0',
                                "f_NOD"=> '0',
                                "f_YOS"=> '0',
                                "f_Emp_Status"=> '0',
                                "f_Job"=> "string",
                                "f_CompanyName"=> "string",
                                "f_RTTB"=> "string",
                                "business"=> [[
                                    "businessName"=> "string",
                                    "businessType"=> "string",
                                    "businessAddress"=> "string",
                                    "b_status"=> '0',
                                    "yob"=> '0',
                                    "noe"=> '0',
                                    "salary"=> '0',
                                    "vos"=> '0',
                                    "aos"=> '0'
                                ]],
                                "loanAmount"=> '0',
                                "termsOfPayment"=> "string",
                                "purpose"=> "string",
                                "child"=> [[
                                    "fname"=> "string",
                                    "mname"=> "string",
                                    "lname"=> "string",
                                    "age"=> '0',
                                    "nos"=> "string",
                                    "famId"=> "string"
                                ]],
                                "appliances"=> [[
                                    "brand"=> "string",
                                    "appliances"=> "string",
                                    "naid"=> "string"
                                  ]],
                                "assets"=> [[
                                    "motorVehicles"=> "string"
                                  ]],
                                "property"=> [[
                                    "property"=> "string"
                                  ]],
                                "bank"=> [[
                                    "bankName"=> "string",
                                    "address"=> "string"
                                  ]],
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
                                "co_DOB"=> "2023-08-13T03:01:34.887Z",
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
                                "remarks"=> "string",
                                "applicationStatus"=> '0'
                              ]                  
                            ],
              "groupName"=> "string",
              "groupId"=> "string"
        ];

        // dd( $data );        
        $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/SaveAll', $data);  
        dd($crt);
    }

    public function render()
    {
        // session()->forget('memdata');             
        if(session('memdata')){
            foreach(session('memdata') as $memdata){
                $this->members[] = $memdata;
            }
        }
        return view('livewire.transactions.application.create-application-group');
    }
}
