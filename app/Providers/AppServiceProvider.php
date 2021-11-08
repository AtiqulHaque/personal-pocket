<?php

namespace App\Providers;

use App\Contracts\Service\BookingServiceContract;
use App\Contracts\Service\NewServiceContract;
use App\Contracts\Service\PocketContentServiceContract;
use App\Contracts\Service\PocketServiceContract;
use App\Contracts\Service\ResponseProcessor;
use App\Services\Crawler\HtmlResponseProcessor;
use App\Services\PocketContentService;
use App\Services\PocketService;
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
