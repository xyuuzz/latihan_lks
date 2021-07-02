<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = ["name","slug", "basic_price", "additional_friday_price", "additional_saturday_price", "additional_sunday_price", "branch_id"];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
