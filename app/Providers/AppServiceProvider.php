<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\IThreadRepository;
use App\Infrastructure\Repositries\ThreadRepository;
use App\Domain\Repositories\IResRepository;
use App\Infrastructure\Repositries\ResRepository;
use App\Domain\Repositories\ICategoryRepository;
use App\Infrastructure\Repositries\CategoryRepository;
use Carbon\Carbon;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        Carbon::setLocale(config('app.locale'));

        $this->app->singleton(IThreadRepository::class, function ($app) {
            return new ThreadRepository();
        });
        $this->app->singleton(IResRepository::class, function ($app) {
            return new ResRepository();
        });
        $this->app->singleton(ICategoryRepository::class, function ($app) {
            return new CategoryRepository();
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
