<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the books for this category.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    /**
     * Get status badge class.
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'active' => 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400',
            'inactive' => 'bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400',
            default => 'bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400',
        };
    }

    /**
     * Get status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return ucfirst($this->status);
    }

    /**
     * Get book count.
     */
    public function getBooksCountAttribute(): int
    {
        return $this->books()->count();
    }
}