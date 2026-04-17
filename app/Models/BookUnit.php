<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookUnit extends Model
{
    protected $fillable = [
        'book_id',
        'unit_code',
        'status',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function loan() {
            return $this->hasOne(Loan::class);
        }
}