<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoMakerFileUpload extends Model
{
    use HasFactory;
    protected $table = 'tbl_CoMakerFileUpload_Model';
    protected $fillable =[  'CMID'
                            ,'FileName'
                            ,'FilePath'
                            ,'Status'
                            ,'DateCreated'];
    
    public $timestamps = false;
}
