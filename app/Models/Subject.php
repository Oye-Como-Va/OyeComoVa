<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public function courses()
    {
        return $this->belongsTo(Subject::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
