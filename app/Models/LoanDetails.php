<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LoanDetails extends Model
{
    use HasFactory;
    protected $table = 'tbl_LoanDetails_Model';
    public $timestamps = false;

    public function termsofpayment(): HasOne
    {
        return $this->hasOne(TermsOfPayment::class, 'Id', 'TermsOfPayment')->select('id', '*')->withDefault();
    }
}
