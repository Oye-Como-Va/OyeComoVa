<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    public function analytics()
    {
        return $this->belongsTo(Analytic::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
