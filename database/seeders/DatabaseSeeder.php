<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::factory(4)->create();

        $categories->each(function (Category $category): void {
            $posts = Post::factory(3)->create(['category_id' => $category->id]);

            $posts->each(function (Post $post): void {
                Comment::factory(rand(1, 4))->create(['post_id' => $post->id]);
            });
        });
    }
}
