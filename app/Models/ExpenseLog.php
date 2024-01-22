<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
        'year',
        'cat_id',
        'exp_id',
        'amount',
    ];
}
