<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectMember extends Model
{
    use HasFactory;
    protected $table = 'project_members';

    protected $fillable = [
        'project_id',
        'user_id',
    ];

    public function user()
    {
        return  $this->hasMany(User::class);
    }
}
