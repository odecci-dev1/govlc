<?php

namespace App\Http\Livewire\Maintenance\FieldOfficer;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use App\Traits\Common;
use function PHPUnit\Framework\isNull;
use App\Models\FieldOfficer as TblFieldOfficer;
use App\Models\FOFile;
use App\Models\Status;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class FieldOfficer extends Component
{   
    use Common;
    use WithFileUploads;

    public $officer;
    public $selectedFoid;
    public $officerDetails = null;
    public $usertype;
    public $foid = '';
    public $idtypes = [];
    public $idtypename = '';
    public $showDeleteModal = false;

    public function rules()
    {
        $rules = [
            'officer.Fname' => 'required',
            'officer.Mname' => '',
            'officer.Lname' => 'required',
            'officer.Suffix' => '',
            'officer.Gender' => 'required',
            'officer.DOB' => 'required',
            'officer.Age' => 'required',
            'officer.POB' => 'required',
            'officer.CivilStatus' => 'required',
            'officer.Cno' => 'required',
            'officer.EmailAddress' => '',
            'officer.HouseNo' => 'required',
            'officer.Barangay' => 'required',
            'officer.City' => 'required',
            'officer.Region' => 'required',
            'officer.Country' => '',
            'officer.SSS' => 'required',
            'officer.PagIbig' => 'required',
            'officer.PhilHealth' => 'required',
            'officer.ID_Number' => 'required',
            'officer.IDType' => 'required',
            'officer.Attachments' => 'required',
        ];

        if (!isset($this->officer['Profile'])) {
            $rules['officer.Profile'] = 'required';
        }

        if (!isset($this->officer['FrontID'])) {
            $rules['officer.FrontID'] = 'required';
        }

        if (!isset($this->officer['BackID'])) {
            $rules['officer.BackID'] = 'required';
        }

        return $rules;
    }
    
    public function messages(){
        $messages = [
            'officer.Fname.required' => 'First name is required',
            'officer.Lname.required' => 'Last name is required',
            'officer.Mname.required' => 'Middle name is required',
            'officer.Suffix.required' => 'Suffix is required',
            'officer.Gender.required' => 'Gender is required',
            'officer.DOB.required' => 'Date of birth is required',
            'officer.Age.required' => 'Age is required',
            'officer.POB.required' => 'Place of birth is required',
            'officer.CivilStatus.required' => 'Civil status is required',
            'officer.Cno.required' => 'Contact number is required',
            'officer.EemailAddress.required' => 'Email address is required',
            'officer.HouseNo.required' => 'House no. is required',
            'officer.Barangay.required' => 'Barangay is required',
            'officer.City.required' => 'City is required',
            'officer.Region.required' => 'Region is required',
            'officer.Country.required' => 'Country is required',
            'officer.SSS.required' => 'SSS number is required',
            'officer.PagIbig.required' => 'PagIbig number is required',
            'officer.PhilHealth.required' => 'PhilHealth number is required',
            'officer.ID_Number.required' => 'ID number number is required',
            'officer.IDType.required' => 'Please select ID type',
            'officer.Profile.required' => 'Please include profile image',
            'officer.Attachments.required' => 'Please attach files',
            'officer.FrontID.required' => 'Please include image of Front ID',
            'officer.BackID.required' => 'Please include image of Back ID',
        ];
        return $messages;        
    }
    
    public function getofficerAge(){
        $age = $this->calculateAge($this->officer['DOB']);
        $this->officer['Age'] = $age;           
    }

    public function storeProfileImage()
    {
        $profilename = '';

        if ($this->officer['Profile'] instanceof UploadedFile) {
            $time = time();
            $profilename = 'officer_profile_' . $time . '.' . $this->officer['Profile']->getClientOriginalExtension();
            $this->officer['Profile']->storeAs('officer_profile', $profilename, 'public');
        } else {
            $profilename = $this->officer['Profile'];
        }

        return $profilename;
    }

    public function storeFrontIdImage()
    {
        $frontidname = '';

        if ($this->officer['FrontID'] instanceof UploadedFile) {
            $time = time();
            $frontidname = 'officer_frontid_' . $time . '.' . $this->officer['FrontID']->getClientOriginalExtension();
            $this->officer['FrontID']->storeAs('officer_ids', $frontidname, 'public');
        } else {
            $frontidname = $this->officer['FrontID'];
        }

        return $frontidname;
    }

    public function storeBackIdImage()
    {
        $backidname = '';

        if ($this->officer['BackID'] instanceof UploadedFile) {
            $time = time();
            $backidname = 'officer_backid_' . $time . '.' . $this->officer['BackID']->getClientOriginalExtension();
            $this->officer['BackID']->storeAs('officer_ids', $backidname, 'public');
        } else {
            $backidname = $this->officer['BackID'];
        }

        return $backidname;
    }


    public function storeAttachments($foid)
    {
        $newAttachments = [];

        if ($this->officer['Attachments'] == $this->officer['Old_Attachments']) {
            $newAttachments = $this->officer['Attachments'];
        } else {
            if (isset($this->officer['Old_Attachments'])) {
                foreach ($this->officer['Old_Attachments'] as $oldFile) {
                    Storage::delete('officer_attachments/' . $oldFile['FilePath']);
                }
            }

            if (isset($this->officer['Attachments'])) {
                foreach ($this->officer['Attachments'] as $attachment) {
                    $time = time();
                    $filename = 'officer_attachments_' . $time . '_' . $attachment->getClientOriginalName();

                    $attachment->storeAs('officer_attachments', $filename, 'public');

                    $newAttachments[] = [
                        'FOID' => $foid,
                        'FilePath' => $filename,
                        'FileType' => $attachment->getClientOriginalExtension(),
                        'DateCreated' => now(),
                    ];
                }
            }
        }

        return $newAttachments;
    }

    public function store()
    {   
        try { 
            $input = $this->validate();       

            $officer = TblFieldOfficer::create([
                'Fname' => $input['officer']['Fname'] ?? '',
                'Mname' => $input['officer']['Mname'] ?? '',
                'Lname' => $input['officer']['Lname'] ?? '',
                'Suffix' => $input['officer']['Suffix'] ?? '',
                'Gender' => $input['officer']['Gender'] ?? '',
                'DOB' => $input['officer']['DOB'] ?? null,
                'Age' => $input['officer']['Age'] ?? '0',
                'POB' => $input['officer']['POB'] ?? '',
                'CivilStatus' => $input['officer']['CivilStatus'] ?? '',
                'Cno' => $input['officer']['Cno'] ?? '',
                'EmailAddress' => $input['officer']['EmailAddress'] ?? '',
                
                'HouseNo' => $input['officer']['HouseNo'] ?? '',
                'Barangay' => $input['officer']['Barangay'] ?? '',
                'City' => $input['officer']['City'] ?? '',
                'Region' => $input['officer']['Region'] ?? '',
                'Country' => $input['officer']['Country'] ?? '',

                'Status' => 1,
                'DateCreated' => now(),
                'DateUpdate' => null,
                'ProfilePath' => $this->storeProfileImage(),

                'FrontID_Path' => $this->storeFrontIdImage(),
                'BackID_Path' => $this->storeBackIdImage(),
                'ID_Number' => $input['officer']['ID_Number'] ?? null,

                'SSS' => $input['officer']['SSS'] ?? '',
                'TIN' => $input['officer']['TIN'] ?? null,
                'PagIbig' => $input['officer']['PagIbig'] ?? '',
                'PhilHealth' => $input['officer']['PhilHealth'] ?? '',
                'IDType' => $input['officer']['IDType'] ?? '',
            ]);


            $latestOfficer = TblFieldOfficer::latest()->first();
            $foid = $latestOfficer->FOID;
            // $this->uploadAttachments($foid);
            $attachments = $this->storeAttachments($foid);
            FOFile::insert($attachments);
            $this->resetValidation();

            return redirect()->to('/maintenance/fieldofficer/view/'. $foid)->with('mmessage', 'Field officer successfully saved');    
        }
        catch (\Exception $e) {           
            throw $e;            
        }
    }

    public function update()
    {
        try {
            $this->validate();

            $officer = TblFieldOfficer::where('FOID', $this->foid);
            if ($officer) {
                
                $data = [
                    'Fname' => $this->officer['Fname'],
                    'Mname' => $this->officer['Mname'],
                    'Lname' => $this->officer['Lname'],
                    'Suffix' => $this->officer['Suffix'],
                    'Gender' => $this->officer['Gender'],
                    'DOB' => $this->officer['DOB'] ?? null,
                    'Age' => $this->officer['Age'] ?? '0',
                    'POB' => $this->officer['POB'],
                    'CivilStatus' => $this->officer['CivilStatus'],
                    'Cno' => $this->officer['Cno'],
                    'EmailAddress' => $this->officer['EmailAddress'],
                    
                    'HouseNo' => $this->officer['HouseNo'],
                    'Barangay' => $this->officer['Barangay'],
                    'City' => $this->officer['City'],
                    'Region' => $this->officer['Region'],
                    'Country' => $this->officer['Country'],
    
                    'Status' => 1,
                    'DateCreated' => $this->officer['DateCreated'],
                    'DateUpdated' => now(),
                    'ProfilePath' => $this->storeProfileImage(),
                    
                    'FrontID_Path' => $this->storeFrontIdImage(),
                    'BackID_Path' => $this->storeBackIdImage(),
                    'ID_Number' => $this->officer['ID_Number'] ?? null,
    
                    'SSS' => $this->officer['SSS'],
                    'TIN' => $this->officer['TIN'] ?? null,
                    'PagIbig' => $this->officer['PagIbig'],
                    'PhilHealth' => $this->officer['PhilHealth'],
                    'IDType' => $this->officer['IDType'],
                ];

                $officer->update($data);

                $attachments = $this->storeAttachments($this->foid);
                FOFile::insert($attachments);

                $this->resetValidation();

                return redirect()->to('/maintenance/fieldofficer/view/' . $this->foid)->with('mmessage', 'Field officer updated successfully!');
            
            } else {
                Log::warning('No officer found with FOID: ' . $this->foid);
            }
            
        } catch (\Exception $e) {
            Log::error('Error updating officer: ' . $e->getMessage(), ['exception' => $e]); 
            throw $e;
        }
    }

    public function archive()
    {
        $officer = TblFieldOfficer::where('FOID', $this->foid);

        if ($officer) {

            $officer->update([
                'Status' =>  2,
            ]);

            Log::info('Archived officer with FOID: ' . $this->foid);

            return redirect()->to('/maintenance/fieldofficer/list')->with('mmessage', 'Field officer was successfully archived!');
            
        } else {
            Log::error('Failed to archive officer. FOID: ' . $this->foid);
        }
    }

    public function mount($foid = '') 
    {
        $this->usertype = session()->get('auth_usertype'); 
        $this->officer = [
            'Id' => '',
            'Fname' => '',
            'Mname' => '',
            'Lname' => '',
            'Suffix' => '',
            'Gender' => '',
            'DOB' => '',
            'Age' => '',
            'POB' => '',
            'CivilStatus' => '',
            'Cno' => '',
            'EmailAddress' => '',

            'HouseNo' => '',
            'Barangay' => '',
            'City' => '',
            'Region' => '',
            'Country' => '',

            'Status' => 1,
            'DateCreated' => '',
            'DateUpdated' => '',
            'FOID' => '',
            'Profile' => '',
            'Old_Profile' => '',

            'Attachments' => [],
            'Old_Attachments' => [],
            'FrontID' => '',
            'Old_FrontID' => '',
            'BackID' => '',
            'Old_BackID' => '',
            'ID_Number' => '',

            'SSS' => '',
            'TIN' => '',
            'PagIbig' => '',
            'PhilHealth' => '',
            'IDType' => '',
        ];

        $idtypes = TblFieldOfficer::getIdTypes();  
        if(count($idtypes) > 0){
            foreach($idtypes as $midtypes){
                $this->idtypes[$midtypes['typeID']] = ['type' => $midtypes['type'], 'typeID' => $midtypes['typeID']];
            }
        }

        // *** Get the Id *** \\
        if($foid != '') {
            $officer = TblFieldOfficer::getFieldOfficerByFOID($this->foid);

            $this->officer['Id'] =  $officer->Id;
            $this->officer['Fname'] =  $officer->Fname;
            $this->officer['Mname'] =  $officer->Mname;
            $this->officer['Lname'] =  $officer->Lname;
            $this->officer['Suffix'] =  $officer->Suffix;
            $this->officer['Gender'] =  $officer->Gender;
            $this->officer['DOB'] =  $officer->DOB->format('Y-m-d');
            $this->officer['Age'] =  $officer->Age;
            $this->officer['POB'] =  $officer->POB;            
            $this->officer['CivilStatus'] =  $officer->CivilStatus;
            $this->officer['Cno'] =  $officer->Cno;
            $this->officer['EmailAddress'] =  $officer->EmailAddress;

            $this->officer['HouseNo'] =  $officer->HouseNo;
            $this->officer['Barangay'] =  $officer->Barangay;
            $this->officer['City'] =  $officer->City;
            $this->officer['Region'] =  $officer->Region;
            $this->officer['Country'] =  $officer->Country;

            $this->officer['Status'] =  $officer->Status;
            $this->officer['DateCreated'] =  $officer->DateCreated;
            $this->officer['DateUpdated'] =  $officer->DateUpdated;
            $this->officer['FOID'] =  $officer->FOID;
            $this->officer['Profile'] = basename($officer->ProfilePath);
            $this->officer['Old_Profile'] = basename($officer->ProfilePath);
            $this->officer['Attachments'] = $officer->files->map(function($file) {
                return [
                    'FilePath' => $file->FilePath,
                    'FileType' => $file->FileType,
                ];
            })->toArray();
            $this->officer['Old_Attachments'] = $this->officer['Attachments'];
            
            $this->officer['FrontID'] = basename($officer->FrontID_Path);
            $this->officer['Old_FrontID'] = basename($officer->FrontID_Path);
            $this->officer['BackID'] = basename($officer->BackID_Path);
            $this->officer['Old_BackID'] = basename($officer->BackID_Path);
            $this->officer['ID_Number'] =  $officer->ID_Number;

            $this->officer['SSS'] =  $officer->SSS;
            $this->officer['TIN'] =  $officer->TIN;
            $this->officer['PagIbig'] =  $officer->PagIbig;
            $this->officer['PhilHealth'] =  $officer->PhilHealth;
            $this->officer['IDType'] =  $officer->IDType; 
            

            $idtypename = isset($this->idtypes[$officer->IDType]) ? $this->idtypes[$officer->IDType] : ''; 
            if($idtypename != ''){   
                $this->getIdTypeName($idtypename['type']);
            }

        }
    }   

    public function getIdTypeName($idname){
        $this->idtypename = $idname;       
    }

    public function render()
    {         
        return view('livewire.maintenance.field-officer.field-officer', [
            'officer' => $this->officer,
        ]);
    }
}
