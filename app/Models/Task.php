<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function working_areas()
    {
        return $this->hasOne(Working_area::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
