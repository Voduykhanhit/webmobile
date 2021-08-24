<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Route;

class CustomerTruyCap
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
        if(Session::get('customer_id')!=NULL)
        {
            return $next($request);
        }else{
            return redirect('home/trangchu')->with('thongbaoloi','Bạn chưa đăng nhập không được quyền vào trang này!!!');
        }
        
    }
}
