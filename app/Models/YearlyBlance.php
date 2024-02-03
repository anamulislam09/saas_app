<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearlyBlance extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'auth_id',
        'year',
        'amount',
        'flag',
    ];
}
