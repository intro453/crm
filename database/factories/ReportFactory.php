<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Report>
 */
class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition(): array
    {
        $periodEnd = Carbon::instance($this->faker->dateTimeBetween('-1 year', 'now'));
        $periodStart = (clone $periodEnd)->subDays($this->faker->numberBetween(7, 60));
        $total = $this->faker->numberBetween(5, 120);
        $completed = $this->faker->numberBetween(0, $total);

        return [
            'title' => 'Отчет ' . $periodStart->format('d.m.Y') . ' - ' . $periodEnd->format('d.m.Y'),
            'period_start' => $periodStart,
            'period_end' => $periodEnd,
            'total_applications' => $total,
            'completed_applications' => $completed,
            'total_revenue' => $this->faker->numberBetween(50000, 800000),
            'summary' => $this->faker->optional()->paragraphs(2, true),
        ];
    }
}
