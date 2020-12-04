<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
        if (!User::first() && $didnhaveuser !== 'didnhaveuser') {
            Artisan::call('db:seed', ['--class' => 'UserSeeder']);
            return redirect('superadmin-created');
        }
        return $next($request);
    }
}
