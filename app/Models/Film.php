<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{

    protected $fillable = ['name', 'country_id', 'duration', 'year_of_issue', 'age', 'link_img', 'link_kinopoisk', 'link_video'];


    use HasFactory, SoftDeletes;
    public function categoryFilms()
    {
        return $this->hasMany(CategoryFilm::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}