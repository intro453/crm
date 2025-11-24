<?php

namespace Database\Factories;

use App\Models\Court;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Court>
 */
class CourtFactory extends Factory
{
    protected $model = Court::class;

    public function definition(): array
    {
        return [
            'name' => 'Суд ' . $this->faker->city(),
            'region' => $this->faker->state(),
            'address' => $this->faker->streetAddress(),
        ];
    }
}
