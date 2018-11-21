<?php

namespace Ohffs\LaravelAdminMiddleware;

use Illuminate\Support\ServiceProvider;
use Ohffs\LaravelAdminMiddleware\AdminMiddleware;

class AdminMiddlewareProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/admin-middleware.php' => config_path('admin-middleware.php'),
        ]);

        app('router')->aliasMiddleware('admin', AdminMiddleware::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admin-middleware.php', 'admin-middleware');
    }
}
