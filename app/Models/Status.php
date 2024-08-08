<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'tbl_Status_Model';

    public function fieldOfficers()
    {
        return $this->hasMany(FieldOfficer::class, 'Status');
    }

    public function members()
    {
        return $this->hasMany(Members::class, 'Status');
    }
}
