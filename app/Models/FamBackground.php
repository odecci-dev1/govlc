<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class FamBackground extends Model
{
    use HasFactory;
    protected $table = 'tbl_FamBackground_Model';
    public $timestamps = false;
    protected $fillable = [ 'Fname',  'Mname',  'Lname',  'Suffix',  'DOB',  'Age',  'Emp_Status',  'Position',  'YOS',  'CmpId',  'NOD',  'RTTB',  'MemId',  'Status',  'DateCreated',  'DateUpdated',  'FamId'];

    public function childs(): HasMany
    {
        return $this->hasMany(ChildInfo::class, 'FamId', 'Id')->select('id', '*');
    }
}
