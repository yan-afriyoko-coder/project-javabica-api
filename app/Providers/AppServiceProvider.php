<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Interfaces\BlogCategoryInterface;
use App\Repositories\BlogCategoryRepository;
use App\Interfaces\MachineInterface;
use App\Repositories\MachineRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BlogCategoryInterface::class, BlogCategoryRepository::class);
        $this->app->bind(MachineInterface::class, MachineRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
     
        Schema::defaultStringLength(125);
    }
}
