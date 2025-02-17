<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'tbl_settings_model';

    public $timestamps = false;

    protected $guarded = [
        'Id'
    ];

}
