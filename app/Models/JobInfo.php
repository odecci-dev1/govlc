<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobInfo extends Model
{
    use HasFactory;
    protected $table = 'tbl_JobInfo_Model';
    public $timestamps = false;
    protected $fillable = ['JobDescription', 'YOS', 'CompanyName', 'MonthlySalary', 'OtherSOC', 'Status', 'DateCreated', 'DateUpdated', 'BO_Status', 'Emp_Status', 'MemId', 'CompanyAddress'];                            
}
