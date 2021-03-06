<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Maatwebsite\Excel\Concerns\ToArray;
use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Employee;
  
class EmployeeExcelController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
        $users = User::get();
  
        return view('users', compact('users'));
    }
        
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        // Excel::import(UsersImport, request()->file('file'));
        $rows =  Excel::toArray(new EmployeesImport, request()->file('file'));
        
        // dd($rows);
        foreach($rows as $row):
            foreach($row as $x):
                DB::table('employees')->insert([
                    'number_of_employees' => $x['number_of_employees'],
                    'name'=> $x['name'],
                    'gender'=> $x['gender'],  
                    'place_of_birth'=> $x['place_of_birth'],
                    // 'date_of_birth'=> $x['date_of_birth'],
                    // 'marital_status'=> $x['marital_status'],
                    // 'religion'=> $x['religion'], 
                    // 'biological_mothers_name' => $x['biological_mothers_name'],
                    // 'national_id'=> $x['national_id'],
                    // 'address_jalan'=> $x['address_jalan'],
                    // 'address_rt'=> $x['address_rt'],
                    // 'address_rw'=> $x['address_rw'],
                    // 'address_village'=> $x['address_village'],
                    // 'address_district'=> $x['address_district'],
                    // 'address_city'=> $x['address_city'],
                    // 'address_province'=> $x['address_province'],
                    // 'phone'=> $x['phone'],
                    // 'email'=> $x['email'],
                    // 'npwp'=> $x['npwp'],
                    // 'bank_name'=> $x['bank_name'],
                    // 'bank_branch'=> $x['bank_branch'],
                    // 'bank_account_name'=> $x['bank_account_name'],
                    // 'bank_account_number'=> $x['bank_account_number'],
                    // 'bpjs_ketenagakerjaan'=> $x['bpjs_ketenagakerjaan'],
                    // 'bpjs_kesehatan' => $x['bpjs_kesehatan'],
                    // 'hire_date'=> $x['hire_date'],
                    // 'employee_type'=> $x['employee_type'],
                    // 'end_of_contract'=> $x['end_of_contract'],
                    // 'date_out'=> $x['date_out'],
                    // 'exit_statement'=> $x['exit_statement'],
                    // 'job_id'=> $x['job_id'],
                    // 'department_id'=> $x['department_id'],
                    // 'cell'=> $x['cell'], 
                    // 'bagian'=> $x['bagian'],
                    // 'kode_ptkp'=> $x['kode_ptkp'],
                    // 'year_ptkp'=> $x['year_ptkp'],
                    // 'educate'=> $x['educate'],
                    // 'major'=> $x['major'],
                    
                    // 'finger_id' => $x['number_of_employees'],
                    'date_bpjs_ketenagakerjaan'=> date('Y-m-d'),
                    'date_bpjs_kesehatan'=> date('Y-m-d'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                    ]);
                    
                    
                    // $employee_get = DB::table('users')->where('name', '=', $x['name'])->first();
                    
                    // DB::table('salaries')->insert([
                    //     'employee_id' => $employee_get->id,
                    //     'basic_salary' => $x['basic_salary'],
                    //     'positional_allowance' => $x['positional_allowance'],
                    //     'transportation_allowance' => $x['transportation_allowance'],
                    //     'attendance_allowance' => $x['attendance_allowance'],
                    //     'grade_salary' => $x['grade_salary'],
                    //     'created_at' => date('Y-m-d H:i:s'),
                    //     'updated_at' => date('Y-m-d H:i:s'),
                    //     'total_salary' => 0
                // ]);

            endforeach;
        endforeach;


   
        return back();
        redirect('/datamaster/employees');
    }
}
