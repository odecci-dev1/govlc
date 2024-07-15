<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Application extends Model
{
    use HasFactory;
    protected $table = 'tbl_Application_Model';
    public $timestamps = false;
    
    public function member(): HasOne
    {
        return $this->hasOne(Members::class, 'Id', 'MemId')->select('id', '*')->withDefault();
    }

    public function detail(): HasOne
    {
        return $this->hasOne(LoanDetails::class, 'NAID', 'Id')->select('id', '*')->withDefault();
    }

    public function comaker(): HasOneThrough
    {
        return $this->hasOneThrough(
            Members::class,
            CoMaker::class,
            'MemId', 
            'Id', 
            'MemId', 
            'Id'
        )->select('tbl_CoMaker_Model.id', 'tbl_CoMaker_Model.*')->withDefault();
    }

    public function loantype(): HasOneThrough
    {
        return $this->hasOneThrough(                              
            LoanType::class,
            LoanDetails::class,
            'NAID', 
            'Id',
            'Id',
            'LoanTypeID' 
        )->select('tbl_LoanType_Model.id', 'tbl_LoanType_Model.*')->withDefault();
    }

    public function termsofpayment(): HasOneThrough
    {
        return $this->hasOneThrough(                              
            TermsOfPayment::class,
            LoanDetails::class,
            'NAID',
            'Id', 
            'Id', 
            'TermsOfPayment' 
        )->select('tbl_TermsOfPayment_Model.id', 'tbl_TermsOfPayment_Model.*')->withDefault();
    }
}
