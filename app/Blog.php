<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        "title",
        "slug",
        "body"
    ];

//    dapatkan data dari table blog dari yang terbaru dan paginate dengan masing masing page adalah 4 data
    public static function getBlog()
    {
        return self::latest()->paginate(4);
    }
}
