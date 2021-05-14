<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specimen extends Model
{
    use HasFactory;

    public static function findBySlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }
    public function country()
    {
        # repositories belongs to country
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('App\Models\Country');
    }
    public function repository()
    {
        # repositories belongs to country
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('App\Models\Repository');
    }
    public function mineral()
    {
        # repositories belongs to country
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('App\Models\Mineral');
    }
}