<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Mail\VerificationEmail;
use App\Models\FieldOfficer as TblFieldOfficer;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\Rules\AllowedEmailDomain;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;


class FieldOfficerOlds extends Component
{
    use WithFileUploads;

    public ?TblFieldOfficer $officer;
    public $id;
    public $showCreateModal;
    public $showDeleteModal;
    public $selectedUserId;
    public $imgprofile;
    public $imgfrontID;
    public $imgbackID;

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
            'officer.Sss' => 'required',
            'officer.PagIbig' => 'required',
            'officer.PhilHealth' => 'required',
            'officer.ID_Number' => 'required',
            'officer.IDType' => 'required',
            'officer.Profile' => '',
            'officer.Attachments' => 'required',
            'officer.FrontID' => '',
            'officer.BackID' => '',
        ];

        if (!isset($this->officer->profile)) {
            $rules['imgprofile'] = 'required';
        }

        if (!isset($this->officer->frontID)) {
            $rules['imgfrontID'] = 'required';
        }

        if (!isset($this->officer->backID)) {
            $rules['imgbackID'] = 'required';
        }

        return $rules;
    }

    protected $messages = [
        'officer.Fname' => 'First name is required',       
        'officer.Lname' => 'Last name is required',            
        'officer.Mname' => 'Middle name is required', 
        'officer.Suffix' => 'Suffix is required',   
        'officer.Gender' => 'Gender is required', 
        'officer.DOB' => 'Date of birth is required', 
        'officer.Age' => 'Age is required', 
        'officer.POB' => 'Place of birth is required', 
        'officer.CivilStatus' => 'Civil status is required',
        'officer.Cno' => 'Contact number is required', 
        'officer.EmailAddress' => 'Email address is required', 
        'officer.HouseNo' => 'House no. is required',           
        'officer.Barangay' => 'Barangay is required',           
        'officer.City' => 'City is required',           
        'officer.Region' => 'Region is required',           
        'officer.Country' => 'Country is required',           
        'officer.SSS' => 'SSS number is required',           
        'officer.PagIbig' => 'PagIbig number is required',                       
        'officer.PhilHealth' => 'PhilHealth number is required',                       
        'officer.ID_Number' => 'ID number number is required',                       
        'officer.IDType' => 'Please select ID type',   
        'imgprofile' => 'Please include profile img',                       
        'officer.attachments' => 'Please attach files',
        'officer.FrontID_Path' => 'Please include image of front id',                       
        'officer.BackID_Path' => 'Please include image of back id', 
        'imgfrontID' => 'Please include image of front id',                       
        'imgbackID' => 'Please include image of back id',
    ];

    public function render()
    {
        // return view('livewire.maintenance.field-officer.field-officer', []);
    }

    public function removeFile()
    {
        if ($this->newImage) {
            $filePath = $this->newImage->getRealPath();
            
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            
            $this->newImage = null;
        } 

        if ($this->image) {
            $filePath = asset('storage/' . $this->image);
            
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            
            $this->image = null;
        } 
    }

    public function create()
    {
        // return view('livewire.maintenance.field-officer.field-officer', []);
    }

    public function register(): void
    {
        $this->validate();

        if ($this->newImage) {
            $filename = $this->newImage->store('images');
        }

        TblFieldOfficer::create([
            'Fname' => $this->Fname,
            'Mname' => $this->Mname,
            'Lname' => $this->Lname,
            'Suffix' => $this->Suffix,
            'Gender' => $this->Gender,
            'DOB' => $this->DOB,
            'Age' => $this->Age,
            'POB' => $this->POB,
            'CivilStatus' => $this->CivilStatus,
            'Cno' => $this->Cno,
            'EmailAddress' => $this->EmailAddress,
            'HouseNo' => $this->HouseNo,
            'Barangay' => $this->Barangay,
            'City' => $this->City,
            'Region' => $this->Region,
            'Country' => $this->Country,
            'Sss' => $this->Sss,
            'PagIbig' => $this->PagIbig,
            'PhilHealth' => $this->PhilHealth,
            'ID_Number' => $this->ID_Number,
            'IDType' => $this->IDType,
            'Profile' => $this->Profile,
            'Attachments' => $this->Attachments,
            'FrontID' => $this->FrontID,
            'BackID' => $this->BackID,
            'Status' => 1,
            ''
        ]);

        Session::flash('create-user-success', 'Registration successful!');

        $this->reset();

        $this->dispatch('create-user-success');
    }

    public function edit($foid)
    {
        $officer = TblFieldOfficer::findOrFail($foid);
        dd($officer);
        // $this->selectedUserId = $user->id;
        // $this->first_name = $user->first_name;
        // $this->last_name = $user->last_name;
        // $this->role_id = $user->role_id;
        // $this->username = $user->username;
        // $this->email = $user->email;
        // $this->image = $user->image;

        // $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'role_id' => ['required'],
            'username' => ['required', 'string', 'min:3', 'max:255', Rule::unique(User::class)->ignore($this->selectedUserId)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->selectedUserId)],
        ]);

        $user = User::findOrFail($this->selectedUserId);

        $filename = null;

        if ($this->newImage) {
            $filename = $this->newImage->store('images');
        }
    
        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'role_id' => $this->role_id,
            'username' => $this->username,
            'email' => $this->email,
            'image' => $filename,
        ]);

        Session::flash('update-user-success', 'User updated successfully.');
    
        $this->reset();

        $this->dispatch('update-user-success');
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $this->selectedUserId = $user->id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->username = $user->username;
        $this->image = $user->image;
        $this->showDeleteModal = true;
    }

    public function confirmDelete()
    {
        $user = User::findOrFail($this->selectedUserId);

        $user->delete();

        $this->reset();

        $this->dispatch('delete-user-success');
    }
}