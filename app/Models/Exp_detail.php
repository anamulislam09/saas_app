<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exp_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_id',
        'year',
        'month',
        'amount',
        'customer_id',
        'auth_id',
    ];
}
