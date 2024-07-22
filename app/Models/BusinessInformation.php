<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusinessInformation extends Model
{
    use HasFactory;
    protected $table = 'tbl_BusinessInformation_Model';
    public $timestamps = false;

    public function businessfiles(): HasMany
    {
        return $this->hasMany(BusinessFileUpload::class, 'BIID', 'Id')->select('id', '*');
    }
}
