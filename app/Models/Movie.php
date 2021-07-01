<?php

namespace App\Models;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ["name", "slug", "duration", "image"];

    public function schedule() {
        return $this->hasOne(Schedule::class);
    }
}
