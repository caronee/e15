<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function repositories()
    {
        # country has many authors
        # Define a one-to-many relationship.
        return $this->hasMany('App\Models\Repository');
    }
    public function specimens()
    {
        # country has many authors
        # Define a one-to-many relationship.
        return $this->hasMany('App\Models\Specimen');
    }
    public function minerals()
    {
        # country has many authors
        # Define a one-to-many relationship.
        return $this->hasMany('App\Models\Mineral');
    }
}