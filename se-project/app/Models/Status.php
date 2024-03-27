<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    // dafault ของ laravel จะสร้าง create_at, update_at มาให้ ตัวนี้จะทำให้หยุดการสร้าง timestamp ที่เป็น template ของ laravel
    public $timestamps = false;

    protected $table = 'project_status';

    protected $fillable = [
        'name'
    ];

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
