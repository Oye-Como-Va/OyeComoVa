<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
