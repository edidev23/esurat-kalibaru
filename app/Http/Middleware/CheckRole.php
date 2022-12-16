<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // dd($role);
        if (in_array($request->user()->jabatan, $roles)) {
            return $next($request);
        } else {
            if (auth()->user()->jabatan == 'admin') {
                return redirect('admin');
            } elseif (auth()->user()->jabatan == 'kepala_desa' || auth()->user()->jabatan == 'sekdes') {
                return redirect('kades');
            }
        }

        return redirect('login');
    }
}
