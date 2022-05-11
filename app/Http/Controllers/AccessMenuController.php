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


            $sel_acs_mn = DB::table('access_menus')
                ->where('menu_id', $menu_id)
                ->where('role_id',  $role_id)
                ->first();


            DB::table('methods')
                ->where('access_menu_id', $sel_acs_mn->id)
                ->delete();

            DB::table('access_menus')
                ->where('menu_id', $menu_id)
                ->where('role_id',  $role_id)
                ->delete();

        }else{

            $hari = date('Y-m-d H:i:s');

            DB::table('access_menus')->insert([
                'menu_id' => $menu_id,
                'role_id' => $role_id,
                'created_at' => $hari,
                'updated_at' => $hari
            ]);

            $sel_acs_mn = DB::table('access_menus')
                ->where('created_at' , $hari)
                ->where('updated_at' , $hari)
                ->first();

            $sel_sub_mn = DB::table('sub_menus')
                ->where('menu_id' , $sel_acs_mn->menu_id)
                ->get();

            foreach($sel_sub_mn as $sub_menu):
                DB::table('methods')->insert([
                    'access_menu_id' => $sel_acs_mn->id,
                    'sub_menu_id' => $sub_menu->id,
                    'edit' => 'false',
                    'delete' => 'false',
                    'view' => 'false',
                    'created_at' => $hari,
                    'updated_at' => $hari
                ]);
            endforeach;
/* */
        }
    }

    public function changeaccess_method(Request $request){

        $methodId = $request->methodId;
        $val = $request->val;
        $hari = date('Y-m-d H:i:s');

        $mtd_sel = DB::table('methods')
            ->where('id' , $methodId)
            ->first();

        if($val == 'edit'){
            $num_mtd_sel = DB::table('methods')
                ->where('id' , $methodId)
                ->where('edit' , 'true')
                ->count();

            if($num_mtd_sel > 0){
                $edit = 'false';
            }else{
                $edit = 'true';
            }

             $delete = $mtd_sel->delete;
             $view = $mtd_sel->view;

        }elseif($val == 'delete'){
            $num_mtd_sel = DB::table('methods')
                ->where('id' , $methodId)
                ->where('delete' , 'true')
                ->count();

            if($num_mtd_sel > 0){
                $delete = 'false';
            }else{
                $delete = 'true';
            }
             $edit = $mtd_sel->edit;
             $view = $mtd_sel->view;

        }elseif($val == 'view'){
            $num_mtd_sel = DB::table('methods')
                ->where('id' , $methodId)
                ->where('view' , 'true')
                ->count();

            if($num_mtd_sel > 0){
                $view = 'false';
            }else{
                $view = 'true';
            }
             $edit = $mtd_sel->edit;
             $delete = $mtd_sel->delete;
        }else{

        }

        DB::table('methods')
            ->where('id', $methodId)
            ->update([
                'edit' => $edit,
                'delete' => $delete,
                'view' => $view,
                'updated_at' => $hari
        ]);
    }
}
