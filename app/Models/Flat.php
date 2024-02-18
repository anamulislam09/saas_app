<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;
    protected $fillable = [
        'flat_unique_id',
        'customer_id',
        'flat_name',
        'floor_no',
        'charge',
        'amount',
        'status',
        'create_date',
        'create_month',
        'create_year',
    ];
}
