<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\ToArray;
use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;

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



    public function import() 
    {        // Excel::import(new EmployeesImport, request()->file('file'));

        $rows =  Excel::toArray(new PromotionsImport, request()->file('file'));
        // dd($rows);
        foreach($rows as $row):
            foreach($row as $x):
                if($x['number_of_employees'] == NULL){

                }else{
                    // CEK number_of_employees	name	job_level	code_job_level	department	cell	bagian

                    // CEK Department
                    $num_dept = DB::table('departments')->where('department', '=', $x['department'])->count();
                    if($num_dept > 0){
                        $department_get = DB::table('departments')->where('department', '=', $x['department'])->first();
                        $department_id = $department_get->id;
                    }else{
                        $department_id = 12;
                    }

                    // CEK job_level
                    $num_dept = DB::table('jobs')->where('job_level', '=', $x['job_level'])->count();
                    if($num_dept > 0){
                        $job_get = DB::table('jobs')->where('job_level', '=', $x['job_level'])->first();
                        $job_id = $job_get->id;
                    }else{
                        $job_id = 12;
                    }

                    DB::table('promotions')->insert([
                        'promotion_date'=> date('Y-m-d'),
                        'bagian'=> $x['bagian'],
                        'cell'=> $x['cell'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'job_id'=> $job_id,
                        'department_id'=> $department_id,
                        'employee_id'=> $employee_get->id
                        ]);
                                    
                }
            endforeach;
        endforeach;
        return redirect('/datamaster/promotions');
    }
}
