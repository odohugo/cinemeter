<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['text', 'rating', 'movie_id', 'movie_title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
