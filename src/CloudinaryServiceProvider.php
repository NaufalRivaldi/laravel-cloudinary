<?php

namespace SdbAgency\LaravelCloudinary;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class CloudinaryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
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
        Storage::extend('cloudinary', function (Application $app, array $config) {
            $adapter = new CloudinaryAdapter($config);

            return new FilesystemAdapter(new Filesystem($adapter, $config), $adapter, $config);
        });

        $this->publishes([
            __DIR__.'/../config/flysystem-cloudinary.php' => config_path('flysystem-cloudinary.php'),
        ], 'config');
    }
}
