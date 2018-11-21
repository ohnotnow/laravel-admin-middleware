# Laravel Admin Middleware

This is a _very_ basic middleware that just adds an 'admin' middleware.  All it does
is checks if the (default) 'is_admin' field on the user model is truthy and aborts if not.  It's
just a bit of code we used to copy from app to app which was getting a bit tiresome.

## Installation

On Laravel 5.7+ :

```
composer require ohffs/laravel-admin-middleware
```

## Usage

```
Route::get('/admin/report', 'AdminReportController@show')->middleware('admin');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/whatever', 'AdminWhateverController@index');
});
```

## Customisation

If you publish the config file via :

```
php artisan vendor:publish ohffs/laravel-admin-middleware
```

The you can change the db field which is checked on the user model by editing `config/admin-middleware.php`.
