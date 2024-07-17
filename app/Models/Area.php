<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'tbl_Area_Model';

    protected $fillable = [
        'Area',
        'City',
        'FOID',
        'Status',
    ];

    protected $casts = [
        'City' => 'array',
    ];

    protected $primaryKey = 'Id'; // Ensure 'Id' is specified as the primary key
    public $incrementing = true; 

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateUpdated';

    public function fieldOfficer()
    {
        return $this->belongsTo(FieldOfficer::class, 'FOID', 'foid');
    }
}
