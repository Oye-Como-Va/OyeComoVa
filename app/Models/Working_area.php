<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Working_area extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function tasks()
    {
        return $this->belongsTo(Task::class);
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function analytics()
    {
        return $this->hasOne(Analytic::class);
    }
}
