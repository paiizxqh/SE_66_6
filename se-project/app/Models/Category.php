<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'category';

    protected $fillable = [
        'name',
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
