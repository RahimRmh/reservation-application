<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Carbon\Factory as CarbonFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\place>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>$this->faker->numberBetween(1,15) ,
            'resturant_id' => $this->faker->numberBetween(1, 10),
            'start_date' => Carbon::now()->addDays($this->faker->numberBetween(1, 30))->addHours($this->faker->numberBetween(1, 12))->addMinutes($this->faker->numberBetween(1, 60)),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'canceled']),
            'notes' => $this->faker->sentence(),       
            'quantity' => $this->faker->numberBetween(1,20),       
         ];
    }
}

