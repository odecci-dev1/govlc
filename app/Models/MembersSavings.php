<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MembersSavings extends Model
{
    use HasFactory;
    protected $table = 'tbl_MemberSavings_Model';

    public $timestamps = false;

    protected $guarded = [
        'Id'
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Members::class, 'MemId', 'MemId');
    }
}
