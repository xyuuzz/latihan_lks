<?php

namespace App\Models;

use App\Models\Studio;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ["slug", "name"];

    public function studio()
    {
        return $this->hasMany(Studio::class);
    }
}
