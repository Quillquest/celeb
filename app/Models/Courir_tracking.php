<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courir_tracking extends Model
{
    use HasFactory;
    protected $fillable=['user','address','city','country', 'status', 'comment'];
}
