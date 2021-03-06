<?php

namespace App\Http\Controllers;

use App\Models\HiEmployee;
use App\Models\Employee;
use App\Models\Investigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

class HiEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //asli
        // return view('hi.employees.index', [
        //     'employees' => Employee::all()
             
        // ]);

// dd(request('search'));
        $employees = Employee::latest();

        if(request('search')){
            $employees->where('number_of_employees', 'like', '%' . request('search') . '%')
                      ->orWhere('name', 'like', '%' . request('search') . '%');
        }

        return view('hi.employees.index', [
            
            
            'employees' => $employees->paginate(15)
             
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
        return view('hi.employees.create'
        , [
            
            
            'employees' => Employee::all()
        ]
    );
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
        $validatedData =  $request->validate([
            'number_of_employees' => 'required',
            'email' => 'required',
            'name' => 'required',
            'phone_number' => 'required'
            ]);
            // dd($validatedData);
        Employee::create($validatedData);
        return redirect('/hi/employees')->with('success', 'New Post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HiEmployee  $hiEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
        // return view('hi.employees.show', [
        //     'hiEmployee' => Employee::find($hiEmployee)
        // ]);
        // $investigationemployee = DB::table('investigations')->where('employee_id', $employee->id);
        // $investigation->where('employee_id', 'like', '%' . request('search') . '%');
        $investigation = DB::table('investigations')
                ->where('employee_id', '=', $employee->id)
                ->get();

        return view('hi.employees.show', [
            
            
            'employee' => $employee,
            'investigations' => $investigation
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HiEmployee  $hiEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
// echo 'oke';
        // return view('hi.employees.edit', [
        //     'employee' => Employee::find($id)
        // ]);
        return view('hi.employees.create'
        , [
            
            
            'employees' => Employee::all()
        ]
    );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HiEmployee  $hiEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
            //    dd($request);
               $rules =  [
                'number_of_employees' => 'required|max:255',
                'email' => 'required',
                'name' => 'required',
                'phone_number' => 'required'
            ];

            $validatedData = $request->validate($rules);
        
            Employee::where('id', $employee->id)
                ->update($validatedData);
            return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HiEmployee  $hiEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Employee:: destroy ($employee->id);
        return redirect('/hi/employees')->with('success', 'Post has been deleted!');
    }
}
