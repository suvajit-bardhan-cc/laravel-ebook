<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Read the books.json file
        $jsonPath = database_path('seeders/data/books.json');

        if (!file_exists($jsonPath)) {
            $this->command->warn("books.json not found at {$jsonPath}");
            return;
        }

        $booksData = json_decode(file_get_contents($jsonPath), true);

        if (empty($booksData)) {
            $this->command->warn("No books data found in books.json");
            return;
        }

        $this->command->info('Starting to seed books...');

        foreach ($booksData as $bookData) {
            // Create or update book
            $book = Book::updateOrCreate(
                ['title' => $bookData['title'] ?? null],
                [
                    'author_name' => $bookData['author'] ?? 'Unknown Author',
                    'about' => $bookData['desc'] ?? null,
                    'cover_image' => $bookData['img'] ?? null,
                    'language' => 'English',
                ]
            );

            // Handle categories
            if (!empty($bookData['cat']) && is_array($bookData['cat'])) {
                $categoryIds = [];

                foreach ($bookData['cat'] as $categoryName) {
                    // Create or get category with slug
                    $category = Category::firstOrCreate(
                        ['slug' => Str::slug($categoryName)],
                        [
                            'name' => $categoryName,
                            'status' => 'active'
                        ]
                    );
                    $categoryIds[] = $category->id;
                }

                // Sync categories (detach old ones, attach new ones)
                $book->categories()->sync($categoryIds);
            }

            // Handle tags
            if (!empty($bookData['tab'])) {
                $tagIds = [];
                $tagValue = $bookData['tab'];

                // Map tag values to actual tag slugs
                $tagMapping = [
                    'featured' => 'featured-title',
                    'bestseller' => 'best-seller',
                    'popular' => 'popular',
                ];

                // Get the actual tag slug from mapping, or use the value as-is
                $tagSlug = $tagMapping[$tagValue] ?? Str::slug($tagValue);

                // Find the tag by slug
                $tag = Tag::where('slug', $tagSlug)->first();

                if ($tag) {
                    $tagIds[] = $tag->id;
                    // Sync tags (detach old ones, attach new ones)
                    $book->tags()->sync($tagIds);
                }
            }

            $this->command->line("✓ Seeded book: {$book->title}");
        }

        $this->command->info("Successfully seeded " . count($booksData) . " books!");

        
    }
}
