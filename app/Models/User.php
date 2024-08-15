<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_User_Model';
    protected $guarded = [
        'Id',
        'UserId',
    ];

    public $timestamps = false; 

    protected $hidden = [
        'Password',
    ];

    protected $casts = [
        'DateCreated' => 'datetime',
        'DateUpdated' => 'datetime',
        'Password' => 'hashed',
    ];

    public function userModule(): BelongsTo
    {
        return $this->belongsTo(UserModule::class, 'user_id', 'Id');
    }

    public function getFullNameAttribute()
    {
        return $this->Lname.', '.$this->Fname . ' ' . mb_substr($this->Mname == 'N/A' ? '':$this->Mname, 0, 1).'.';
    }
}
