<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    use HasFactory;
    protected $table = 'tbl_fileupload_Model';
    protected $fillable = [ 'MemId'
                            ,'FileName'
                            ,'FilePath'
                            ,'Status'
                            ,'DateCreated'
                            ,'DateUpdated'
                            ,'Type'];
    public $timestamps = false;
}
