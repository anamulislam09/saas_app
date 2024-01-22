<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exp_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_id',
        'exp_id',
        'amount',
    ];
}
