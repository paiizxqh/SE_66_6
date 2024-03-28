<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterInCheckpoint extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'parameter_in_checkpoints';
    protected $fillable = [
        'id',
        'sample_id',
        'checkpoint_id',
        'parameter_id',
        'sample_value',
        'sample_date_time',
        'academician_id',
        'surveyor_id',
        'remark'
    ];

    public function checkpoint()
    {
        return $this->belongsTo(Checkpoint::class);
    }

    public function fine($checkpoint_id)
    {
        return static::where('checkpoint_id', $checkpoint_id)->first();
    }
}
