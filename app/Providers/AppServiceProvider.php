<?php

namespace App\Providers;

use App\Contracts\Service\BookingServiceContract;
use App\Contracts\Service\NewServiceContract;
use App\Contracts\Service\PocketContentServiceContract;
use App\Contracts\Service\PocketServiceContract;
use App\Contracts\Service\ResponseProcessor;
use App\Contracts\Service\UserServiceContract;
use App\Services\BookingService;
use App\Services\HtmlResponseProcessor;
use App\Services\NewService;
use App\Services\PocketContentService;
use App\Services\PocketService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PocketServiceContract::class, PocketService::class);
        $this->app->bind(PocketContentServiceContract::class, PocketContentService::class);
        $this->app->bind(ResponseProcessor::class, HtmlResponseProcessor::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
