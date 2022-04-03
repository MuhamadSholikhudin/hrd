<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;

class EmployeesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            //
            'number_of_employees' => $row['number_of_employees'],
            'name'=> $row['name'],
            'gender'=> $row['gender'],  
            'place_of_birth'=> $row['place_of_birth'],
            'date_of_birth'=> $row['date_of_birth'],
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
            'hire_date'=> $row['hire_date'],
            'employee_type'=> $row['employee_type'],
            'end_of_contract'=> $row['end_of_contract'],
            'date_out'=> $row['date_out'],
            'exit_statement'=> $row['exit_statement'],
            'job_id'=> $row['job_id'],
            'department_id'=> $row['department_id'],            
            'job_level'=> $row['job_level'],
            'department'=> $row['department'],
            'cell'=> $row['cell'], 
            'bagian'=> $row['bagian'],
            'kode_ptkp'=> $row['kode_ptkp'],
            'year_ptkp'=> $row['year_ptkp'],
            'basic_salary' => $row['basic_salary'],
            'educate'=> $row['educate'],
            'major'=> $row['major'],

            'positional_allowance' => $row['positional_allowance'],
            'transportation_allowance' => $row['transportation_allowance'],
            'attendance_allowance' => $row['attendance_allowance'],
            'grade_salary' => $row['grade_salary'],
            
            'finger_id' => $row['number_of_employees'],
            'date_bpjs_ketenagakerjaan'=> $row['date_bpjs_ketenagakerjaan'],
            'date_bpjs_kesehatan'=> $row['date_bpjs_kesehatan'],
        ]);
    }
}
