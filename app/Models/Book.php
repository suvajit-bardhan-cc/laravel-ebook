<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_name',
        'language',
        'about',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // If you want to customize how dates are formatted
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The categories that belong to the book.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Accessor for truncated about text
     */
    public function getShortAboutAttribute(): string
    {
        return strlen($this->about) > 100 
            ? substr($this->about, 0, 100) . '...' 
            : ($this->about ?? '');
    }

    /**
     * Accessor for formatted created date
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('M d, Y');
    }
}