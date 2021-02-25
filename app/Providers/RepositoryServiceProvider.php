<?php

namespace App\Providers;

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
        // Grades Repository
        $this->app->bind(
            'App\Http\Interfaces\GradesRepositoryInterface',
            'App\Http\Repository\GradesRepository'
        );

        // Classes Repository
        $this->app->bind(
            'App\Http\Interfaces\ClassroomsRepositoryInterface',
            'App\Http\Repository\ClassroomsRepository'
        );

        // Sections Repository
        $this->app->bind(
            'App\Http\Interfaces\SectionsRepositoryInterface',
            'App\Http\Repository\SectionsRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
