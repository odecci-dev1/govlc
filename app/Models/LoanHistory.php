<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanHistory extends Model
{
    use HasFactory;

    protected $table = 'tbl_LoanHistory_Model';
    public $timestamps = false;

    protected $fillable = [

        'LoanAmount',
        'Savings',
        'Penalty',
        'OutstandingBalance',
        'DateReleased',
        'DueDate',
        'DateCreated',
        'DateOfFullPayment',
        'MemId',
        'UsedSavings',
        'NAID',
    ];

}
