<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'id',
        'cus_id',
        'name',
        'address',
        'regis_date',
        'phone'
    ];
    public static function find($cus_id)
    {
        return static::where('cus_id', $cus_id)->first();
    }
}
