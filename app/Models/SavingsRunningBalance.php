<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SavingsRunningBalance extends Model
{
    use HasFactory;

    
    protected $table = 'tbl_SavingsRunningBalance';

    public $timestamps = false;

    protected $guarded = [
        'Id'
    ];

    protected $fillable = [
        'MemId',
        'Savings',
        'Note',
        'Date',
        'Updated_By'
    ];

    public function member(): HasOne
    {
        return $this->hasOne(Members::class, 'Id', 'MemId')->select('id', '*')->withDefault();
    }
}
