<?php

namespace App\Models;

use App\Models\Movie;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ["slug", "start", "end", "movie_id", "studio_id"];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
