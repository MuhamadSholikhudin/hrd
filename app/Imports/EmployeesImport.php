<?php

namespace App\Imports;

// use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\DB;

use App\Models\Employee;
use App\Models\Salary;
use App\Models\Startwork;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Hash;

// class EmployeesImport implements ToModel, WithHeadingRow
class EmployeesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    public function collection(Collection $rows)
    {
        ini_set('max_execution_time', 7200);
        foreach ($rows as $row) 
        {

            if($row['number_of_employees'] == NULL){

            }else{ 

            //CEK number_of_employee sudah ada pada database belum       
                $search_employee = DB::table('employees')->where('number_of_employees', '=', floor($row['number_of_employees']))->count();
                
                if($search_employee > 0){

                }else{

                    // CEK Department
                    $c_date_of_birth = $row['date_of_birth'];
                    if($c_date_of_birth == null){
                        $date_of_birth = NULL;
                    }else{
                        $date_of_birth = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']);
                    }

                    $c_hire_date = $row['hire_date'];
                    if($c_hire_date == null){
                        $hire_date = NULL;
                    }else{
                        $hire_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hire_date']);
                    }

                    $c_end_of_contract = $row['end_of_contract'];
                    if($c_end_of_contract == null){
                        $end_of_contract = NULL;
                    }else{
                        $end_of_contract = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['end_of_contract']);
                    }

                    $c_date_out = $row['date_out'];
                    if($c_date_out == null){
                        $date_out = NULL;
                    }else{
                        $date_out = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_out']);
                    }

                    $c_exit_statement = $row['exit_statement'];
                    if($c_exit_statement == null){
                        $status_employee = 'active';
                    }elseif($c_exit_statement == '-'){
                        $status_employee = 'active';
                    }elseif($c_exit_statement != null){
                        $status_employee = 'notactive';
                    }

                    // $c_kode_ptkp = $row['kode_ptkp'];
                    // if($c_kode_ptkp == null){
                    //     $kode_ptkp = '';
                    // }else{
                    //     $date_of_birth = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']);
                    // }
                
                    // CEK tanggal [date_of_birth, hire_date, end_of_contract, date_out, year_ptkp ]
                   
                    // CEK Department
                    $num_dept = DB::table('departments')->where('department', '=', $row['department'])->count();
                    if($num_dept > 0){
                        $department_get = DB::table('departments')->where('department', '=', $row['department'])->first();
                        $department_id = $department_get->id;
                    }else{
                        $department_id = 21;
                    }

                    // CEK job_level
                    $num_dept = DB::table('jobs')->where('job_level', '=', $row['job_level'])->count();
                    if($num_dept > 0){
                        $job_get = DB::table('jobs')->where('job_level', '=', $row['job_level'])->first();
                        $job_id = $job_get->id;
                    }else{
                        $job_id = 104;
                    }
       
                    Employee::create([
                        'number_of_employees' => floor($row['number_of_employees']),
                        'name'=> $row['name'],
                        'gender'=> $row['gender'],  
                        'place_of_birth'=> $row['place_of_birth'],
                        'date_of_birth'=> $date_of_birth,
                        'marital_status'=> $row['marital_status'],
                        'religion'=> $row['religion'], 
                        'biological_mothers_name' => $row['biological_mothers_name'],
                        'national_id'=> $row['national_id'],
                        'address_jalan'=> $row['address_jalan'],
                        'address_rt'=> $row['address_rt'],
                        'address_rw'=> $row['address_rw'],
                        'address_village'=> $row['address_village'],
                        'address_district'=> $row['address_district'],
                        'address_city'=> $row['address_city'],
                        'address_province'=> $row['address_province'],
                        'phone'=> $row['phone'],
                        'email'=> $row['email'],
                        'npwp'=> $row['npwp'],
                        'bank_name'=> $row['bank_name'],
                        'bank_branch'=> $row['bank_branch'],
                        'bank_account_name'=> $row['bank_account_name'],
                        'bank_account_number'=> $row['bank_account_number'],
                        'bpjs_ketenagakerjaan'=> $row['bpjs_ketenagakerjaan'],
                        'bpjs_kesehatan' => $row['bpjs_kesehatan'],
                        'hire_date'=> $hire_date,
                        'employee_type'=> $row['employee_type'],
                        'end_of_contract'=> $end_of_contract,
                        'date_out'=> $date_out,
                        'exit_statement'=> $row['exit_statement'],
                        'cell'=> $row['cell'], 
                        'bagian'=> $row['bagian'],
                        'kode_ptkp'=> $row['kode_ptkp'],
                        'year_ptkp'=> $row['year_ptkp'],
                        'educate'=> $row['educate'],
                        'major'=> $row['major'],
                        'finger_id' => $row['number_of_employees'],
                        'status_employee' => 'active',
                        'date_bpjs_ketenagakerjaan'=> date('Y-m-d'),
                        'date_bpjs_kesehatan'=> date('Y-m-d'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'job_id'=> $job_id,
                        'department_id'=> $department_id
                        ]);

                    // TAMPILKAN DATA KARYAWAN YANG SUDAH DI INSERT
                    $employee_get = DB::table('employees')->where('number_of_employees', '=', floor($row['number_of_employees']))->first();
                        
                    Salary::create([
                        'employee_id' => $employee_get->id,
                        'basic_salary' => $row['basic_salary'],
                        'positional_allowance' => $row['positional_allowance'],
                        'transportation_allowance' => $row['transportation_allowance'],
                        'attendance_allowance' => $row['attendance_allowance'],
                        'grade_salary' => $row['grade_salary'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'total_salary' => 0
                    ]);

                    Startwork::create([
                        'startwork_date'=> date('Y-m-d'),
                        'bagian'=> $row['bagian'],
                        'cell'=> $row['cell'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'job_id'=> $job_id,
                        'department_id'=> $department_id,
                        'employee_id'=> $employee_get->id
                    ]);
                }
            }


            // User::create([
            //     'name' => $row[0],
            // ]);
        }
  
    }
}
