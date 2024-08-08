<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $table = 'tbl_CollectionModel';

    protected $guarded = [
        'Id'
    ];

    public function collectionAreas()
    {
        return $this->hasMany(CollectionArea::class, 'CollectionRefNo', 'RefNo');
    }
}
