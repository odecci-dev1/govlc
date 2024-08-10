<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory;

    protected $table = 'tbl_Area_Model';

    protected $fillable = [
        'Area',
        'City',
        'FOID',
        'Status',
        'DateCreated',
        'DateUpdated',
    ];

    protected $casts = [
        'City' => 'string',
    ];

    protected $guarded = [
        'Id',
        'AreaID',
    ];

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateUpdated';

    public $timestamps = false;

    public function fieldOfficer(): BelongsTo
    {
        return $this->belongsTo(FieldOfficer::class, 'Id', 'FOID');
    }

    public function collectionAreas(): HasMany
    {
        return $this->hasMany(CollectionArea::class, 'AreaId', 'AreaId');
    }

    public function members(): HasMany
    {
        return $this->hasMany(Members::class, 'City', 'City');
    }

    public function getCityListAttribute(): array
    {
        return explode('|', $this->City);
    }
}
