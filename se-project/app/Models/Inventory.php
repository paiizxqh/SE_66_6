<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = [
        'product_id',
        'name',
        'product_type_id',
        'image',
        'description',
        'remain',
        'minimum',
        'unit',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
