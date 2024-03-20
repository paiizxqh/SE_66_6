<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = [
        'product_type_id',
        'product_remain',
        'product_minimum'
    ];
}
