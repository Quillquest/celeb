<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forms extends Model
{
    use HasFactory;

    protected $fillable = [

        'first_name',
        'last_name',
        'address',
        'zip',
        'city',
        'country',
        'state',
        'phone',
        'gender',
        'age',
        'employment_status',
        'grant_type',
        'message1',
        'message2',
        'email',
        'date',
    ];
}
