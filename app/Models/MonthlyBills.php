<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyBills extends Model
{
    use HasFactory;
    protected $table = 'tbl_MonthlyBills_Model';
    public $timestamps = false;

    protected $fillable = ['MemId', 'ElectricBill', 'WaterBill', 'OtherBills', 'DailyExpenses', 'Status', 'DateCreated', 'DateUpdated'];
}
