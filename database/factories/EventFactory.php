<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event' => $this->faker->name,
            'description' => $this->faker->text,
            'type' => $this->faker->randomElement(['U', 'M', 'A']),
            'timestamp' => random_int(1714592153, 1767202553),
            'user_id' => 1
        ];
    }
}
