<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
    'title',
    'author',
    'publisher',
    'publish_year',
    'isbn',
    'description',
    'cover',
    'category_id',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function bookUnits() {
        return $this->hasMany(BookUnit::class);
    }

    public function rating() {
        return $this->hasMany(Rating::class);
    }

}
