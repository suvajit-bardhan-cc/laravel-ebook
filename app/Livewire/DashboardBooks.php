<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;

class DashboardBooks extends Component
{
    use WithPagination;

    public $selectedCategory = 'all';
    public $selectedTag = null;
    public $sortBy = 'default';
    public $viewType = 'icon';

    protected $queryString = ['selectedCategory' => ['except' => 'all']];

    public function mount()
    {
        $tags = Tag::whereHas('books')->get();
        if ($tags->count() > 0) {
            $this->selectedTag = $tags->first()->slug;
        }
    }

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
        $this->resetPage();
    }

    #[\Livewire\Attributes\On('selectCategory')]
    public function handleCategorySelection($category)
    {
        $this->selectCategory($category);
    }

    public function selectTag($tagSlug)
    {
        $this->selectedTag = $tagSlug;
        $this->resetPage();
    }

    public function setSort($sortValue)
    {
        $this->sortBy = $sortValue;
        $this->resetPage();
    }

    public function setView($type)
    {
        $this->viewType = $type;
    }

    private function getBooks()
    {
        $query = Book::query();

        // Filter by category
        if ($this->selectedCategory !== 'all') {
            $query->whereHas('categories', function ($q) {
                $q->where('name', $this->selectedCategory);
            });
        }

        // Filter by tag
        if ($this->selectedTag) {
            $query->whereHas('tags', function ($q) {
                $q->where('slug', $this->selectedTag);
            });
        }

        // Sort books
        match ($this->sortBy) {
            'title-az' => $query->orderBy('title', 'asc'),
            'title-za' => $query->orderBy('title', 'desc'),
            'author' => $query->orderBy('author_name', 'asc'),
            default => $query->latest('id'),
        };

        return $query->paginate(20);
    }

    public function render()
    {
        $books = $this->getBooks();
        $totalBooks = Book::count();
        $allTags = Tag::whereHas('books')->get();

        return view('livewire.dashboard-books', [
            'books' => $books,
            'allTags' => $allTags,
            'totalBooks' => $totalBooks,
        ]);
    }
}
