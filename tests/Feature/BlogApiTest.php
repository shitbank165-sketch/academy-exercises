<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BlogApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_can_be_created_and_listed(): void
    {
        $response = $this->postJson('/api/categories', ['name' => 'Technology']);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Technology');

        $this->getJson('/api/categories')
            ->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_posts_can_be_paginated_filtered_searched_and_show_comment_count(): void
    {
        $category = Category::factory()->create(['name' => 'News']);
        $otherCategory = Category::factory()->create(['name' => 'Sports']);

        Post::factory()->create([
            'category_id' => $category->id,
            'title' => 'Laravel Release Notes',
            'slug' => 'laravel-release-notes',
            'content' => 'A post about Laravel.',
        ]);

        Post::factory()->create([
            'category_id' => $otherCategory->id,
            'title' => 'Sports Update',
            'slug' => 'sports-update',
            'content' => 'A sports post.',
        ]);

        Comment::factory()->create(['post_id' => 1, 'message' => 'Great article']);

        $response = $this->getJson('/api/posts?search=Laravel&category=' . $category->id . '&sort=oldest&page=1');

        $response->assertStatus(200)
            ->assertJsonPath('meta.total', 1)
            ->assertJsonPath('data.0.comments_count', 1)
            ->assertJsonPath('data.0.title', 'Laravel Release Notes');
    }

    public function test_posts_can_be_created_with_an_image_upload(): void
    {
        $category = Category::factory()->create();
        Storage::fake('public');

        $response = $this->postJson('/api/posts', [
            'category_id' => $category->id,
            'title' => 'New Post',
            'content' => 'Some content',
            'featured_image' => UploadedFile::fake()->image('cover.jpg'),
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.title', 'New Post');

        $this->assertDatabaseHas('posts', ['title' => 'New Post']);
    }
}
