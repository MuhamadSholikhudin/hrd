<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use App\Models\Salary;

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = Employee::oldest();

        // $employees = DB::table('employees')
        //     ->leftJoin('jobs', 'employees.job_id', '=', 'jobs.id')
        //     ->Join('departments', 'employees.department_id', '=', 'departments.id');
            // ->get();

        if(request('search')){
            $employees->where('number_of_employees', 'like', '%' . request('search') . '%')
                      ->orWhere('name', 'like', '%' . request('search') . '%')
                      ->orWhere('national_id', 'like', '%' . request('search') . '%');
        }
        
        return view('hi.violations.index', [
            'employees' => $employees->paginate(10),
            'count' => DB::table('employees')->count()
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
        $employee = DB::table('employees')->where('id', $id)
                    ->first();

        return view('hi.violations.edit', [
            'employee' => $employee,
            'jobs' => Job::all(),
            'departments' => Department::all()
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
}
