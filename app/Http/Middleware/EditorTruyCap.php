<?php

namespace App\Http\Middleware;
use Auth;
use Illuminate\Support\Facades\Route;

use Closure;

class EditorTruyCap
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->hasAnyRoles(['NhanVienQuanLy','Admin']))
        {
            return $next($request);
        }
        return redirect('admin/trangchu');
    }
}
