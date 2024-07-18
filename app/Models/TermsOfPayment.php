<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsOfPayment extends Model
{
    use HasFactory;

    protected $table = 'tbl_TermsOfPayment_Model'; 

    protected $fillable = [
        'NameOfTerms', 'Days', 'InterestRate', 'InterestType', 'Status', 
        'Formula', 'InterestApplied', 'Terms', 'OldFormula', 
        'NoAdvancePayment', 'NotarialFeeOrigin', 'LessThanAmount', 
        'LessThanNotarialAmount', 'LessThanAmountType', 'GreaterThanEqualAmount', 
        'GreaterThanEqualNotarialAmount', 'GreaterThanEqualAmountType', 
        'LoanInsuranceAmount', 'LoanInsuranceAmountType', 'LifeInsuranceAmount', 
        'LifeInsuranceAmountType', 'DeductInterest', 'CollectionTypeId',
        'DateCreated', 'DateUpdated', 'LoanTypeId'
    ];

    protected $guarded = [
        'Id',
        'TopId',
    ];

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateUpdated';

    public $timestamps = false; 

    public function loanType()
    {
        return $this->belongsTo(LoanType::class, 'LoanTypeId', 'LoanTypeID');
    }
}
