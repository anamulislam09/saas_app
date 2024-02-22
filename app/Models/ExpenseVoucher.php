<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseVoucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'voucher_id',
        'month',
        'year',
        'date',
        'customer_id',
        'auth_id',
        'cat_id',
        'amount',
        'name',
        'phone',
        'address',
    ];
}
