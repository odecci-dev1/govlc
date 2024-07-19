<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvancePaymentFormula extends Model
{
    use HasFactory;

    protected $table = 'tbl_AdvancePaymentFomula_Model'; 

    protected $fillable = [
        'Formula'
    ];

    protected $guarded = [
        'Id',
        'APFID',
    ];

    public function termsOfPayment()
    {
        return $this->hasOne(TermsOfPayment::class, 'APFID', 'APFID');
    }
}
