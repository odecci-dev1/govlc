<?php

namespace App\Http\Livewire\Maintenance\FieldOfficer;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use App\Traits\Common;

use function PHPUnit\Framework\isNull;

class FieldOfficer extends Component
{   

    use Common;
    use WithFileUploads;
    
    public $officer;
    public $foid = '';
    public $idtypes = [];
    public $idtypename = '';
    public $imgprofile;
    public $imgfrontID;
    public $imgbackID;
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
        $rules['officer.profile'] = '';
        $rules['imgprofile'] = isset($this->officer['profile']) ? '' : 'required';  
        $rules['officer.attachments'] = 'required'; 
        $rules['officer.frontID'] = '';  
        $rules['imgfrontID'] = isset($this->officer['frontID']) ? '' : 'required';  
        $rules['officer.backID'] = ''; 
        $rules['imgbackID'] = isset($this->officer['backID']) ? '' : 'required';  
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
        $messages['imgprofile.required'] = 'Please include profile img';                        
        $messages['officer.attachments.required'] = 'Please attach files'; 
        $messages['officer.frontID.required'] = 'Please include image of front id';                        
        $messages['officer.backID.required'] = 'Please include image of back id';  
        $messages['imgfrontID.required'] = 'Please include image of front id';                        
        $messages['imgbackID.required'] = 'Please include image of back id';                               
        return $messages;        
    }

    public function storeProfileImage(){
        
        // dd($this->officer['profile']);        
        $profilename = '';
        if($this->imgprofile){
            $deletefiles = [];
            if(isset($this->officer['profile'])){
                $deletefiles[] = 'public/officer_profile/'.$this->officer['profile'];
            }
            Storage::delete($deletefiles);       
            
            $time = time();          
            $profilename = 'officer_profile_'.$time;         
            $this->imgprofile->storeAs('public/officer_profile', $profilename);    
        }
        else{
            $profilename = $this->officer['profile'];  
        }  
        return $profilename;
    }

    public function storeFrontIdImage(){
        
        // dd($this->officer['profile']);        
        $frontidname = '';
        if($this->imgfrontID){
            $deletefiles = [];
            if(isset($this->officer['frontID'])){
                $deletefiles[] = 'public/officer_ids/'.$this->officer['frontID'];
            }
            Storage::delete($deletefiles);       
            
            $time = time();          
            $frontidname = 'officer_frontid_'.$time;         
            $this->imgfrontID->storeAs('public/officer_ids', $frontidname); 
        }
        else{
            $frontidname = $this->officer['frontID'];  
        }  
        return $frontidname;
    }

    public function storeBackIdImage(){
        
        $backidname = '';
        if($this->imgbackID){
            $deletefiles = [];
            if(isset($this->officer['backID'])){
                $deletefiles[] = 'public/officer_ids/'.$this->officer['backID'];
            }
            Storage::delete($deletefiles);       
                
            $time = time();          
            $backidname = 'officer_backid_'.$time;         
            $this->imgbackID->storeAs('public/officer_ids', $backidname);    
        }
        else{
            $backidname = $this->officer['backID'];  
        } 
        return $backidname;
    }

    public function storeAttachments(){
        $memattachements = [];      
        if($this->officer['attachments'] == $this->officer['old_attachments']){
            $memattachements = $this->officer['attachments'];
        }
        else{            
            if(isset($this->officer['attachments'])){    
                $deletefiles = [];
                if(isset($this->officer['old_attachments'])){
                    foreach($this->officer['old_attachments'] as $oldfiles){
                        $deletefiles[] = 'public/officer_attachments/'.$oldfiles['filePath'];
                    }
                }
                Storage::delete($deletefiles);       
                foreach ($this->officer['attachments'] as $attachments) {
                    $time = time();
                    $filename = 'officer_attachments_'.$time.'_'.$attachments->getClientOriginalName();
                    $attachments->storeAs('public/officer_attachments', $filename);   
                    $memattachements[] = [ 'filePath' => $filename ];
                }
            }
        }

        return $memattachements;
    }


    public function store(){   
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
                        "profilePath"=> $this->storeProfileImage(),
                        "frontID_Path"=> $this->storeFrontIdImage(),
                        "backID_Path"=> $this->storeBackIdImage(),
                        "uploadFiles"=> $this->storeAttachments()
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
                        "foid" => $this->foid,
                        "sss"=> $input['officer']['sss'] ??= '',
                        "pagIbig"=> $input['officer']['pagIbig'] ??= '',
                        "philHealth"=> $input['officer']['philHealth'] ??= '',
                        "idNum"=> $input['officer']['idNum'] ??= null,
                        "typeID"=> $input['officer']['typeID'] ??= '',
                        "profilePath"=> $this->storeProfileImage(),
                        "frontID_Path"=> $this->storeFrontIdImage(),
                        "backID_Path"=> $this->storeBackIdImage(),
                        "uploadFiles"=> $this->storeAttachments(),                       
                    ];   
                      
            $crt = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/UpdateFieldOfficer', $data);                        
            //dd($crt);
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
        $this->officer['old_profile'] = '';
        $this->officer['old_attachments'] = [];
        $this->officer['old_frontID'] = '';
        $this->officer['old_backID'] = '';
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
            //dd( $res);
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

            $this->officer['profile'] = $res['profilePath'];
            $this->officer['old_profile'] = $res['profilePath'];
            $this->officer['attachments'] = $res['files'];       
            $this->officer['old_attachments'] = $res['files'];    
            
            $this->officer['frontID'] = $res['frontID_Path'];
            $this->officer['old_frontID'] = $res['frontID_Path'];
            $this->officer['backID'] = $res['backID_Path'];
            $this->officer['old_backID'] = $res['backID_Path'];

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
