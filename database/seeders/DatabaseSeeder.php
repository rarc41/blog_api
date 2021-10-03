<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comments;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // User
        User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'name' => 'konecta'
        ]);

        User::factory(10)->create();

        Category::factory(10)->create();

        Post::factory(20)->create()->each(function ($post) {
            $post->tags()->attach($this->tagValue(rand(1, 15)));
        });

        Comments::factory(100)->create();
        Tag::factory(25)->create();
    }
    protected function tagValue($value)
    {
        $tags = [];
        for ($i = 0; $i < $value; $i++) {
            $tags[] = $i;
        }
    }
}
