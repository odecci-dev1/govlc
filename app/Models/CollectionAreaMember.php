<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function collectionArea()
    {
        return $this->belongsTo(CollectionArea::class, 'Area_RefNo', 'Area_RefNo');
    }
}
