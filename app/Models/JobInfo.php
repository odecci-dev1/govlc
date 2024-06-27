<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobInfo extends Model
{
    use HasFactory;
    protected $table = 'tbl_JobInfo_Model';
    public $timestamps = false;
}
