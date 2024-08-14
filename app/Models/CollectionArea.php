<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CollectionArea extends Model
{
    use HasFactory;

    protected $table = 'tbl_CollectionArea_Model';

    protected $guarded = [
        'Id'
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'AreaID', 'AreaId');
    }

    public function areaMembers(): HasMany
    {
        return $this->hasMany(CollectionAreaMember::class, 'Area_RefNo', 'Area_RefNo');
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class, 'CollectionRefNo', 'RefNo');
    }
}
