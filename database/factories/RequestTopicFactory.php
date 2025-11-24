<?php

namespace Database\Factories;

use App\Models\RequestTopic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RequestTopic>
 */
class RequestTopicFactory extends Factory
{
    protected $model = RequestTopic::class;

    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->words(2, true)),
            'description' => $this->faker->optional()->sentences(2, true),
            'is_active' => $this->faker->boolean(85),
        ];
    }
}
