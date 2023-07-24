<?php

namespace App\Http\Livewire\Maintenance\FieldOfficer;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class FieldOfficer extends Component
{   
    public $officer;

    public function rules(){                
        $rules = []; 
        $rules['officer.fname'] = 'required';
        $rules['officer.mname'] = 'required';
        $rules['officer.lname'] = 'required';
        $rules['officer.suffix'] = '';
        $rules['officer.gender'] = 'required';
        $rules['officer.dob'] = 'required';
        $rules['officer.age'] = 'required';
        $rules['officer.pob'] = 'required';
        $rules['officer.civilStatus'] = 'required';
        $rules['officer.cno'] = 'required';
        $rules['officer.emailAddress'] = 'required';
        $rules['officer.houseNo'] = 'required';
        $rules['officer.barangay'] = 'required';
        $rules['officer.city'] = 'required';
        $rules['officer.region'] = 'required';
        $rules['officer.country'] = 'required';
        $rules['officer.sss'] = 'required';
        $rules['officer.pagIbig'] = 'required';
        $rules['officer.philHealth'] = 'required';
        $rules['officer.idNum'] = 'required';
        $rules['officer.typeID'] = 'required';
        return  $rules;     
    }
    
    public function messages(){
        $messages = [];
        $messages['officer.fname.required'] = 'First name is required';        
        $messages['officer.lname.required'] = 'Last name is required';             
        $messages['officer.mname.required'] = 'Middle name is required';  
        $messages['officer.suffix.required'] = 'Suffix is required';    
        $messages['officer.gender.required'] = 'Gender is required';  
        $messages['officer.dob.required'] = 'Date of birth is required';  
        $messages['officer.age.required'] = 'Age is required';  
        $messages['officer.pob.required'] = 'Place of birth is required';  
        $messages['officer.civilStatus.required'] = 'Civil status is required';
        $messages['officer.cno.required'] = 'Contact number is required';  
        $messages['officer.emailAddress.required'] = 'Email address is required';  
        $messages['officer.houseNo.required'] = 'House no. is required';            
        $messages['officer.barangay.required'] = 'Barangay is required';            
        $messages['officer.city.required'] = 'City is required';            
        $messages['officer.region.required'] = 'Region is required';            
        $messages['officer.country.required'] = 'Country is required';            
        $messages['officer.sss.required'] = 'SSS number is required';            
        $messages['officer.pagIbig.required'] = 'PagIbig number is required';                        
        $messages['officer.philHealth.required'] = 'PhilHealth number is required';                        
        $messages['officer.idNum.required'] = 'ID number number is required';                        
        $messages['officer.typeID.required'] = 'Please select ID type';                        
        return $messages;        
    }

    public function store(){   
        try {                  
            $input = $this->validate(); 
            $data = [
                        "fname"=> $input['officer']['fname'] ??= '',
                        "lname"=> $input['officer']['lname'] ??= '',
                        "mname"=> $input['officer']['mname'] ??= '',
                        "suffix"=> $input['officer']['mname'] ??= '',
                        "gender"=> $input['officer']['mname'] ??= '',
                        "dob"=> $input['officer']['dob'] ??= null,
                        "age"=> $input['officer']['age'] ??= '0',
                        "pob"=> $input['officer']['pob'] ??= '',
                        "civilStatus"=> $input['officer']['civilStatus'] ??= '',
                        "cno"=> $input['officer']['cno'] ??= '',
                        "emailAddress"=> $input['officer']['emailAddress'] ??= '',
                        "houseNo"=> $input['officer']['houseNo'] ??= '',
                        "barangay"=> $input['officer']['barangay'] ??= '',
                        "city"=> $input['officer']['city'] ??= '',
                        "region"=> $input['officer']['region'] ??= '',
                        "country"=> $input['officer']['country'] ??= '',
                        "sss"=> $input['officer']['sss'] ??= '',
                        "pagIbig"=> $input['officer']['pagIbig'] ??= '',
                        "philHealth"=> $input['officer']['philHealth'] ??= '',
                        "idNum"=> $input['officer']['idNum'] ??= null,
                        "typeID"=> $input['officer']['typeID'] ??= '',
                    ];   
                    
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/SaveFieldOfficer', $data);  
            return redirect()->to('/maintenance/fieldofficer/list')->with('message', 'Filed officer successfully saved');    

        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function render()
    {        
        return view('livewire.maintenance.field-officer.field-officer');
    }
}
