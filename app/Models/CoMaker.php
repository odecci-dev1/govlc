<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class CoMaker extends Model
{
    use HasFactory;
    protected $table = 'tbl_CoMaker_Model';
    public $timestamps = false;

    public function getFullNameAttribute()
    {      
        return $this->Lname.', '.$this->Fname.(!empty($this->Suffi) ? ' '.$this->Suffi : '').' '.mb_substr($this->Mname, 0, 1).'.';
    }

    public function jobinfo(): HasOne
    {
        return $this->HasOne(CoMakerJobInfo::class, 'CMID', 'Id')->select('id', '*')->withDefault();
    }
    
    public function fileuploads(): HasMany
    {
        return $this->hasMany(CoMakerFileUpload::class, 'CMID', 'Id')->select('id', '*');
    }

}