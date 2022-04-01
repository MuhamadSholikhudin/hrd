<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use App\Models\Salary;
use App\Models\Promotion;

class DatamasterPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest();

        if(request('search')){
            $employees->where('number_of_employees', 'like', '%' . request('search') . '%')
                      ->orWhere('name', 'like', '%' . request('search') . '%')
                      ->orWhere('national_id', 'like', '%' . request('search') . '%');
        }

        return view('datamaster.promotions.index', [
            'employees' => $employees->paginate(3)
             
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
        return view('datamaster.promotions.create');
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

        DB::table('promotions')->insertOrIgnore([
            'promotion_date'=> $request->promotion_date,
            'bagian'=> $request->bagian,
            'cell'=> $request->cell, 
            'job_id'=> $request->job_id,
            'department_id'=> $request->department_id,
            'employee_id'=> $request->id
            ]);

        return redirect('/datamaster/promotions/'. $request->id . '/edit');

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
        
        $promotions = DB::table('promotions')
            ->leftJoin('departments', 'promotions.department_id', '=', 'departments.id')
            ->leftJoin('jobs', 'promotions.job_id', '=', 'jobs.id')
            // ->latest()
            ->where('employee_id', '=', $id) 
            ->get();
        
        //Menampilkan data mutations paling lama berdasarkan id employee
        $mutation_get = DB::table('mutations')
            ->where('employee_id', '=', $id)
            ->leftJoin('departments', 'mutations.department_id', '=', 'departments.id')
            ->leftJoin('jobs', 'mutations.job_id', '=', 'jobs.id')
            ->orderBy('mutations.id')
            ->limit(1)
            // ->where('votes', '=', 100)
            // ->where('age', '>', 35)
            ->get(); 
            // ->oldest() 
            // ->first();

        return view('datamaster.promotions.show', [
            'employee' => $employee,
            'jobs' => Job::all(),
            'mutation_get' => $mutation_get,
            'departments' => Department::all(),
            'promotions' => $promotions,
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
        
        $promotions = DB::table('promotions')
            ->leftJoin('departments', 'promotions.department_id', '=', 'departments.id')
            ->leftJoin('jobs', 'promotions.job_id', '=', 'jobs.id')
            // ->latest()
            ->where('employee_id', '=', $id) 
            ->get();
        
        //Menampilkan data mutations paling lama berdasarkan id employee
        $mutation_get = DB::table('mutations')
            ->where('employee_id', '=', $id)
            ->leftJoin('departments', 'mutations.department_id', '=', 'departments.id')
            ->leftJoin('jobs', 'mutations.job_id', '=', 'jobs.id')
            ->orderBy('mutations.id')
            ->limit(1)
            // ->where('votes', '=', 100)
            // ->where('age', '>', 35)
            ->get(); 
            // ->oldest() 
            // ->first();

        return view('datamaster.promotions.create', [
            'employee' => $employee,
            'jobs' => Job::all(),
            'mutation_get' => $mutation_get,
            'departments' => Department::all(),
            'promotions' => $promotions,
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
