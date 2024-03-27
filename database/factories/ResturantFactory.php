<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\resturant>
 */
class ResturantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name,
            'description'=>$this->faker->realText(100),
            'address'=>$this->faker->realText(20),
            'phone'=>$this->faker->phoneNumber,
            'email'=>$this->faker->unique()->safeEmail(),
            'opening_hours'=>$this->faker->dateTime(),
            'place_id'=>$this->faker->numberBetween(1,5),
        ];
    }
}
