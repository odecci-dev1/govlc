<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FieldOfficer extends Model
{
    use HasFactory;

    protected $table = 'tbl_FieldOfficer_Model';

    protected $fillable = [
        'Fname', 'Lname', 'Mname', 'Suffix', 'Gender', 'DOB', 'Age', 'POB', 'CivilStatus', 'Cno', 'EmailAddress', 
        'HouseNo', 'Barangay', 'City', 'Region', 'Country', 
        'Status', 'DateCreated', 'DateUpdated',  'ProfilePath',
        'FrontID_Path', 'BackID_Path', 'ID_Number',
        'SSS', 'TIN', 'PagIbig', 'PhilHealth', 'IDType',
        'Attachments', 
    ];

    protected $guarded = [
        'Id', 'FOID',
    ];

    protected $casts = [
        'DOB' => 'date:Y-m-d',
        'uploadFiles' => 'array'
    ];

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateUpdated';

    public $timestamps = false; 

    public static function getIdTypes()
    {
        return [
            ['typeID' => 'IDT-01', 'type' => 'License ID'],
            ['typeID' => 'IDT-02', 'type' => 'SSS ID'],
            ['typeID' => 'IDT-03', 'type' => 'PagIbig ID'],
            ['typeID' => 'IDT-04', 'type' => 'PhilHealth ID'],
        ];
    }

    public static function getFieldOfficerByFOID($foid)
    {
        return self::where('FOID', $foid)->with('files')->with('Status')->first();
    }

    // * Accessors
    public function getProfilePathAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }

    public function getFrontIdPathAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }

    public function getBackIdPathAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }
    
    public function getFullNameAttribute()
    {
        return trim("{$this->Fname} {$this->Mname} {$this->Lname}");
    }

    // * Mutators
    public function setDobAttribute($value)
    {
        $this->attributes['DOB'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function setUploadFilesAttribute($value)
    {
        $this->attributes['UploadFiles'] = json_encode($value);
    }

    public function setProfilePathAttribute($value)
    {
        $this->attributes['ProfilePath'] = $value ? $value : null;
    }

    public function setFrontIdPathAttribute($value)
    {
        $this->attributes['FrontID_Path'] = $value ? $value : null;
    }

    public function setBackIdPathAttribute($value)
    {
        $this->attributes['BackID_Path'] = $value ? $value : null;
    }

    // * Relationships
    public function status()
    {
        return $this->belongsTo(Status::class, 'Status');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'FOID', 'FOID'); 
    }

    public function files()
    {
        return $this->hasMany(FOFile::class, 'FOID', 'FOID');
    }

    public function updateFieldOfficer($data)
    {
        $data['DateUpdated'] = now();
        Log::info('Updating FieldOfficer', ['data' => $data, 'FOID' => $this->FOID]);
        $result = $this->update($data);
        Log::info('Update Result', ['result' => $result]);
        return $result;
    }
}
