<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author_name',
        'language',
        'about'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}