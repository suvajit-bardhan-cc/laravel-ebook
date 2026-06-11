# Livewire Dashboard Books Component Setup

## What Was Changed

### 1. **New Livewire Component Created**
   - **File**: `app/Livewire/DashboardBooks.php`
   - Handles category filtering, tag filtering, sorting, and view switching
   - Uses pagination (20 items per page)
   - Listens for Livewire events from sidebar

### 2. **New Livewire View Created**
   - **File**: `resources/views/livewire/dashboard-books.blade.php`
   - Displays filtered books with all controls
   - Shows tabs, sorting options, view toggle
   - Handles both 'icon' and 'list' view types

### 3. **Dashboard View Updated**
   - **File**: `resources/views/dashboard.blade.php`
   - Replaced static books section with `@livewire('dashboard-books')`
   - Category links now dispatch Livewire events
   - Added JavaScript function `selectCategory()` to handle sidebar clicks

---

## How It Works

### Category Selection Flow
1. User clicks a category in sidebar
2. JavaScript `selectCategory()` function:
   - Prevents default link behavior
   - Updates visual active state
   - Dispatches Livewire event `selectCategory`
3. Livewire component receives event and:
   - Updates `$selectedCategory` property
   - Filters books by category
   - Resets pagination to page 1
   - Re-renders with filtered results

### Features
- **Category Filtering**: Click any category to filter books
- **Tag Filtering**: Click tab buttons to filter by tag
- **Sorting**: Order by Default, Title A-Z, Title Z-A, Author A-Z
- **View Toggle**: Switch between Icon and List views
- **Pagination**: 20 books per page with Laravel pagination links
- **Reactive**: All changes update in real-time without page reload

---

## Required Dependencies

Ensure you have Livewire installed:

```bash
composer require livewire/livewire
```

---

## CSS Classes to Verify

The component uses these CSS classes - make sure they exist in your stylesheets:

```
- v-icon (icon view wrapper)
- v-list (list view wrapper)
- icon-item / list-item (book item containers)
- icon-img-wrap / list-img-wrap (image containers)
- icon-shine / list-shine (shine effect)
- icon-link / list-link (title links)
- ia (author name class)
- no-results (empty state)
- chip (filter badge)
- fw-bold (font weight bold)
```

---

## Key Model Relationships

The component assumes:
- **Book** model has:
  - `cover_image_url` attribute
  - `title` attribute
  - `author_name` attribute
  - `categories()` relationship
  - `tags()` relationship

- **Category** model has:
  - `name` attribute
  - `books()` relationship
  - `books_count` (used in view)

- **Tag** model has:
  - `slug` attribute
  - `name` attribute
  - `fa_icon` attribute (FontAwesome icon class)
  - `books()` relationship

---

## Optional Enhancements

### Add Search Functionality
```php
// In DashboardBooks.php
public $search = '';

private function getBooks() {
    $query = Book::query();
    
    if ($this->search) {
        $query->where('title', 'like', "%{$this->search}%")
              ->orWhere('author_name', 'like', "%{$this->search}%");
    }
    // ... rest of filtering
}
```

### Add Loading State
```blade
<!-- In dashboard-books.blade.php -->
<div wire:loading class="loading-spinner">
    <i class="fas fa-spinner fa-spin"></i> Loading...
</div>
```

### Customize Pagination
Change items per page in `DashboardBooks.php`:
```php
return $query->paginate(12); // change 20 to desired number
```

---

## Troubleshooting

### Books Not Updating on Category Click
- Verify Livewire is installed: `composer show livewire/livewire`
- Check browser console for JavaScript errors
- Ensure `@livewire` directive is in dashboard view

### Categories Not Showing Active State
- Verify CSS for `.cat-link.active` selector
- Check that `selectCategory()` JS function is loaded

### Pagination Not Working
- Ensure Book model uses pagination
- Check that paginated view template exists

---

## File Locations
- Component: `app/Livewire/DashboardBooks.php`
- View: `resources/views/livewire/dashboard-books.blade.php`
- Dashboard: `resources/views/dashboard.blade.php`
