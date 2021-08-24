<?php

namespace App\Http\Middleware;
use Auth;
use Illuminate\Support\Facades\Route;

use Closure;

class LoginAdmin
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
        if(Auth::check())
        {
            if(Auth::user()->hasAnyRoles(['Admin','NhanVienHoTro','NhanVienQuanLy']))
            {
            return $next($request);
            }
             return redirect('LoginAdmin')->with('thongbaoloi','Bạn chưa có quyền vào trang này hãy liên hệ admin để được cấp quyền!!!');
        }else{
            return redirect('LoginAdmin');
        }
        
    }
}
