<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Isrole as Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;


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
        // if(!auth()->check() || auth()->user()->name == 'admin'){
        //     abort(403);
        // }

/*        SELECT * FROM access_menus RIGHT JOIN methods ON access_menus.id = methods.access_menu_id
WHERE access_menus.role_id = 1 AND methods.sub_menu_id = 18;
*/

        if(!auth()->check()){
            // abort(403);
            // return view('abort');    
            return redirect('/abort');    
        }

        $url_nowxz = url()->current();
        $sum_url =SUM_URL_WEB;
        $url_scc = substr($url_nowxz, $sum_url);
        $pecah = explode("/", $url_scc);
        $kalimat1 = $pecah[0];
        $num_sub = DB::table('sub_menus')->where('url', '/'.$kalimat1)->count(); 
        if($num_sub > 0){
            $print_sub = DB::table('sub_menus')->where('url', '/'.$kalimat1)->first();
            $num_meth = DB::table('methods')
                ->leftJoin('access_menus', 'methods.access_menu_id' ,'access_menus.id')
                ->where('methods.sub_menu_id', $print_sub->id)
                ->where('access_menus.role_id', auth()->user()->role_id)
                ->count();
           if($num_meth < 1){
            return redirect('/abort');    
               
            // abort(403);
            // return view('abort');            
           }
        }else{
            return redirect('/abort');    
            
            // abort(403);
            // return view('abort');            
        }

        

/*
if(){

}



*/



/*
        $url_xtz = url()->current();
        // http://127.0.0.1:8000
        $url_sc = substr($url_xtz, 21); 

        $num_sub = DB::table('sub_menus')->where('url', $url_xtz)->count();
*/


        

        return $next($request);
    }
}
