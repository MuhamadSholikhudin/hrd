<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use App\Models\Salary;


class DatamasterEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {

    //     if(auth()->user()->name !== 'sandhikagalih'){
    //         abort(403);
    //     }
    // }

    public function index()
    {
        $employees = Employee::oldest();

        // $employees = DB::table('employees')->orderBy('number_of_employees', 'asc');
            // ->leftJoin('jobs', 'employees.job_id', '=', 'jobs.id')
            // ->Join('departments', 'employees.department_id', '=', 'departments.id');
            // ->get();


        if(request('search')){
            $employees->where('number_of_employees', 'like', '%' . request('search') . '%')
                      ->orWhere('name', 'like', '%' . request('search') . '%')
                      ->orWhere('status_employee', 'like', '%' . request('search') . '%')
                      ->orWhere('national_id', 'like', '%' . request('search') . '%')
                      ;
        }

        
        return view('datamaster.employees.index', [
            
            // "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(3)->withQuerystring()
            // "employees" => $employees->filter(request(['search']))->paginate(10)->withQuerystring(),
            'employees' => $employees->orderBy('number_of_employees', 'asc')->paginate(10)->withQuerystring(),
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

        // if(auth()->guest()){
        //     abort(403);
        // }

        // if(auth()->user()->name !== 'sandhikagalih'){
        //     abort(403);
        // }

        $agamas = ["MOSLEM", "BUDHIST", "CATHOLIC", "CHRISTIAN", "HINDU", "KEPERCAYAAN", "NONE"];
        $marital_status = ["M", "S"];
        $gender = ["M", "F"];
        $educations = ["SD","SMP", "SMA", "S1","S2"];
        $employee_type = ["Permanent","Probation", "Contract"];
        $kode_ptkp = ["TK","K/0", "K/1", "K/2"];
        $grade_salary = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
        //
        return view('datamaster.employees.create', [
            'jobs' => Job::all(),
            'departments' => Department::all(),
            'employees' => Employee::all(),
            'agamas' => $agamas,
            'gender' => $gender,
            'marital_status' => $marital_status,
            'educations' => $educations,
            'employee_type' => $employee_type,
            'kode_ptkp' => $kode_ptkp,
            'grade_salary' => $grade_salary
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
        // dd($request);
        $validatedDataEmployee = $request->validate([
            'number_of_employees' => 'required',
            'finger_id' => 'required',
            'name'=> 'required',
            'gender'=> 'required',  
            'place_of_birth'=> 'required',
            'date_of_birth'=> 'required',
            'marital_status'=> 'required',
            'religion'=> 'required', 
            'biological_mothers_name' => 'required',
            'national_id'=> 'required',
            'address_jalan'=> 'required',
            'address_rt'=> 'required',
            'address_rw'=> 'required',
            'address_village'=> 'required',
            'address_district'=> 'required',
            'address_city'=> 'required',
            'address_province'=> 'required',
            'phone'=> 'required',
            'email'=> 'required',
            'educate'=> 'required',
            'major'=> 'required',
            'hire_date'=> 'required',
            'employee_type'=> 'required',
            'end_of_contract'=> 'required',
            'date_out'=> 'required',
            'exit_statement'=> 'required',
            'bank_name'=> 'required',
            'bank_branch'=> 'required',
            'bank_account_name'=> 'required',
            'bank_account_number'=> 'required',
            'bpjs_ketenagakerjaan'=> 'required',
            'date_bpjs_ketenagakerjaan'=> 'required',
            'bpjs_kesehatan' => 'required',
            'date_bpjs_kesehatan'=> 'required',
            'npwp'=> 'required',
            'kode_ptkp'=> 'required',
            'year_ptkp'=> 'required',
            'bagian'=> 'required',
            'cell'=> 'required', 
            'job_id'=> 'required',
            'department_id'=> 'required'
        ]);
        // dd($validatedDataEmployee);
        
        Employee::create($validatedDataEmployee);
        
        $employee_get = DB::table('employees')->where('number_of_employees', '=', $request->number_of_employees)->first();
        
        $request->employee_id = $employee_get->id;

        DB::table('startworks')->insert([
            'startwork_date'=> date('Y-m-d'),
            'bagian'=> $request->bagian,
            'cell'=> $request->cell,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'job_id'=> $request->job_id,
            'department_id'=> $request->department_id,
            'employee_id'=> $employee_get->id
            ]);

        DB::table('salaries')->insert([
            'employee_id' => $employee_get->id,
            'basic_salary' => $request->basic_salary,
            'positional_allowance' => $request->positional_allowance,
            'transportation_allowance' => $request->transportation_allowance,
            'attendance_allowance' => $request->attendance_allowance,
            'grade_salary' => $request->grade_salary,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'total_salary' => 0
        ]);
        
        // Salary::create($validatedDataSalary);
            
        return redirect('/employees')->with('success', 'Data Karaywan Berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
        $job = DB::table('jobs')
        ->where('id', '=', $employee->job_id)
        ->get();

        $salary = DB::table('salaries')->where('employee_id', $employee->id)->first();
        return view('datamaster.employees.show', [
            
            
            'employee' => $employee,
            'salary' => $salary
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {

        $agamas = ["MOSLEM", "BUDHIST", "CATHOLIC", "CHRISTIAN", "HINDU", "KEPERCAYAAN", "NONE"];
        $marital_status = ["M", "S"];
        $gender = ["M", "F"];
        $educations = ["SD","SMP", "SMA", "S1","S2"];
        $employee_type = ["Permanent","Probation", "Contract"];
        $kode_ptkp = ["TK","K/0", "K/1", "K/2"];
        $grade_salary = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
        $status_employee = ['active', 'not active'];
        //
        // $job = DB::table('jobs')
        // ->where('id', '=', $employee->job_id)
        // ->get();

        $salary = DB::table('salaries')->where('employee_id', $employee->id)->first();
        return view('datamaster.employees.edit', [
            
            
            'employee' => $employee,
            'salary' => $salary,
            'jobs' => Job::all(),
            'departments' => Department::all(),
            'gender' => $gender,
            'agamas' => $agamas,
            'marital_status' => $marital_status,
            'educations' => $educations,
            'employee_type' => $employee_type,
            'kode_ptkp' => $kode_ptkp,
            'grade_salary' => $grade_salary,
            'status_employee' => $status_employee
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

        DB::table('employees')
        ->where('id' , $request->id)
        ->update([
            'number_of_employees' => $request->number_of_employees,
            'finger_id' => $request->finger_id,
            'name'=> $request->name,
            'gender'=> $request->gender,  
            'place_of_birth'=> $request->place_of_birth,
            'date_of_birth'=> $request->date_of_birth,
            'marital_status'=> $request->marital_status,
            'religion'=> $request->religion, 
            'biological_mothers_name'=> $request->biological_mothers_name,
            'national_id'=> $request->national_id,
            'address_jalan'=> $request->address_jalan,
            'address_rt'=> $request->address_rt,
            'address_rw'=> $request->address_rw,
            'address_village'=> $request->address_village,
            'address_district'=> $request->address_district,
            'address_city'=> $request->address_city,
            'address_province'=> $request->address_province,
            'phone'=> $request->phone,
            'email'=> $request->email,
            'educate'=> $request->educate,
            'major'=> $request->major,
            'hire_date'=> $request->hire_date,
            'employee_type'=> $request->employee_type,
            'end_of_contract'=> $request->end_of_contract,
            'date_out'=> $request->date_out,
            'exit_statement'=> $request->exit_statement,
            'bank_name'=> $request->bank_name,
            'bank_branch'=> $request->bank_branch,
            'bank_account_name'=> $request->bank_account_name,
            'bank_account_number'=> $request->bank_account_number,
            'bpjs_ketenagakerjaan'=> $request->bpjs_ketenagakerjaan,
            'date_bpjs_ketenagakerjaan'=> $request->date_bpjs_ketenagakerjaan,
            'bpjs_kesehatan'=> $request->bpjs_kesehatan,
            'date_bpjs_kesehatan'=> $request->date_bpjs_kesehatan,
            'npwp'=> $request->npwp,
            'kode_ptkp'=> $request->kode_ptkp,
            'year_ptkp'=> $request->year_ptkp,
            'status_employee'=> $request->status_employee,
            'bagian'=> $request->bagian,
            'cell'=> $request->cell, 
            'job_id'=> $request->job_id,
            'department_id'=> $request->department_id
            ]);

         DB::table('salaries')
              ->where('employee_id' , $request->id)
              ->where('id' , $request->salary_id)
              ->update([
                        'basic_salary' => $request->basic_salary,
                        'positional_allowance' => $request->positional_allowance,
                        'transportation_allowance' => $request->transportation_allowance,
                        'attendance_allowance' => $request->attendance_allowance,
                        'grade_salary' => $request->grade_salary,
                        'total_salary' => 0
                ]);
        return redirect('/employees')->with('success', 'Data Karaywan Berhasil di update!');
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
