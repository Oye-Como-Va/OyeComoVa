<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public function periods()
    {
        return $this->belongsTo(Period::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
