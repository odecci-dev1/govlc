<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'tbl_Area_Model';

    protected $fillable = [
        'areaName',
        'location',
        'foid',
    ];

    public function fieldOfficers()
    {
        return $this->hasMany(FieldOfficer::class, 'area_id');
    }
}
