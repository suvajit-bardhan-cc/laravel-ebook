<x-admin-layout>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

    <div class="max-w-4xl mx-auto space-y-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Book</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Update book information</p>
            </div>
            <a href="{{ route('admin.books.index') }}" 
               class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                ← Back to Books
            </a>
        </div>

        <!-- Edit Book Form -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="px-6 py-6 space-y-6">
                    <!-- Current Cover Image -->
                    @if($book->cover_image)
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Current Cover Image
                        </label>
                        <div class="w-32 h-40 rounded-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
                            <img src="{{ $book->cover_image_url }}" 
                                 alt="{{ $book->title }}"
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                    @endif

                    <!-- Cover Image Upload -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Change Cover Image
                        </label>
                        <div class="flex items-center gap-6">
                            <div id="imagePreview" class="hidden w-32 h-40 rounded-lg border border-slate-200 dark:border-slate-700 overflow-hidden bg-slate-100 dark:bg-slate-900">
                                <img id="previewImg" class="w-full h-full object-cover" src="" alt="Preview">
                            </div>
                            <div class="flex-1">
                                <input type="file" 
                                       name="cover_image" 
                                       id="cover_image"
                                       accept="image/*"
                                       class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-700 dark:file:text-slate-300">
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Leave empty to keep current image</p>
                            </div>
                        </div>
                        @error('cover_image')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title Field -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Book Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title"
                               value="{{ old('title', $book->title) }}"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author Name Field -->
                    <div>
                        <label for="author_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Author Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="author_name" 
                               id="author_name"
                               value="{{ old('author_name', $book->author_name) }}"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('author_name') border-red-500 @enderror">
                        @error('author_name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Categories Field -->
                    <div>
                        <label for="categories" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Categories
                        </label>
                        <select name="categories[]"
                                id="categories"
                                multiple
                                class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id, $bookCategories) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Hold Ctrl/Cmd to select multiple categories</p>
                        @error('categories')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags Field -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="tags" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                Tags
                            </label>
                            <button type="button" id="addNewTagBtn" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">
                                + Add New Tag
                            </button>
                        </div>
                        <select name="tags[]"
                                id="tags"
                                multiple
                                class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, $bookTags) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Hold Ctrl/Cmd to select multiple tags</p>
                        @error('tags')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Tag Modal -->
                    <div id="newTagModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 max-w-sm w-full mx-4">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Create New Tag</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="newTagName" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                                        Tag Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                           id="newTagName"
                                           placeholder="Enter tag name"
                                           class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div class="flex gap-3 justify-end">
                                    <button type="button" id="cancelTagBtn" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                                        Cancel
                                    </button>
                                    <button type="button" id="createTagBtn" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium">
                                        Create Tag
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Language Field -->
                    <div>
                        <label for="language" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Language
                        </label>
                        <select name="language" 
                                id="language"
                                class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select Language</option>
                            <option value="English" {{ old('language', $book->language) == 'English' ? 'selected' : '' }}>English</option>
                            <option value="Spanish" {{ old('language', $book->language) == 'Spanish' ? 'selected' : '' }}>Spanish</option>
                            <option value="French" {{ old('language', $book->language) == 'French' ? 'selected' : '' }}>French</option>
                            <option value="German" {{ old('language', $book->language) == 'German' ? 'selected' : '' }}>German</option>
                            <option value="Chinese" {{ old('language', $book->language) == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                            <option value="Japanese" {{ old('language', $book->language) == 'Japanese' ? 'selected' : '' }}>Japanese</option>
                            <option value="Other" {{ old('language', $book->language) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('language')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- About Field -->
                    <div>
                        <label for="about" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            About the Book
                        </label>
                        <textarea name="about" 
                                  id="about"
                                  rows="6"
                                  class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('about') border-red-500 @enderror">{{ old('about', $book->about) }}</textarea>
                        @error('about')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                            <span id="charCount">{{ strlen($book->about ?? '') }}</span> characters entered
                        </p>
                    </div>

                    <!-- Content Field -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Content
                        </label>
                        <textarea name="content"
                                  id="content"
                                  rows="10">{{ old('content', $book->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-200 dark:border-slate-700 flex justify-end gap-3">
                    <a href="{{ route('admin.books.index') }}" 
                       class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                        Update Book
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script>
        // Summernote rich text editor
        $(document).ready(function() {
            $('#content').summernote({
                height: 400,
                placeholder: 'Write book content here...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'undo', 'redo']],
                ],
                callbacks: {
                    onInit: function() {
                        // Apply dark mode styles if active
                        if (document.documentElement.classList.contains('dark')) {
                            $('.note-editor').css({'background':'#1e293b','border-color':'#475569'});
                            $('.note-editable').css({'background':'#0f172a','color':'#f1f5f9'});
                            $('.note-toolbar').css({'background':'#1e293b','border-color':'#475569'});
                        }
                    }
                }
            });
        });
    </script>
    <script>
        // Image preview
        const imageInput = document.getElementById('cover_image');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.classList.add('hidden');
                previewImg.src = '';
            }
        });

        // Character counter
        const aboutTextarea = document.getElementById('about');
        const charCountSpan = document.getElementById('charCount');

        function updateCharCount() {
            charCountSpan.textContent = aboutTextarea.value.length;
        }

        if (aboutTextarea) {
            aboutTextarea.addEventListener('input', updateCharCount);
        }

        // Tag modal functionality
        const addNewTagBtn = document.getElementById('addNewTagBtn');
        const newTagModal = document.getElementById('newTagModal');
        const cancelTagBtn = document.getElementById('cancelTagBtn');
        const createTagBtn = document.getElementById('createTagBtn');
        const newTagName = document.getElementById('newTagName');
        const tagsSelect = document.getElementById('tags');

        addNewTagBtn.addEventListener('click', (e) => {
            e.preventDefault();
            newTagModal.classList.remove('hidden');
            newTagName.focus();
        });

        cancelTagBtn.addEventListener('click', () => {
            newTagModal.classList.add('hidden');
            newTagName.value = '';
        });

        createTagBtn.addEventListener('click', () => {
            const tagName = newTagName.value.trim();
            if (!tagName) {
                alert('Please enter a tag name');
                return;
            }

            // Create FormData for AJAX request
            const formData = new FormData();
            formData.append('name', tagName);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            fetch('{{ route("admin.tags.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add new tag to select
                    const option = document.createElement('option');
                    option.value = data.tag.id;
                    option.textContent = data.tag.name;
                    option.selected = true;
                    tagsSelect.appendChild(option);

                    // Close modal and reset
                    newTagModal.classList.add('hidden');
                    newTagName.value = '';
                } else {
                    alert('Error creating tag: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error creating tag');
            });
        });

        // Close modal on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !newTagModal.classList.contains('hidden')) {
                newTagModal.classList.add('hidden');
                newTagName.value = '';
            }
        });

        // Close modal when clicking outside
        newTagModal.addEventListener('click', (e) => {
            if (e.target === newTagModal) {
                newTagModal.classList.add('hidden');
                newTagName.value = '';
            }
        });
    </script>
    @endpush
</x-admin-layout>