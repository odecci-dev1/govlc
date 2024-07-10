<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appliances extends Model
{
    use HasFactory;
    protected $table = 'tbl_Appliance_Model';
    public $timestamps = false;
}
