<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Client;
use App\Models\Court;
use App\Models\Report;
use App\Models\RequestTopic;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class LegalCrmSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'login' => 'admin',
            'email' => 'admin@crm.local',
            'role' => User::ROLE_ADMIN,
            'is_active' => true,
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional()->firstName(),
        ]);

        $managers = collect(range(1, 3))->map(fn () => User::factory()->create([
            'role' => User::ROLE_MANAGER,
            'is_active' => true,
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional()->firstName(),
        ]));

        $lawyers = collect(range(1, 5))->map(fn () => User::factory()->create([
            'role' => User::ROLE_LAWYER,
            'is_active' => true,
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional()->firstName(),
        ]));

        $clients = Client::factory()->count(60)->create();
        $topics = RequestTopic::factory()->count(12)->create();
        $courts = Court::factory()->count(8)->create();

        Report::factory()->count(10)->create();

        Application::factory()->count(160)->make()->each(function (Application $application) use ($clients, $topics, $courts, $managers, $lawyers) {
            $application->client_id = $clients->random()->id;
            $application->topic_id = Arr::random([$topics->random()->id, null, $topics->random()->id]);

            if ($application->status !== Application::STATUS_NEW) {
                $application->manager_id = $managers->random()->id;
            }

            if (in_array($application->status, [Application::STATUS_IN_PROGRESS, Application::STATUS_COMPLETED], true)) {
                $application->lawyer_id = $lawyers->random()->id;
            }

            if ($application->type === Application::TYPE_VISIT) {
                $application->court_id = $courts->random()->id;
                $application->travel_date = $application->scheduled_start_at?->toDateString() ?? now()->toDateString();
            }

            if ($application->status === Application::STATUS_COMPLETED) {
                $application->completion_comment = $application->completion_comment ?: fake()->sentence();
            } else {
                $application->completion_comment = null;
            }

            $application->save();
        });
    }
}
