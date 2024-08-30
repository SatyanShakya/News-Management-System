<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\post;
use App\Models\category;
use App\Models\Author;

class postFactory extends Factory
{

    protected $model = post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'summary' => $this->faker->sentence,
            'published' => $this->faker->boolean,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (post $post) {
            $authors = Author::factory(3)->create();
            $post->authors()->attach($authors);
        });
    }

}
