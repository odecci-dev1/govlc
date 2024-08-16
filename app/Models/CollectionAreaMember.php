<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CollectionAreaMember extends Model
{
    use HasFactory;

    protected $table = 'tbl_Collection_AreaMember_Model';

    protected $guarded = [
        'Id',
    ];
    public $timestamps = false;

    protected $fillable = [
        'NAID',
        'AdvancePayment',
        'LapsePayment',
        'CollectedAmount',
        'Savings',
        'Payment_Status',
        'Payment_Method',
        'DateCollected',
        'Area_RefNo',
        'AdvanceStatus',
        'UsedAdvancePayment'
    ];

    public function collectionArea(): BelongsTo
    {
        return $this->belongsTo(CollectionArea::class, 'Area_RefNo', 'Area_RefNo');
    }

    public function loanHistories()
    {
        return $this->hasMany(LoanHistory::class, 'NAID', 'NAID');
    }

}
