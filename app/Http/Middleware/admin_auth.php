<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class admin_auth
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
        if($request->session()->get('admin_id')=="")
            return redirect('admin/login');
        else {
        $type=$request->session()->get('admin_type');
        $id=$request->session()->get('admin_id');
        $admin=DB::select("SELECT * FROM admin WHERE id='$id' LIMIT 1");
        $admin=collect($admin)->first();
            
        view()->share(['admin_type'=>$type, 'admin_id'=>$id, 'admin'=>$admin]);
        }
        return $next($request);
    }
}
