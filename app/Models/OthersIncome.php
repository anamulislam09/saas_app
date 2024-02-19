<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OthersIncome extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
        'year',
        'date',
        'auth_id',
        'customer_id',
        'income_info',
        'amount',
    ];
}
