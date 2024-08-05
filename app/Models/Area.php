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
        'DateCreated',
        'DateUpdated',
    ];

    protected $casts = [
        'City' => 'string',
    ];

    protected $guarded = [
        'Id',
        'AreaID',
    ];

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateUpdated';

    public $timestamps = false;

    public function fieldOfficer()
    {
        return $this->belongsTo(FieldOfficer::class, 'FOID', 'FOID');
    }

    public function collectionAreas()
    {
        return $this->hasMany(CollectionArea::class, 'AreaId', 'AreaId');
    }
}
