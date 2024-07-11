<?php

namespace App\Http\Livewire\Maintenance\FieldOfficer;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use App\Traits\Common;
use function PHPUnit\Framework\isNull;
use App\Models\FieldOfficer as TblFieldOfficer;
use Illuminate\Support\Facades\Log;

class FieldOfficer extends Component
{   

    use Common;
    use WithFileUploads;
    
    public $officer;
    public $usertype;
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
                $deletefiles[] = 'officer_profile/'.$this->officer['profile'];
            }
            Storage::delete($deletefiles);       
            
            $time = time();          
            $profilename = 'officer_profile_'.$time.'.'.$this->imgprofile->getClientOriginalExtension();         
            $this->imgprofile->storeAs('officer_profile', $profilename);    
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
                $deletefiles[] = 'officer_ids/'.$this->officer['frontID'];
            }
            Storage::delete($deletefiles);       
            
            $time = time();          
            $frontidname = 'officer_frontid_'.$time.'.'.$this->imgfrontID->getClientOriginalExtension();             
            $this->imgfrontID->storeAs('officer_ids', $frontidname); 
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
                $deletefiles[] = 'officer_ids/'.$this->officer['backID'];
            }
            Storage::delete($deletefiles);       
                
            $time = time();          
            $backidname = 'officer_backid_'.$time.'.'.$this->imgbackID->getClientOriginalExtension();    
            $this->imgbackID->storeAs('officer_ids', $backidname);    
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
                        $deletefiles[] = 'officer_attachments/'.$oldfiles['filePath'];
                    }
                }
                Storage::delete($deletefiles);       
                foreach ($this->officer['attachments'] as $attachments) {
                    $time = time();
                    $filename = 'officer_attachments_'.$time.'_'.$attachments->getClientOriginalName();
                    $attachments->storeAs('officer_attachments', $filename);   
                    $memattachements[] = [ 'filePath' => $filename ];
                }
            }
        }

        return $memattachements;
    }

    public function store(){   
        try { 
            $input = $this->validate();        

            $officer = new TblFieldOfficer();
            $officer->fill([
                'Fname' => $input['officer']['fname'] ?? '',
                'Lname' => $input['officer']['lname'] ?? '',
                'Mname' => $input['officer']['mname'] ?? '',
                'Suffix' => $input['officer']['suffix'] ?? '',
                'Gender' => $input['officer']['gender'] ?? '',
                'DOB' => $input['officer']['dob'] ?? null,
                'Age' => $input['officer']['age'] ?? '0',
                'POB' => $input['officer']['pob'] ?? '',
                'CivilStatus' => $input['officer']['civilStatus'] ?? '',
                'Cno' => $input['officer']['cno'] ?? '',
                'EmailAddress' => $input['officer']['emailAddress'] ?? '',
                'HouseNo' => $input['officer']['houseNo'] ?? '',
                'Barangay' => $input['officer']['barangay'] ?? '',
                'City' => $input['officer']['city'] ?? '',
                'Region' => $input['officer']['region'] ?? '',
                'Country' => $input['officer']['country'] ?? '',
                'SSS' => $input['officer']['sss'] ?? '',
                'PagIbig' => $input['officer']['pagIbig'] ?? '',
                'PhilHealth' => $input['officer']['philHealth'] ?? '',
                'ID_Number' => $input['officer']['id_Num'] ?? null,
                'IDType' => $input['officer']['typeID'] ?? '',
                'ProfilePath' => $this->storeProfileImage(),
                'FrontID_Path' => $this->storeFrontIdImage(),
                'BackID_Path' => $this->storeBackIdImage(),
            ]);
            
            $officer->save();

            $latestOfficer = TblFieldOfficer::latest()->first();
            $foid = $latestOfficer->FOID;
            $this->resetValidation();
            // return redirect()->route('fieldofficer.view'. $foid)
            // ->with('message', 'Field officer successfully saved');    
            return redirect()->to('/maintenance/fieldofficer/view/'. $foid)->with('message', 'Field officer successfully saved');    
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
            $apiresp = $crt->getStatusCode();                
            if($apiresp == 200){     
                return redirect()->to('/maintenance/fieldofficer/view/'.$this->foid)->with('mmessage', 'Field officer successfully updated');    
            }
            else{
                $this->resetValidation();         
                session()->flash('erroraction', 'update');
                session()->flash('errormessage', 'Operation Failed. Maybe Field Officer Already Exist. Retry ?');                                
                $this->emit('EMIT_ERROR_ASKING_DIALOG');
            }            
        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function getofficerAge(){
        $age = $this->calculateAge($this->officer['dob']);
        $this->officer['age'] = $age;           
    }

    // public function archive($foid){       
    //     $data = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/FieldOfficer/DeleteFO', [ 'foid' => $foid ]);                    
    //     if($data->body() == 'Successfully Deleted'){
    //         return redirect()->to('/maintenance/fieldofficer/list')->with('message', 'Filed officer has been archived');    
    //     }
    //     else{           
    //         $this->closeDialog();
    //         session()->flash('errmmessage', 'Deletion Failed. '.$data->body().'.');                                            
    //     }
       
    // }

    public function archive($id)
    {
        dd($id);
        // Find the officer by FOID
        $officer = TblFieldOfficer::where('Id', $id)->first();

        dd($officer);
        if ($officer) {
            // Attempt to delete the officer
            if ($officer->delete()) {
                return redirect()->to('/maintenance/fieldofficer/list')->with('mmessage', 'Field officer has been archived');
            } else {
                // Handle deletion failure
                $this->closeDialog();
                session()->flash('errmessage', 'Deletion Failed. Unable to delete field officer.');
            }
        } else {
            // Handle officer not found
            $this->closeDialog();
            session()->flash('errmessage', 'Deletion Failed. Field officer not found.');
        }
    }


    public function mount($id){
        dd($id);

        $this->usertype = session()->get('auth_usertype'); 
        $this->officer['old_profile'] = '';
        $this->officer['old_attachments'] = [];
        $this->officer['old_frontID'] = '';
        $this->officer['old_backID'] = '';

        $idtypes = TblFieldOfficer::getIdTypes();  
        if(count($idtypes) > 0){
            foreach($idtypes as $midtypes){
                $this->idtypes[$midtypes['typeID']] = ['type' => $midtypes['type'], 'typeID' => $midtypes['typeID']];
            }
        }
        // *** Get the Id *** 
        // $officers = TblFieldOfficer::all()->where("Id", );

        
        // dd($id);
        // if($id != ''){
        //     $officer = $officers->where('Id', $id)->first();
        //     dd($officers);
 
        //     $this->officer['fname'] =  $officer->Fname;
        //     $this->officer['mname'] =  $officer->Mname;
        //     $this->officer['lname'] =  $officer->Lname;
        //     $this->officer['suffix'] =  $officer->Suffix;
        //     $this->officer['gender'] =  $officer->Gender;
        //     $this->officer['dob'] =  $officer->DOB->format('Y-m-d');
        //     $this->officer['age'] =  $officer->Age;
        //     $this->officer['pob'] =  $officer->POB;            
        //     $this->officer['civilStatus'] =  $officer->CivilStatus;
        //     $this->officer['cno'] =  $officer->Cno;
        //     $this->officer['emailAddress'] =  $officer->EmailAddress;

        //     $this->officer['houseNo'] =  $officer->HouseNo;
        //     $this->officer['barangay'] =  $officer->Barangay;
        //     $this->officer['emailAddress'] =  $officer->EmailAddress;
        //     $this->officer['city'] =  $officer->City;
        //     $this->officer['region'] =  $officer->Region;
        //     $this->officer['country'] =  $officer->Country;
        //     $this->officer['sss'] =  $officer->SSS;
        //     $this->officer['pagIbig'] =  $officer->PagIbig;
        //     $this->officer['philHealth'] =  $officer->PhilHealth;
        //     $this->officer['idNum'] =  $officer->ID_Number;
        //     $this->officer['typeID'] =  $officer->IDType; 

        //     $this->officer['profile'] = $officer->profilePath;
        //     $this->officer['old_profile'] = $officer->profilePath;
        //     $this->officer['attachments'] = $officer->files;       
        //     $this->officer['old_attachments'] = $officer->files;    
            
        //     $this->officer['frontID'] = $officer->frontID_Path;
        //     $this->officer['old_frontID'] = $officer->frontID_Path;
        //     $this->officer['backID'] = $officer->backID_Path;
        //     $this->officer['old_backID'] = $officer->backID_Path;

        //     $idtypename = isset($this->idtypes[$officer->IDType]) ? $this->idtypes[$officer->IDType] : ''; 
        //     if($idtypename != ''){   
        //         $this->getIdTypeName($idtypename['type']);
        //     }
        // }
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
