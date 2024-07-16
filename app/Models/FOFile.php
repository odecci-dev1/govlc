<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FOFile extends Model
{
    use HasFactory;

    protected $table = 'tbl_FOFile_Model';

    protected $fillable = [
        'FOID', 
        'FilePath',
        'FileType',
        'DateCreated',
    ];

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = null;

    public function officer()
    {
        return $this->belongsTo(FieldOfficer::class, 'FOID', 'FOID');
    }

    public function getFilePathAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }

    public function setFilePathAttribute($value)
    {
        $this->attributes['filePath'] = $value ? 'public/fo_files/' . $value : null;
    }
}