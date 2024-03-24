<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // dafault ของ laravel จะสร้าง create_at, update_at มาให้ ตัวนี้จะทำให้หยุดการสร้าง timestamp ที่เป็น template ของ laravel
    public $timestamps = false;

    protected $table = 'projects';

    protected $fillable = [
        'project_id',
        'start_date',
        'area_date' ,
        'map',
        'customers_contact_name',
        'customers_contact_phone',
        'status_id',
        'customer_id',
        'assistant_id'
    ];

    protected $casts = [
        'start_date' => 'date',
        'area_date' => 'date',
        /* 'area_date' => 'datetime:Y-m-d', */
        'status_id' => 'bigint',
    ];

    protected $appends = [

    ];
}
