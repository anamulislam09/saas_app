<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addressbook extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'customer_id',
        'auth_id',
        'name',
        'phone',
        'address',
    ];
}
