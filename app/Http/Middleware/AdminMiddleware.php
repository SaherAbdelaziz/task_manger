<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || !$user->is_admin) {
            return redirect('/tasks'); // redirect to a page of your choice
        }

        return $next($request);
    }
}
