<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModule extends Model
{
    use HasFactory;

    protected $table = 'users_module';

    protected $guarded = [
        'Id'
    ];

    public $timestamps = false;
}
