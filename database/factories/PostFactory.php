<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'title' =>$this->faker->realText(50),
            'slug' =>$this->faker->slug,
            'description' =>$this->faker->text(150),
            'content' =>$this->faker->paragraph(2,6),
            'likes'=>$this->faker->numberBetween(0,200),
            'img_url'=>$this->faker->imageUrl('https://source.unsplash.com/random')
        ];
    }
}
