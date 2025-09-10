<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tp_Transaction extends Model
{
    use HasFactory;
    protected $fillable=['user','address','city','country', 'status', 'comment'];
}
