<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccessMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('access_menus.index', [
            'access_menus' => DB::table('access_menus')->get(),
            'count' => DB::table('access_menus')->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $is_active = ["active" => 1, "Not active" =>0];
        $menus = DB::table('menus')->get();
        $roles = DB::table('roles')->get();
        return view('access_menus.create',[
            'menus' => $menus,
            'roles' => $roles
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        DB::table('access_menus')->insert([
            'menu_id' => $request->menu_id,
            'role_id' => $request->role_id
        ]);

        return redirect('/access_menus');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeaccess(Request $request)
    {
        //
        $menu_id = $request->menuId;
        $role_id = $request->roleId;

        $num_access = DB::table('access_menus')->where('menu_id', $menu_id)->where('role_id', $role_id)->count();
        
        if($num_access > 0){
            DB::table('access_menus')
            ->where('menu_id', $menu_id)
            ->where('role_id',  $role_id)
            ->delete();
        }else{
            DB::table('access_menus')->insert([
                'menu_id' => $menu_id,
                'role_id' => $role_id
            ]);
        }
    }
}
