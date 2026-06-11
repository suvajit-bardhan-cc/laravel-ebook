<x-app-layout>
    <div class="hero-strip">
        <div class="inner">
            <span class="bc">
                <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a> &rsaquo;
                <span id="bcLabel">My Bookmarks</span>
            </span>
        </div>
    </div>

    <div class="page-wrap">
        <main class="content" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
            <!-- Header -->
            <div class="text-center d-flex justify-content-center align-items-center">
                <div>
                    <h1 style="font-size: 28px; font-weight: bold; color: #1f2937; margin: 0;">My Bookmarks</h1>
                    <p style="font-size: 14px; color: #6b7280; margin-top: 8px;">Manage your saved books</p>
                </div>
            </div>

            <!-- Bookmarks Table -->
            @if($bookmarks->count() > 0)
                <div style="background: white; border-radius: 12px; border: 1px solid #e5e7eb; overflow: hidden;">
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; font-size: 14px; border-collapse: collapse;">
                            <thead style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                                <tr>
                                    <th style="padding: 12px 20px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Cover</th>
                                    <th style="padding: 12px 20px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Title</th>
                                    <th style="padding: 12px 20px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Author</th>
                                    <th style="padding: 12px 20px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Categories</th>
                                    <th style="padding: 12px 20px; text-align: right; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookmarks as $bookmark)
                                    <tr class="bookmark-row" data-book-id="{{ $bookmark->book->id }}" style="border-bottom: 1px solid #f3f4f6; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor=''">
                                        <td style="padding: 16px 20px;">
                                            <img src="{{ $bookmark->book->cover_image_url }}"
                                                 alt="{{ $bookmark->book->title }}"
                                                 style="width: 50px; height: 70px; object-fit: cover; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                                        </td>
                                        <td style="padding: 16px 20px;">
                                            <a href="{{ route('books.show', encrypt($bookmark->book->id)) }}"
                                               style="font-weight: 600; color: #1f2937; text-decoration: none; transition: color 0.2s;">
                                                {{ $bookmark->book->title }}
                                            </a>
                                        </td>
                                        <td style="padding: 16px 20px; color: #6b7280;">
                                            {{ $bookmark->book->author_name }}
                                        </td>
                                        <td style="padding: 16px 20px;">
                                            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                                @forelse($bookmark->book->categories as $category)
                                                    <span style="display: inline-block; background-color: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 12px; font-size: 12px;">
                                                        {{ $category->name }}
                                                    </span>
                                                @empty
                                                    <span style="color: #9ca3af; font-size: 12px;">No categories</span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td style="padding: 16px 20px; text-align: right;">
                                            <button class="remove-bookmark-btn"
                                                    data-book-id="{{ $bookmark->book->id }}"
                                                    style="background: none; border: none; color: #dc2626; cursor: pointer; font-size: 16px; padding: 6px 12px; transition: color 0.2s;"
                                                    title="Remove bookmark"
                                                    onmouseover="this.style.color='#991b1b'"
                                                    onmouseout="this.style.color='#dc2626'">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div style="padding: 16px 20px; border-top: 1px solid #e5e7eb;">
                        {{ $bookmarks->links() }}
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div style="background: white; border-radius: 12px; border: 1px solid #e5e7eb; padding: 60px 20px; text-align: center;">
                    <div style="display: flex; flex-direction: column; align-items: center; gap: 16px;">
                        <svg style="width: 64px; height: 64px; color: #d1d5db;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h6a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path>
                        </svg>
                        <div>
                            <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 8px 0;">No bookmarks yet</h3>
                            <p style="color: #6b7280; margin: 0; font-size: 14px;">Start exploring books and add them to your bookmarks to keep track of your favorites.</p>
                        </div>
                        <a href="{{ route('dashboard') }}"
                           style="display: inline-block; padding: 10px 24px; background-color: #2563eb; color: white; text-decoration: none; border-radius: 8px; font-size: 14px; font-weight: 500; margin-top: 8px; transition: background-color 0.2s;"
                           onmouseover="this.style.backgroundColor='#1d4ed8'"
                           onmouseout="this.style.backgroundColor='#2563eb'">
                            Browse Books
                        </a>
                    </div>
                </div>
            @endif
        </main>
    </div>

    <script>
        // Handle remove bookmark button clicks
        document.querySelectorAll('.remove-bookmark-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();

                if (!confirm('Remove this bookmark?')) {
                    return;
                }

                const bookId = btn.dataset.bookId;
                const row = document.querySelector(`tr[data-book-id="${bookId}"]`);

                // Disable button and show loading state
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                try {
                    const response = await fetch(`/api/bookmarks/${bookId}/toggle`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Fade out and remove the row
                        row.style.animation = 'fadeOut 0.3s ease-out';
                        setTimeout(() => {
                            row.remove();
                            // Check if table is empty
                            const tableBody = document.querySelector('tbody');
                            if (tableBody.querySelectorAll('tr').length === 0) {
                                location.reload();
                            }
                        }, 300);
                    } else {
                        alert(data.message || 'Error removing bookmark');
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fas fa-trash-alt"></i>';
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error removing bookmark');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-trash-alt"></i>';
                }
            });
        });

        // Add fade out animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeOut {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(20px);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</x-app-layout>
