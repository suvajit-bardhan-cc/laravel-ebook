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
        'content',
        'cover_image',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the categories for the book.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the tags for the book.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'book_tags');
    }

    /**
     * Get the user bookmarks for this book.
     */
    public function userBookmarks()
    {
        return $this->hasMany(UserBookmark::class);
    }

    /**
     * Get the cover image URL.
     */
    public function getCoverImageUrlAttribute(): string
    {
        if ($this->cover_image) {
            // If path already starts with 'images/', serve directly from public
            if (str_starts_with($this->cover_image, 'images/')) {
                return asset($this->cover_image);
            }
            // Otherwise, assume it's in storage
            return asset('storage/' . $this->cover_image);
        }
        return asset('images/default-book-cover.jpg');
    }

    /**
     * Accessor for truncated about text.
     */
    public function getShortAboutAttribute(): string
    {
        return strlen($this->about ?? '') > 100 
            ? substr($this->about, 0, 100) . '...' 
            : ($this->about ?? '');
    }
}