<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Members extends Model
{
    use HasFactory;
    protected $table = 'tbl_Member_Model'; 
    public $timestamps = false; 
    protected $fillable = [
                            'Fname',
                            'Lname',
                            'Mname',
                            'Suffix',
                            'Age',
                            'Barangay',
                            'City',
                            'Civil_Status',
                            'Cno',
                            'Country',
                            'DOB',
                            'EmailAddress',
                            'Gender',
                            'HouseNo',
                            'House_Stats',
                            'POB',
                            'Province',
                            'YearsStay',
                            'ZipCode',
                            'Status',
                            'DateCreated',
                            'DateUpdated',
                            'MemId',
                            'OwnProperty',
                            'OwnVehicles',
    ];

    public function comaker(): HasOne
    {
        return $this->hasOne(CoMaker::class, 'id', 'MemId')->select('id', '*')->withDefault();
    }

    // public function getFullNameAttribute()
    // {
    //     return "{$this->Fname} {$this->Nmane}";
    // }

}
