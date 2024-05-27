<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $albumIDs = Category::pluck('id')->toArray();;

        return [
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'category_id' => $albumIDs[array_rand($albumIDs)]
        ];
    }
}
