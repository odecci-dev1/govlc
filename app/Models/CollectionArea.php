<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionArea extends Model
{
    use HasFactory;

    protected $table = 'tbl_CollectionArea_Model';

    protected $guarded = [
        'Id'
    ];

    public function areaMembers()
    {
        return $this->hasMany(CollectionAreaMember::class, 'Area_RefNo', 'Area_RefNo');
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'CollectionRefNo', 'RefNo');
    }
}
