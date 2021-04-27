<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public function books()
    {
        # Author has many Books
        # Define a one-to-many relationship.
        return $this->hasMany('App\Models\Book');
    }
}