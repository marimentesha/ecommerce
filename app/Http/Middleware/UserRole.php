<?php

namespace App\Http\Middleware;

use Closure;
use HttpException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     * @throws HttpException
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {

        if (!Auth::check()) {
            return redirect('/login');
        }

        if ( !in_array(Auth::user()->role->name, $roles)) {
            abort(403, 'unauthorized');
        }

        return $next($request);
    }
}
