<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\IThreadRepository;
use App\Infrastructure\Repositries\ThreadRepository;
use App\Domain\Repositories\IResRepository;
use App\Infrastructure\Repositries\ResRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IThreadRepository::class, function ($app) {
            return new ThreadRepository();
        });
        $this->app->singleton(IResRepository::class, function ($app) {
            return new ResRepository();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
