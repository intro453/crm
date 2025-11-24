<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Model::preventLazyLoading(); //100 select вместо одного
        //Model::preventAccessingMissingAttributes(); // не существующие атрибуты в таблице
        //Model::preventSilentlyDiscardingAttributes(); // передача лишних данных не указанных в filliable
        Model::shouldBeStrict(); // врубаем сразу все 3 жестких защиты
        User::observe(UserObserver::class);
    }
}
