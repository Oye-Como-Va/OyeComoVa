<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;
    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
    public function subjets()
    {
        return $this->hasMany(Subject::class);
    }
}
