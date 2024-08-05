<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Members extends Model
{
    use HasFactory;
    protected $table = 'tbl_Member_Model';    
    public $timestamps = false; 
    protected $fillable = [ 'Fname', 'Lname', 'Mname', 'Suffix', 'Age', 'Barangay', 'City', 'Civil_Status', 'Cno', 'Country', 'DOB', 'EmailAddress', 'Gender', 'HouseNo', 'House_Stats', 'POB', 'Province', 'YearsStay', 'ZipCode', 'Status', 'DateCreated', 'DateUpdated', 'MemId', 'OwnProperty', 'OwnVehicles' ];

    public function comaker(): HasOne
    {
        return $this->hasOne(CoMaker::class, 'MemId', 'Id')->select('id', '*')->withDefault();
    }

    public function fileuploads(): HasMany
    {
        return $this->hasMany(FileUpload::class, 'MemId', 'Id')->select('id', '*');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'MemId', 'Id')->select('id', '*');
    }

    public function monthlybills(): HasOne
    {
        return $this->HasOne(MonthlyBills::class, 'MemId', 'Id')->select('id', '*')->withDefault();
    }

    public function jobinfo(): HasOne
    {
        return $this->HasOne(JobInfo::class, 'MemId', 'Id')->select('id', '*')->withDefault();
    }

    public function familybackground(): HasOne
    {
        return $this->HasOne(FamBackground::class, 'MemId', 'Id')->select('id', '*')->withDefault();
    }

    public function businessinfo(): HasMany
    {
        return $this->hasMany(BusinessInformation::class, 'MemId', 'Id')->select('id', '*');
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Assets::class, 'MemId', 'Id')->select('id', '*');
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Properties::class, 'MemId', 'Id')->select('id', '*');
    }

    public function appliances(): HasMany
    {
        return $this->hasMany(Appliances::class, 'MemId', 'Id')->select('id', '*');
    }

    public function bankaccounts(): HasMany
    {
        return $this->hasMany(BankAccounts::class, 'MemId', 'Id')->select('id', '*');
    }

    public function memberSavings(): HasMany
    {
        return $this->hasMany(MembersSavings::class, 'MemId', 'MemId');
    }

    public function getFullNameAttribute()
    {
        return $this->Lname.', '.$this->Fname.(!empty($this->Suffix) ? ' '.$this->Suffix : '').' '.mb_substr($this->Mname, 0, 1).'.';
    }

}
