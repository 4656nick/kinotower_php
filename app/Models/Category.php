<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'category_id'];
    public $timestamps = false;

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function categoryFilms()
    {
        return $this->hasMany(CategoryFilm::class);
    }
}