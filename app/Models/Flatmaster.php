<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flatmaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'flat_name',
        'sequence',
        'floor_no',
        'amount',
        'status',
    ];
}
