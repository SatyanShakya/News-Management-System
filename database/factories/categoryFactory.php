<?php

namespace Database\Factories;

use App\Models\category;
use App\Models\post;
use Illuminate\Database\Eloquent\Factories\Factory;

class categoryFactory extends Factory
{

    protected $model = category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
            'description' => $this->faker->sentence,
            'published' => $this->faker->boolean,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (category $category) {
            $posts = post::factory(5)->create();
            $category->posts()->saveMany($posts);
        });
    }
}
