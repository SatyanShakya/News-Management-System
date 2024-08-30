<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;

class AuthorFactory extends Factory
{

        protected $model = Author::class;

        public function definition()
        {
            return [
                'name' => $this->faker->name,
                'description' => $this->faker->sentence,
                'image' => $this->faker->imageUrl(),
                'published' => $this->faker->boolean,
            ];
        }
    
}
