<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionStatus extends Model
{
    use HasFactory;
    protected $table = 'tbl_CollectionStatus_Model';
    public $timestamps = false;
    protected $guarded = [
        'Id'
    ];
}
