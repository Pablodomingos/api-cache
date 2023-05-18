<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $path = app_path('Repositories');

        $files = File::files($path);

         foreach ($files as $file) {
            $repository = substr($file->getFilename(), 0, -4);
            $this->app->singleton("App\\Repositories\\Interfaces\\{$repository}Interface", "App\\Repositories\\{$repository}");
        }
    }
}
