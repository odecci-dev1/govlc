<?php

namespace App\Http\Livewire\Maintenance\FieldOfficer;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;

use App\Traits\Common;

class FieldOfficer extends Component
{   

    use Common;
    use WithFileUploads;
    
    public $officer;
    public $foid;
    public $idtypes = [];
    public $idtypename = '';

    public function rules(){                
        $rules = []; 
        $rules['officer.fname'] = 'required';
        $rules['officer.mname'] = '';
        $rules['officer.lname'] = 'required';
        $rules['officer.suffix'] = '';
        $rules['officer.gender'] = 'required';
        $rules['officer.dob'] = 'required';
        $rules['officer.age'] = 'required';
        $rules['officer.pob'] = 'required';
        $rules['officer.civilStatus'] = 'required';
        $rules['officer.cno'] = 'required';
        $rules['officer.emailAddress'] = '';
        $rules['officer.houseNo'] = 'required';
        $rules['officer.barangay'] = 'required';
        $rules['officer.city'] = 'required';
        $rules['officer.region'] = 'required';
        $rules['officer.country'] = '';
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

            
            $profilename = '';
            if(isset($this->member['profile'])){
                $time = time();
                $profilename = 'officer_profile_'.$time;
                $this->member['officer']->storeAs('public/officer_profile', $profilename);                               
            }          
            
            $memattachements = [];
            if(isset($this->member['attachments'])){
                //dd( $this->member['attachments'] );
                foreach ($this->member['attachments'] as $attachments) {
                    $time = time();
                    $filename = 'members_attachments_'.$time.'_'.$attachments->getClientOriginalName();
                    $attachments->storeAs('public/members_attachments', $filename);   
                    $memattachements[] = [ 'fileName' =>  $filename, 'filePath' => $filename ];
                }
            }

            $data = [
                        "fname"=> $input['officer']['fname'] ??= '',
                        "lname"=> $input['officer']['lname'] ??= '',
                        "mname"=> $input['officer']['mname'] ??= '',
                        "suffix"=> $input['officer']['suffix'] ??= '',
                        "gender"=> $input['officer']['gender'] ??= '',
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
                        "profileName"=> $profilename,
                        "profilePath"=> $profilename,
                        "uploadFiles"=> $memattachements
                    ];   
                    
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/SaveFieldOfficer', $data);  
            $get = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldOfficer/GetLastOfficerList');
            $get = $get->json();
            return redirect()->to('/maintenance/fieldofficer/view/'.$get['foid'])->with('mmessage', 'Field officer successfully saved');    

        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function update(){   
        try {                  
            $input = $this->validate(); 
            $data = [
                        "fname"=> $input['officer']['fname'] ??= '',
                        "lname"=> $input['officer']['lname'] ??= '',
                        "mname"=> $input['officer']['mname'] ??= '',
                        "suffix"=> $input['officer']['suffix'] ??= '',
                        "gender"=> $input['officer']['gender'] ??= '',
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
                        "files" => [],
                        "foid" => $this->foid,
                    ];   
                      
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/UpdateFieldOfficer', $data);            
            return redirect()->to('/maintenance/fieldofficer/view/'.$this->foid)->with('mmessage', 'Field officer successfully updated');    
        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function getofficerAge(){
        $age = $this->calculateAge($this->officer['dob']);
        $this->officer['age'] = $age;           
    }

    public function archive($foid){       
        $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/DeleteFO', [ 'foid' => $foid ]);              
        return redirect()->to('/maintenance/fieldofficer/list')->with('message', 'Filed officer has been archived');    
    }
    
    public function mount($foid = ''){
        $idtypes = Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/FieldOfficer/IDTypeList');  
        $idtypes = $idtypes->json();
        if(count($idtypes) > 0){
            foreach($idtypes as $midtypes){
                $this->idtypes[$midtypes['typeID']] = ['type' => $midtypes['type'], 'typeID' => $midtypes['typeID']];
            }
        }
        // dd($this->idtypes);
        if($foid != ''){
            $this->foid = $foid;
            $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/FieldOfficerFilterbyFOID', [ 'foid' => $this->foid ]);     
            $res = $data->json();
            $res = $res[0];      
       
            $this->officer['fname'] =  $res['fname'];
            $this->officer['mname'] =  $res['mname'];
            $this->officer['lname'] =  $res['lname'];
            $this->officer['suffix'] =  $res['suffix'];
            $this->officer['gender'] =  $res['gender'];
            $this->officer['dob'] =  date('Y-m-d', strtotime($res['dob']));
            $this->officer['age'] =  $res['age'];
            $this->officer['pob'] =  $res['pob'];            
            $this->officer['civilStatus'] =  $res['civilStatus'];
            $this->officer['cno'] =  $res['cno'];
            $this->officer['emailAddress'] =  $res['emailAddress'];

            $this->officer['houseNo'] =  $res['houseNo'];
            $this->officer['barangay'] =  $res['barangay'];
            $this->officer['emailAddress'] =  $res['emailAddress'];
            $this->officer['city'] =  $res['city'];
            $this->officer['region'] =  $res['region'];
            $this->officer['country'] =  $res['country'];
            $this->officer['sss'] =  $res['sss'];
            $this->officer['pagIbig'] =  $res['pagIbig'];
            $this->officer['philHealth'] =  $res['philHealth'];
            $this->officer['idNum'] =  $res['idNum'];
            $this->officer['typeID'] =  $res['typeID'];  
            $idtypename = isset($this->idtypes[$res['typeID']]) ? $this->idtypes[$res['typeID']] : ''; 
            if( $idtypename != '' ){   
                $this->getIdTypeName( $idtypename['type'] );
            }
        }
    }   

    public function getIdTypeName($idname){
        $this->idtypename = $idname;       
    }

    public function render()
    {         
       
        //dd( $this->idtypes );
        return view('livewire.maintenance.field-officer.field-officer');
    }
}
