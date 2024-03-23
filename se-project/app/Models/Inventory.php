<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = [
        'name',
        'image',
        'description',
        'remain',
        'minimum',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}