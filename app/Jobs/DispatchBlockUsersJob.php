<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DispatchBlockUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::chunk(100, function ($users) {
            foreach ($users as $user) {
                BlockUserJob::dispatch($user->id);
            }
        });
        /*
            $user = User::query()->where('is_active', true)->first();
        if ($user) {
            $user->update(['is_active' => false]);
            DispatchBlockUsersJob::dispatch(); // сам себя
        }
        */

    }
}
