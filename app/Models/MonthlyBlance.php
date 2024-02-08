<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyBlance extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'auth_id',
        'year',
        'month',
        'total_income',
        'total_expense',
        'amount',
        'flag',
    ];
}