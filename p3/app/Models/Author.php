<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public static function findBySlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }
}