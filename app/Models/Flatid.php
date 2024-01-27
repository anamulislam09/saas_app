<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flatid extends Model
{
    use HasFactory;

    protected $fillable = [
        'flat_id',
        'customer_id',
    ];
}
