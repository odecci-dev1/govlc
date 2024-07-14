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
            'MemId', // Foreign key on the cars table...
            'Id', // Foreign key on the owners table...
            'MemId', // Local key on the mechanics table...
            'Id' // Local key on the cars table...
        )->select('tbl_CoMaker_Model.id', 'tbl_CoMaker_Model.*')->withDefault();
    }

    public function loantype(): HasOneThrough
    {
        return $this->hasOneThrough(                              
            LoanType::class,
            LoanDetails::class,
            'NAID', // Foreign key on the cars table...
            'Id', // Foreign key on the owners table...
            'Id', // Local key on the mechanics table...
            'LoanTypeID' // Local key on the cars table...
        )->select('tbl_LoanType_Model.id', 'tbl_LoanType_Model.*')->withDefault();
    }

    public function termsofpayment(): HasOneThrough
    {
        return $this->hasOneThrough(                              
            TermsOfPayment::class,
            LoanDetails::class,
            'NAID', // Foreign key on the cars table...
            'Id', // Foreign key on the owners table...
            'Id', // Local key on the mechanics table...
            'TermsOfPayment' // Local key on the cars table...
        )->select('tbl_TermsOfPayment_Model.id', 'tbl_TermsOfPayment_Model.*')->withDefault();
    }
}
