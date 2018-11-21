<?php

namespace Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Routing\Router;
use Route;
use Tests\User;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public $regularUser;
    public $adminUser;

    public function setUp()
    {
        parent::setUp();
        $this->setUpDatabase($this->app);
        $this->registerMiddleWare();
        $this->setUpRoutes($this->app);
        // $this->setUpGate();
        // $this->loadLaravelMigrations();
    }

    protected function getPackageProviders($app)
    {
        return ['Ohffs\LaravelAdminMiddleware\AdminMiddlewareProvider'];
    }

    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->boolean('is_admin');
        });

        $this->regularUser = User::create([
            'username' => 'admin',
            'is_admin' => false,
        ]);
        $this->adminUser = User::create([
            'username' => 'admin',
            'is_admin' => true,
        ]);
    }

    protected function setUpRoutes($app)
    {
        Route::any('/login', function () {
            return 'log in';
        })->name('login');
        Route::any('/anyone', function () {
            return 'content for anyone';
        });
        Route::any('/logged-in-page', ['middleware' => 'auth', function () {
            return 'content for logged in users';
        }]);
        Route::any('/admin-only-page', ['middleware' => 'admin', function () {
            return "content for admins";
        }]);
    }

    protected function registerMiddleware()
    {
        $this->app[Router::class]->middleware('admin', IsAdmin::class);
    }
}
