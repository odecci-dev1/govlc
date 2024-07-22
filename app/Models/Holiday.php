<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $table = 'tbl_Holiday_Model';

    protected $fillable = [
        'HolidayName',
        'Date',
        'Location',
        'RepeatYearly',
        'DateCreated',
        'DateUpdated',
        'Status',
    ];

    protected $guarded = [
        'Id',
        'HolidayID'
    ];

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateUpdated';

    public $timestamps = false; 
}
