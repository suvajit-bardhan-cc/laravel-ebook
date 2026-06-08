<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Book View - eBook Stack</title>

    <link rel="shortcut icon" href="images/1731092903.jpg" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css?v=1" rel="stylesheet">
    <style>
        .btn-logout {
    appearance: none;
    -webkit-appearance: none;
    background: none;
    border: none;
    outline: none;
    padding: 0;
    margin: 0;
    font: inherit;
    color: inherit;
    cursor: pointer;
    text-decoration: none;
}
    </style>

</head>

<body>

    <!-- ═══ HEADER ══════════════════════════════════════════════ -->
    @include('layouts.header')
    <!-- ═══ PAGE BODY ════════════════════════════════════════════ -->
    <div class="bookmark-wrap">
        <div class="page_content">
            <h1 class="text-center">Bookmarks</h1>
            <div class="bookmark_card">
                <div class="table-wrapper">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="bookmarkTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══ FOOTER ═══════════════════════════════════════════════ -->
    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const BOOKMARKS_KEY = 'ebookStackBookmarks';

        function getBookmarks() {
            const saved = localStorage.getItem(BOOKMARKS_KEY);
            try {
                return saved ? JSON.parse(saved) : [];
            } catch {
                return [];
            }
        }

        function saveBookmarks(bookmarks) {
            localStorage.setItem(BOOKMARKS_KEY, JSON.stringify(bookmarks));
        }

        function escapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }

        function renderBookmarks() {
            const bookmarks = getBookmarks();
            const tbody = document.getElementById('bookmarkTableBody');
            if (!tbody) return;

            if (!bookmarks.length) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4">No bookmarks yet.</td></tr>';
                return;
            }

            tbody.innerHTML = bookmarks.map(book => `
                <tr data-id="${book.id}">
                    <td class="text-center">
                        <img src="${escapeHtml(book.img)}" alt="${escapeHtml(book.title)}" class="book-img">
                    </td>
                    <td>
                        <a href="${escapeHtml(book.href)}" class="book_title">${escapeHtml(book.title)}</a>
                    </td>
                    <td>${escapeHtml(book.author)}</td>
                    <td>
                        <span class="category-badge">${escapeHtml(book.cat)}</span>
                    </td>
                    <td class="text-center">
                        <button class="remove-btn" type="button" data-id="${book.id}">
                            <i class="fa-solid fa-trash me-1"></i>
                            Remove Bookmark
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function removeBookmark(id) {
            const bookmarks = getBookmarks().filter(item => item.id !== Number(id));
            saveBookmarks(bookmarks);
            renderBookmarks();
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderBookmarks();
            const tbody = document.getElementById('bookmarkTableBody');
            if (!tbody) return;
            tbody.addEventListener('click', event => {
                const button = event.target.closest('.remove-btn');
                if (!button) return;
                removeBookmark(button.dataset.id);
            });
        });
    </script>
</body>

</html>