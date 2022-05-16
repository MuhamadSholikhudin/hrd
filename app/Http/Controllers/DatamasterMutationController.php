<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use App\Models\Salary;
use App\Models\Mutation;

class DatamasterMutationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::oldest();

        if(request('search')){
            $employees->where('number_of_employees', 'like', '%' . request('search') . '%')
                      ->orWhere('name', 'like', '%' . request('search') . '%')
                      ->orWhere('national_id', 'like', '%' . request('search') . '%');
        }

        return view('datamaster.mutations.index', [
            'employees' => $employees->paginate(15),
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
        return view('datamaster.mutations.create');
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
        DB::table('employees')
        ->where('id' , $request->id)
        ->update([
            'bagian'=> $request->bagian,
            'cell'=> $request->cell, 
            'job_id'=> $request->job_id,
            'department_id'=> $request->department_id
            ]);

        DB::table('mutations')->insertOrIgnore([
            'mutation_date'=> $request->mutation_date,
            'bagian'=> $request->bagian,
            'cell'=> $request->cell, 
            'job_id'=> $request->job_id,
            'department_id'=> $request->department_id,
            'employee_id'=> $request->id
            ]);

        return redirect('/datamaster/mutations/'. $request->id . '/edit');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = DB::table('employees')->where('id', $id)
            ->first();
        
        $get_job = DB::table('jobs')->where('id', $employee->job_id)
            ->first();

        $get_department = DB::table('departments')
            ->where('id', $employee->department_id)->first();
        
        $mutations = DB::table('mutations')
            ->leftJoin('departments', 'mutations.department_id', '=', 'departments.id')
            ->leftJoin('jobs', 'mutations.job_id', '=', 'jobs.id')
            // ->latest()
            ->where('employee_id', '=', $id) 
            ->get();
        
        //Menampilkan data startworks paling lama berdasarkan id employee
        $startwork_get = DB::table('startworks')
            ->where('employee_id', '=', $id)
            ->leftJoin('departments', 'startworks.department_id', '=', 'departments.id')
            ->leftJoin('jobs', 'startworks.job_id', '=', 'jobs.id')
            ->orderBy('startworks.id')
            ->limit(1)
            // ->where('votes', '=', 100)
            // ->where('age', '>', 35)
            ->get(); 
            // ->oldest() 
            // ->first();

        return view('datamaster.mutations.show', [
            'employee' => $employee,
            'jobs' => Job::all(),
            'startwork_get' => $startwork_get,
            'departments' => Department::all(),
            'mutations' => $mutations,
            'get_job' => $get_job,
            'get_department' => $get_department
        ]);
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
        
        $get_job = DB::table('jobs')->where('id', $employee->job_id)
            ->first();

        $get_department = DB::table('departments')
            ->where('id', $employee->department_id)->first();
        
        $mutations = DB::table('mutations')
            ->leftJoin('departments', 'mutations.department_id', '=', 'departments.id')
            ->leftJoin('jobs', 'mutations.job_id', '=', 'jobs.id')
            // ->latest()
            ->where('employee_id', '=', $id) 
            ->get();
        
        //Menampilkan data mutatios paling lama berdasarkan id employee
        $startwork_get = DB::table('startworks')
            ->where('employee_id', '=', $id)
            ->leftJoin('departments', 'startworks.department_id', '=', 'departments.id')
            ->leftJoin('jobs', 'startworks.job_id', '=', 'jobs.id')
            // ->leftJoin('employees', 'mutatios.employee_id', '=', 'employees.id')
            ->orderBy('startworks.id')
            ->limit(1)
            // ->where('votes', '=', 100)
            // ->where('age', '>', 35)
            ->get(); 
            // ->oldest() 
            // ->first();

        return view('datamaster.mutations.create', [
            
            
            'employee' => $employee,
            'jobs' => Job::all(),
            'startwork_get' => $startwork_get,
            'departments' => Department::all(),
            'mutations' => $mutations,
            'get_job' => $get_job,
            'get_department' => $get_department
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

        DB::table('mutations')
            ->where('id', '=', $id)
            ->update([
            'mutation_date'=> $request->mutation_date,
            'bagian'=> $request->bagian,
            'cell'=> $request->cell, 
            'job_id'=> $request->job_id,
            'department_id'=> $request->department_id,
            'employee_id'=> $request->id
        ]); 
        return redirect('/datamaster/mutations/'. $request->id . '/edit')->with('success', 'Data Promosi Karyawan Berhasil di edit!');

    }

    public function getedit($id)
    {
        // echo $id;
        $mutation = DB::table('mutatios')
            ->where('mutatios.id', '=', $id) 
            ->leftJoin('departments', 'mutatios.department_id', '=', 'departments.id')
            ->leftJoin('jobs', 'mutatios.job_id', '=', 'jobs.id')
            ->leftJoin('employees', 'mutatios.employee_id', '=', 'employees.id')
            ->first();


        return  view('datamaster.mutatios.getedit', [
            
            
            "mutation" => $mutation,
            'jobs' => Job::all(),
            'departments' => Department::all(),
        ]);
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
