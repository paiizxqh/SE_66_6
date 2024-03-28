<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'cus_id',
        'name',
        'address',
        'phone',
        'regis_date',
    ];
}