<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            abort(403, 'Belum Mempunyai account');
        }

        $rolesArray = explode('|', $roles);
        $user = Auth::user();

        foreach ($rolesArray as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        return redirect('/');
    }
}