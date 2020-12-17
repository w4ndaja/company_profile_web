<?php

namespace App\Http\Middleware;

use App\Models\Theme;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class DashboardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $didnhaveuser = '')
    {
        if (! User::first() && $didnhaveuser !== 'didnhaveuser') {
            Artisan::call('db:seed', ['--class' => 'UserSeeder']);

            return redirect('superadmin-created');
        }
        Config::set('theme', Theme::firstOrNew());

        return $next($request);
    }
}
