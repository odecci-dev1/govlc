<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function member(): HasOne
    {
        return $this->hasOne(Members::class, 'MemId', 'MemId');
    }

    public function collectionareamember(): HasOne
    {
        return $this->hasOne(CollectionAreaMember::class, 'NAID', 'NAID');
    }

    public function pastDueDays()
    {
        $dueDate = Carbon::parse($this->DueDate);
        $now = Carbon::now();

        $differenceInDays = $dueDate->diffInDays($now, false);

        return $differenceInDays > 0 ? $differenceInDays : 0;
    }
}
