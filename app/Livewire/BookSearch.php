<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;

class BookSearch extends Component
{
    public $searchQuery = '';
    public $searchResults = [];
    public $isOpen = false;

    public function updatedSearchQuery($value)
    {
        if (strlen($value) < 2) {
            $this->searchResults = [];
            $this->isOpen = false;
            return;
        }

        $this->searchResults = Book::where('title', 'like', "%{$value}%")
            ->orWhere('author_name', 'like', "%{$value}%")
            ->where('status', 'active')
            ->orderBy('title', 'asc')
            ->limit(8)
            ->get();

        $this->isOpen = count($this->searchResults) > 0;
    }

    public function selectBook($bookId)
    {
        $this->searchQuery = '';
        $this->searchResults = [];
        $this->isOpen = false;

        return redirect()->route('books.show', encrypt($bookId));
    }

    public function closeSearch()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.book-search');
    }
}
