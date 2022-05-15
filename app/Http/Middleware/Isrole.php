<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Isrole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if(!auth()->check() || auth->user()->role !== 2){
        //     abort(403);
        // }

/*        SELECT * FROM access_menus RIGHT JOIN methods ON access_menus.id = methods.access_menu_id
WHERE access_menus.role_id = 1 AND methods.sub_menu_id = 18;
*/
        $url_xtz = url()->current();
        // http://127.0.0.1:8000
        $url_sc = substr($url_xtz, 21); 

        $num_sub = DB::table('sub_menus')->where('url', $url_xtz)->count();

        

        return $next($request);
    }
}
