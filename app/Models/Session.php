<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'session';

    protected $fillable = [
        'userId',
        'name',
        'code',
        'sessionId',
        'json',
        'created_at',
        'updated_at',
    ];
}
