<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    use HasFactory;
    protected $table = 'tbl_LoanType_Model'; 

    protected $fillables = [
        'Loan_amount_Lessthan',
        'Loan_amount_GreaterEqual',
        'Savings',
        'LoanAmount_Min',
        'LoanAmount_Max',
        'Status',
        'DateCreated',
        'DateUpdated',
        'LoanTypeName',
    ];

    protected $guarded = [
        'Id',
        'LoanTypeID',
    ];

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateUpdated';

    public $timestamps = false; 

    public function terms()
    {
        return $this->hasMany(TermsOfPayment::class);
    }
}
