<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
