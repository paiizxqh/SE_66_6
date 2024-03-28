<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkpoint extends Model
{
    public $timestamps = false;

    use HasFactory;
    protected $table = 'checkpoints';

    protected $fillable = [
        'id',
        'number',
        'projects_id',
    ];

    public function parameterInCheckpoint()
    {
        return $this->hasMany(ParameterInCheckpoint::class);
    }
}
