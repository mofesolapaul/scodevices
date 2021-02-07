<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $hidden = ['id', 'updated_at', 'created_at', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
