<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'book_unit_id',
        'due_date',
        'borrowed_at',
        'returned_at',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }
    public function bookUnit(){
        return $this->belongsTo(BookUnit::class);
    }
}
