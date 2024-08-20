<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanCalculator extends Model
{
    use HasFactory;

    protected $table = 'tbl_Member_Model';

    public function getFullNameAttribute()
    {
        return $this->Lname.', '.$this->Fname.(!empty($this->Suffix) ? ' '.($this->Suffix == 'N/A' ? '':$this->Suffix) : '').' '.mb_substr($this->Mname == 'N/A' ? '':$this->Mname, 0, 1).'.';
    }
}
