<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function index()
    {
        $employees = Employee::latest();

        if(request('search')){
            $employees->where('number_of_employees', 'like', '%' . request('search') . '%')
                      ->orWhere('name', 'like', '%' . request('search') . '%')
                      ->orWhere('national_id', 'like', '%' . request('search') . '%');
        }

        return view('datamaster.employees.index', [
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
        return view('datamaster.employees.create', [
            'jobs' => Job::all(),
            'departments' => Department::all()
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
        $validatedDataEmployee = $request->validate([
            'number_of_employees' => 'required',
            'finger_id' => 'required',
            'name'=> 'required',
            'gender'=> 'required',  
            'place_of_birth'=> 'required',
            'date_of_birth'=> 'required',
            // 'marital_status'=> 'required',
            'religion'=> 'required', 
            'biological_mothers_name'=> 'required',
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
            'bpjs_kesehatan'=> 'required',
            'date_bpjs_kesehatan',
            'npwp'=> 'required',
            'kode_ptkp'=> 'required',
            'year_ptkp'=> 'required',
            'bagian'=> 'required',
            'cell'=> 'required', 
            'job_id'=> 'required',
           'department_id'=> 'required'
        ]);
        Employee::create($validatedDataEmployee);
        
        // $employee_get = DB::table('employees')
        // ->where('number_of_employees', '=', $request->number_of_employees)
        // ->get();
        
        // $validatedDataSalary = $request->validate([
        //     'employee_id' => $employee_get->id,
        //     'basic_salary' => 'required',
        //     'positional_allowance' => 'required',
        //     'transportation_allowance' => 'required',
        //     'attendance_allowance' => 'required',
        //     'grade_salary' => 'required',
        //     'grade_total' => 'required'
        // ]);
        // Salary::create($validatedDataSalary);
            
        return redirect('/jobs')->with('success', 'New Post has been added!');
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
}
