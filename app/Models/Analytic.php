<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    use HasFactory;
    public function working_areas()
    {
        return $this->belongsTo(Working_area::class);
    }
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

}
