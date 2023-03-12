<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryFilm extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}