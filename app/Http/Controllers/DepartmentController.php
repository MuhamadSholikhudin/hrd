<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::latest();

        if(request('search')){
            $departments->where('department', 'like', '%' . request('search') . '%');
        }

        return view('departments.index', [
            'departments' => $departments->paginate(15)
             
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
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $validatedData =  $request->validate([
            'code_department' => ['required', 'unique:departments'],
            'department' => 'required'
        ]);

        Department::create($validatedData);
        return redirect('/departments')->with('success', 'New Post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('departments.show', [
            'department' => $department
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
        return view('departments.edit', [
            'department' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
        $rules =  [
            // 'code_department' => ['required', 'unique:departments'],
            'department' => 'required'
        ];
        $validatedData = $request->validate($rules);
        Department::where('id', $department->id)
                ->update($validatedData);
        return redirect('/departments')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
        Department::destroy($department->id);
        return redirect('/departments')->with('success', 'Post has been deleted!');
    }
}
