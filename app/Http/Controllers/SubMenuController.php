<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sub_menus = DB::table('sub_menus')->oldest();

        // $employees = DB::table('employees')
        //     ->leftJoin('jobs', 'employees.job_id', '=', 'jobs.id')
        //     ->Join('departments', 'employees.department_id', '=', 'departments.id');
            // ->get();


        if(request('search')){
            $sub_menus->where('title', 'like', '%' . request('search') . '%')
                      ->orWhere('url', 'like', '%' . request('search') . '%');
        }

        return view('sub_menus.index', [
            'sub_menus' => $sub_menus->paginate(4),
            'count' => DB::table('sub_menus')->count()
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
        return view('sub_menus.create', [
            
            
            'menus' => $menus,
            'is_active' => $is_active
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
        DB::table('sub_menus')->insert([
            'menu_id' => $request->menu_id,
            'title' => $request->title,
            'url' => $request->url,
            'icon' => $request->icon,
            'is_active' => $request->is_active
        ]);

        return redirect('/sub_menus');
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
        $sub_menu = DB::table('sub_menus')->where('id', $id)->first();

        $is_active = ["active" => 1, "Not active" => 0];
        $menus = DB::table('menus')->get();

        return view('sub_menus.edit', [
            'sub_menu' => $sub_menu,
            'menus' => $menus,
            'is_active' => $is_active
            ]);
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
        DB::table('sub_menus')
            ->where('id', $id)
            ->update([
                'menu_id' => $request->menu_id,
                'title' => $request->title,
                'url' => $request->url,
                'icon' => $request->icon,
                'is_active' => $request->is_active
            ]);

        return redirect('/sub_menus');
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
        DB::table('sub_menus')->where('id', $requset->id)->delete();
        return redirect('violations/list');
    }
}
