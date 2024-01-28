<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'year',
        'month',
        'cat_id',
        'sub_total',
        'total',
        'customer_id',
        'auth_id',
    ];
}


