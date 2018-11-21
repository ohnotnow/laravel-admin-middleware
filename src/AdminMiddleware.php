<?php

namespace Ohffs\LaravelAdminMiddleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!$request->user()) {
            abort(403);
        }
        $field = config('admin-middleware.admin_field');
        if (!$request->user()->$field) {
            abort(403);
        }
        return $next($request);
    }
}
