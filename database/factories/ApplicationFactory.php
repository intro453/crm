<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition(): array
    {
        $type = Arr::random(array_keys(Application::getTypeLabels()));
        $status = Arr::random(array_keys(Application::getStatusLabels()));

        $start = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $hours = $this->faker->numberBetween(1, 8);
        $end = (clone $start)->modify("+{$hours} hours");

        return [
            'client_id' => null,
            'manager_id' => null,
            'lawyer_id' => null,
            'topic_id' => null,
            'court_id' => null,
            'status' => $status,
            'type' => $type,
            'estimated_hours' => $hours,
            'cost' => $this->faker->numberBetween(3000, 50000),
            'scheduled_start_at' => Carbon::instance($start),
            'scheduled_end_at' => Carbon::instance($end),
            'travel_date' => $type === Application::TYPE_VISIT ? Carbon::instance($start)->toDateString() : null,
            'description' => $this->faker->paragraph(),
            'completion_comment' => $status === Application::STATUS_COMPLETED ? $this->faker->sentence() : null,
        ];
    }
}
