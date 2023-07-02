<?php

namespace App\Http\Livewire\Transactions\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class CreateApplication extends Component
{

    public $member;

    public function rules(){                
        $rules = [];      
        $rules['member.Fname'] = 'required';  
        $rules['member.Lname'] = 'required';  
        $rules['member.Mname'] = 'required';  
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
            $input = $this->validate();
            $input['member']['status'] = '1';
            //$data = $input['member'];                             
            // $data = [ 
            //             'Fname' => $input['member']['Fname'], 
            //             'Lname' => $input['member']['Lname'], 
            //             'Mname' => $input['member']['Mname'], 
            //             'Suffix' => $input['member']['Suffix'], 
            //             'Age' => $input['member']['Age'], 
            //             'Barangay' => $input['member']['Barangay'], 
            //             'City' => $input['member']['City'], 
            //             'Civil_Status' => $input['member']['Civil_Status'], 
            //             'Cno' => $input['member']['Cno'], 
            //             'Country' => $input['member']['Country'],      
            //             'DOB' => $input['member']['DOB'],                          
            //             'EmailAddress' => $input['member']['EmailAddress'], 
            //             'Gender' => $input['member']['Gender'], 
            //             'HouseNo' => $input['member']['HouseNo'],   
            //             'House_Stats' => $input['member']['House_Stats'],                                                        
            //             'POB' => $input['member']['POB'],   
            //             'Province' => $input['member']['Province'], 
            //             'YearsStay' => $input['member']['YearsStay'],        
            //             'ZipCode' => $input['member']['ZipCode'],     
            //             'Status' => '1',               
            //         ];
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/Member/SaveMember',  $input['member'] );
            dd( $crt );
        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function render()
    {
        return view('livewire.transactions.application.create-application');
    }
}
