<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoMaker extends Model
{
    use HasFactory;
    protected $table = 'tbl_CoMaker_Model';
    public $timestamps = false;

    protected $fillable = ['Lname'];

    public function getFullNameAttribute()
    {      
        return $this->Lname.', '.$this->Fname.(!empty($this->Suffi) ? ' '.$this->Suffi : '').' '.mb_substr($this->Mname, 0, 1).'.';
    }
    
}
