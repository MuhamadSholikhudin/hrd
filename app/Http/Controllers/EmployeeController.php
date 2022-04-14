<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;

use App\Models\Employee;
  

class EmployeeController extends Controller
{
        /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
        $employees = Employee::get();
  
        return view('employees', compact('employees'));
    }
        
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        // Excel::import(new EmployeesImport, request()->file('file'));
        // $path = $request->file('file_name')->getRealPath();
        // $data = Excel::load($path, function($reader) {})->get();
            ini_set('max_execution_time', 7200);
        $data = Excel::import(new EmployeesImport, request()->file('file'));

        // $employees = (new EmployeesImport)->toArray('MASTER_DATA.xlsx');
        return back();

        // return redirect('/datamaster/employees');
    }

    public function update() {

        $rows =  Excel::toArray(new EmployeesImport, request()->file('file'));

        foreach($rows as $row): 
            foreach($row as $x): 
                if(floor($x['number_of_employees']) == NULL){

                }else{

           
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

                // if($department_get == )
                // $job_get = DB::table('jobs')->where('jobs', '=', $x['job'])->first();
                $employee_get = DB::table('employees')->where('number_of_employees', '=',  floor($x['number_of_employees']))->first();
                
                
                DB::table('employees')
                ->where('id', $employee_get->id)
                ->update([
                    'name'=> $x['name'],
                    'gender'=> $x['gender'],  
                    'place_of_birth'=> $x['place_of_birth'],
                    'date_of_birth'=> \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['date_of_birth']),
                    'marital_status'=> $x['marital_status'],
                    'religion'=> $x['religion'], 
                    'biological_mothers_name' => $x['biological_mothers_name'],
                    'national_id'=> $x['national_id'],
                    'address_jalan'=> $x['address_jalan'],
                    'address_rt'=> $x['address_rt'],
                    'address_rw'=> $x['address_rw'],
                    'address_village'=> $x['address_village'],
                    'address_district'=> $x['address_district'],
                    'address_city'=> $x['address_city'],
                    'address_province'=> $x['address_province'],
                    'phone'=> $x['phone'],
                    'email'=> $x['email'],
                    'npwp'=> $x['npwp'],
                    'bank_name'=> $x['bank_name'],
                    'bank_branch'=> $x['bank_branch'],
                    'bank_account_name'=> $x['bank_account_name'],
                    'bank_account_number'=> $x['bank_account_number'],
                    'bpjs_ketenagakerjaan'=> $x['bpjs_ketenagakerjaan'],
                    'bpjs_kesehatan' => $x['bpjs_kesehatan'],
                    'hire_date'=> \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['hire_date']),
                    'employee_type'=> $x['employee_type'],
                    'end_of_contract'=> \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['end_of_contract']),
                    'date_out'=> \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['date_out']),
                    'exit_statement'=> $x['exit_statement'],
                    'cell'=> $x['cell'], 
                    'bagian'=> $x['bagian'],
                    'kode_ptkp'=> $x['kode_ptkp'],
                    'year_ptkp'=> \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['year_ptkp']),
                    'educate'=> $x['educate'],
                    'major'=> $x['major'],
                    'finger_id' => $x['number_of_employees'],
                    'date_bpjs_ketenagakerjaan'=> date('Y-m-d'),
                    'date_bpjs_kesehatan'=> date('Y-m-d'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'job_id'=> $job_id,
                    'department_id'=> $department_id
                    ]);
                }
            endforeach;
        endforeach;

        return redirect('/datamaster/promotions');
            
    }


        

}
