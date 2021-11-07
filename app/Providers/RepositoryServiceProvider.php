<?php

namespace App\Providers;

use App\Contracts\PocketRepository;
use App\Contracts\SiteContentRepository;
use App\Contracts\TagRepository;
use App\Repositories\PocketRepositoryEloquent;
use App\Repositories\SiteContentRepositoryEloquent;
use App\Repositories\TagRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PocketRepository::class, PocketRepositoryEloquent::class);
        $this->app->bind(TagRepository::class, TagRepositoryEloquent::class);
        $this->app->bind(SiteContentRepository::class, SiteContentRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\ContentRepository::class, \App\Repositories\ContentRepositoryEloquent::class);
        //:end-bindings:
    }
}
