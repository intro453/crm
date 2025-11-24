<?php

namespace App\Listeners;

use App\Events\UserVisitedUserList;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserVisitedUserList
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserVisitedUserList $event): void
    {
        $user = $event->user;

        $date = Carbon::now()->format('H:i:s d.m.y');

        Log::info("Пользователь {$user->name} (id={$user->id}) зашел на страницу в {$date}");
    }
}
