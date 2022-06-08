<?php

namespace App\Imports;

// use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\DB;

use App\Models\Employee;
use App\Models\Salary;
use App\Models\Startwork;

use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Hash;

/*
class EmployeesImport implements ToModel, WithHeadingRow
{
    
    public function model(array $row)
    {
        ini_set('max_execution_time', 7200);
        // return new User([
        //     'name' => $row[0],
        // ]);

           if($row['number_of_employees'] == NULL){

            }else{ 

                //CEK number_of_employee sudah ada pada database belum       
                // $search_employee = DB::table('employees')->where('number_of_employees', '=', floor($row['number_of_employees']))->count();
                $search_employee = DB::table('employees')->where('number_of_employees', '=', floor($row['number_of_employees']))->count();
                
                if($search_employee > 0){
                    $p_employee = DB::table('employees')->where('number_of_employees', '=', floor($row['number_of_employees']))->first();

                    // name
                    if($row['name'] == null){
                        $name = $p_employee->name;
                    }else{
                        $name = $row['name'];
                    }

                    // gender
                    if($row['gender'] == null){
                        $gender = $p_employee->gender;
                    }else{
                        $gender = $row['gender'];
                    }


                    // place_of_birth
                    if($row['place_of_birth'] == null){
                        $place_of_birth = $p_employee->place_of_birth;
                    }else{
                        $place_of_birth = $row['place_of_birth'];
                    }

                    // place_of_birth
                    if($row['place_of_birth'] == null){
                        $place_of_birth = $p_employee->place_of_birth;
                    }else{
                        $place_of_birth = $row['place_of_birth'];
                    }



                    $date_of_birth_i = $row['date_of_birth'];
                    if($date_of_birth_i == null){
                        $date_of_birth = $p_employee->date_of_birth;
                    }else{
                        $date_of_birth = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']);
                    }
                    if($date_of_birth == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal Lahir salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    // marital_status
                    if($row['marital_status'] == null){
                        $marital_status = $p_employee->marital_status;
                    }else{
                        $marital_status = $row['marital_status'];
                    }

                    // biological_mothers_name
                    if($row['biological_mothers_name'] == null){
                        $biological_mothers_name = $p_employee->biological_mothers_name;
                    }else{
                        $biological_mothers_name = $row['biological_mothers_name'];
                    }

                    // national_id
                    if($row['national_id'] == null){
                        $national_id = $p_employee->national_id;
                    }else{
                        $national_id = $row['national_id'];
                    }

                    // address_jalan
                    if($row['address_jalan'] == null){
                        $address_jalan = $p_employee->address_jalan;
                    }else{
                        $address_jalan = $row['address_jalan'];
                    }

                    // address_rt
                    if($row['address_rt'] == null){
                        $address_rt = $p_employee->address_rt;
                    }else{
                        $address_rt = $row['address_rt'];
                    }

                    // address_rw
                    if($row['address_rw'] == null){
                        $address_rw = $p_employee->address_rw;
                    }else{
                        $address_rw = $row['address_rw'];
                    }

                    // address_village
                    if($row['address_village'] == null){
                        $address_village = $p_employee->address_village;
                    }else{
                        $address_village = $row['address_village'];
                    }

                    // address_district
                    if($row['address_district'] == null){
                        $address_district = $p_employee->address_district;
                    }else{
                        $address_district = $row['address_district'];
                    }

                    // address_city
                    if($row['address_city'] == null){
                        $address_city = $p_employee->address_city;
                    }else{
                        $address_city = $row['address_city'];
                    }

                    // address_province
                    if($row['address_province'] == null){
                        $address_province = $p_employee->address_province;
                    }else{
                        $address_province = $row['address_province'];
                    }

                    // phone
                    if($row['phone'] == null){
                        $phone = $p_employee->phone;
                    }else{
                        $phone = $row['phone'];
                    }

                    // email
                    if($row['email'] == null){
                        $email = $p_employee->email;
                    }else{
                        $email = $row['email'];
                    }

                    // npwp
                    if($row['npwp'] == null){
                        $npwp = $p_employee->npwp;
                    }else{
                        $npwp = $row['npwp'];
                    }

                    // bank_name
                    if($row['bank_name'] == null){
                        $bank_name = $p_employee->bank_name;
                    }else{
                        $bank_name = $row['bank_name'];
                    }

                    // bank_branch
                    if($row['bank_branch'] == null){
                        $bank_branch = $p_employee->bank_branch;
                    }else{
                        $bank_branch = $row['bank_branch'];
                    }

                    // bank_account_name
                    if($row['bank_account_name'] == null){
                        $bank_account_name = $p_employee->bank_account_name;
                    }else{
                        $bank_account_name = $row['bank_account_name'];
                    }

                    // bank_account_number
                    if($row['bank_account_number'] == null){
                        $bank_account_number = $p_employee->bank_account_number;
                    }else{
                        $bank_account_number = $row['bank_account_number'];
                    }

                    // bpjs_ketenagakerjaan
                    if($row['bpjs_ketenagakerjaan'] == null){
                        $bpjs_ketenagakerjaan = $p_employee->bpjs_ketenagakerjaan;
                    }else{
                        $bpjs_ketenagakerjaan = $row['bpjs_ketenagakerjaan'];
                    }

                    // bpjs_kesehatan
                    if($row['bpjs_kesehatan'] == null){
                        $bpjs_kesehatan = $p_employee->bpjs_kesehatan;
                    }else{
                        $bpjs_kesehatan = $row['bpjs_kesehatan'];
                    }


                    $hire_date_i = $row['hire_date'];
                    if($hire_date_i == null){
                         $hire_date = $p_employee->hire_date;
                    }else{
                        $hire_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hire_date']);
                    }
                    if($hire_date == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal Masuk salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    // employee_type
                    if($row['employee_type'] == null){
                        $employee_type = $p_employee->employee_type;
                    }else{
                        $employee_type = $row['employee_type'];
                    }

                    $end_of_contract_i = $row['end_of_contract'];
                    if($end_of_contract_i == null){
                        $end_of_contract = $p_employee->end_of_contract;
                    }else{
                        $end_of_contract = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['end_of_contract']);
                    }
                    if($end_of_contract == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal Selesai Kontrak salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    $date_out_i = $row['date_out'];
                    if($date_out_i == null){
                        $date_out = $p_employee->date_out;
                    }else{
                        $date_out = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_out']);
                    }
                    if($date_out == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal date_out salah. Pastikan kolom date dengan performatan date yang benar !');
                    }
                    
                    // exit_statement
                    if($row['exit_statement'] == null){
                        $exit_statement = $p_employee->exit_statement;
                    }else{
                        $exit_statement = $row['exit_statement'];
                    }


                    // job_level
                    if($row['job_level'] == null){
                        $job_level = $p_employee->job_level;
                    }else{
                        $num_dept = DB::table('jobs')->where('job_level', '=', $row['job_level'])->count();
                        if($num_dept > 0){
                            $job_get = DB::table('jobs')->where('job_level', '=', $row['job_level'])->first();
                            $job_id = $job_get->id;
                        }else{
                            $job_none = DB::table('jobs')->where('job_level', '=', 'NONE')->first();                            
                            $job_id = $job_none->id;
                        }
                    }

                    // department
                    if($row['department'] == null){
                        $department = $p_employee->department;
                    }else{
                        $num_dept = DB::table('departments')->where('department', '=', $row['department'])->count();
                        if($num_dept > 0){
                            $department_get = DB::table('departments')->where('department', '=', $row['department'])->first();
                            $department_id = $department_get->id;
                        }else{
                            $department_none = DB::table('departments')->where('department', '=', 'NONE')->first();                            
                            $department_id = $department_none->id;
                        }
                    }
                        
                    // cell
                    if($row['cell'] == null){
                        $cell = $p_employee->cell;
                    }else{
                        $cell = $row['cell'];
                    }
                        
                    // bagian
                    if($row['bagian'] == null){
                        $bagian = $p_employee->bagian;
                    }else{
                        $bagian = $row['bagian'];
                    }
                        
                    // kode_ptkp
                    if($row['kode_ptkp'] == null){
                        $kode_ptkp = $p_employee->kode_ptkp;
                    }else{
                        $kode_ptkp = $row['kode_ptkp'];
                    }
                        
                    // year_ptkp
                    if($row['year_ptkp'] == null){
                        $year_ptkp = $p_employee->year_ptkp;
                    }else{
                        $year_ptkp = $row['year_ptkp'];
                    }
                        
                    // educate
                    if($row['educate'] == null){
                        $educate = $p_employee->educate;
                    }else{
                        $educate = $row['educate'];
                    }
                        
                    // major
                    if($row['major'] == null){
                        $major = $p_employee->major;
                    }else{
                        $major = $row['major'];
                    }

                    DB::table('employees')
                    ->where('number_of_employees', floor($row['number_of_employees']))
                    ->update([                        
                        'name'=> $name,
                        'gender'=> $gender,  
                        'place_of_birth'=> $place_of_birth,
                        'date_of_birth'=> $date_of_birth,
                        'marital_status'=> $marital_status,
                        'religion'=> $religion, 
                        'biological_mothers_name' => $biological_mothers_name,
                        'national_id'=> $national_id,
                        'address_jalan'=> $address_jalan,
                        'address_rt'=> $address_rt,
                        'address_rw'=> $address_rw,
                        'address_village'=> $address_village,
                        'address_district'=> $address_district,
                        'address_city'=> $address_city,
                        'address_province'=> $address_province,
                        'phone'=> $phone,
                        'email'=> $email,
                        'npwp'=> $npwp,
                        'bank_name'=> $bank_name,
                        'bank_branch'=> $bank_branch,
                        'bank_account_name'=> $bank_account_name,
                        'bank_account_number'=> $bank_account_number,
                        'bpjs_ketenagakerjaan'=> $bpjs_ketenagakerjaan,
                        'bpjs_kesehatan' => $bpjs_kesehatan,
                        'hire_date'=> $hire_date,
                        'employee_type'=> $employee_type,
                        'end_of_contract'=> $end_of_contract,
                        'date_out'=> $date_out,
                        'exit_statement'=> $exit_statement,
                        'cell'=> $cell, 
                        'bagian'=> $bagian,
                        'kode_ptkp'=> $kode_ptkp,
                        'year_ptkp'=> $year_ptkp,
                        'educate'=> $educate,
                        'major'=> $major,
                        'finger_id' => $number_of_employees,
                        'status_employee' => $status_employee,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'job_id'=> $job_id,
                        'department_id'=> $department_id
                        ]);

                }else{

                
                    // CEK tanggal [date_of_birth, hire_date, end_of_contract, date_out, year_ptkp ]
                    
                    // CEK date_of_birth '12/04/2022
                    // $date_of_birth_t = strtotime($row['date_of_birth']);             
                    // $date_of_birth = date('Y-m-d', $date_of_birth_t);
                    // $date = intval($row['date_of_birth']);

                    // $date = $row['date_of_birth'];
                    // dd($date_of_birth_i = $row['date_of_birth']);
                    $date_of_birth_i = $row['date_of_birth'];
                    if($date_of_birth_i == null){
                        // $date = 'true';
                        // $date_of_birth = '0000-00-00';
                        $date_of_birth = NULL;
                    }else{
                        $date_of_birth = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']);
                    }

                    if($date_of_birth == 'false'){
                        // dd($date_of_birth);
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal Lahir salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    // $date_check = "2012-09-17 00:00:08";
                    // $date_of_birth = $date_of_birth->format('Y-m-d');
                    // $date_check = $date_of_birth;


                    $hire_date_i = $row['hire_date'];
                    if($hire_date_i == null){
                        // $date = 'true';
                         $hire_date = NULL;
                    }else{
                        $hire_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hire_date']);
                    }

                    if($hire_date == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal Masuk salah. Pastikan kolom date dengan performatan date yang benar !');
                    }
                    // dd($row['hire_date']);
                    // $hire_date = $hire_date->format('Y-m-d');
                    // dd($hire_date);

                   // if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date_check))

                    // Date "2012-09-17 00:00:08"
                    // if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $date_check))
                    // {
                    //     // return true;
                    //     $tanggal = 'true';
                    // }else{
                    //     $tanggal = 'false';
                    //     // return false;
                    // }
                    // dd($tanggal);

                    $end_of_contract_i = $row['end_of_contract'];
                    if($end_of_contract_i == null){
                        // $date = 'true';
                        // $end_of_contract = '0000-00-00';
                        $end_of_contract = NULL;
                    }else{
                        $end_of_contract = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['end_of_contract']);
                    }

                    if($end_of_contract == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal Selesai Kontrak salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    $date_out_i = $row['date_out'];
                    if($date_out_i == null){
                        // $date = 'true';
                        // $date_out = '0000-00-00';
                        // $time_date_out = strtotime('00/00/0000');
                        // $date_out = date('Y-m-d',$time_date_out);
                        $date_out = NULL;

                    }else{
                        $date_out = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_out']);
                    }

                    if($date_out == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal date_out salah. Pastikan kolom date dengan performatan date yang benar !');
                    }
                    
                    // dd($date_out);
                    $status_employee_i = $row['exit_statement'];
                    if($status_employee_i == null OR $row['date_out'] == null){
                        // $date = 'true';
                        $status_employee = 'active';
                    }elseif($status_employee_i == '-'){
                        $status_employee = 'active';
                    }else{
                        $status_employee = 'notactive';
                    }

                    // $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']);
                    // dd($date_of_birth);

                    // CEK hire_date
                    // $hire_date_t = strtotime($row['hire_date']);             
                    // $hire_date = date('Y-m-d', $hire_date_t);

                    // CEK end_of_contract 
                    // $end_of_contract_t = strtotime($row['end_of_contract']);             
                    // $end_of_contract = date('Y-m-d', $end_of_contract_t);

                    // CEK date_out          
                    // $date_out_t = strtotime($row['date_out']);             
                    // $date_out = date('Y-m-d', $date_out_t);

                    // CEK year_ptkp
                    // $year_ptkp_t = strtotime($row['year_ptkp']);             
                    // $year_ptkp = date('Y-m-d', $year_ptkp_t);
                    

                    
                    // // CEK Department
                    // $num_dept = DB::table('departments')->where('department', '=', $row['department'])->count();
                    // if($num_dept > 0){
                    //     $department_get = DB::table('departments')->where('department', '=', $row['department'])->first();
                    //     $department_id = $department_get->id;
                    // }else{
                    //     $department_none = DB::table('departments')->where('department', '=', 'NONE')->first();                            
                    //     $department_id = $department_none->id;
                    // }

                    // // CEK job_level
                    // $num_dept = DB::table('jobs')->where('job_level', '=', $row['job_level'])->count();
                    // if($num_dept > 0){
                    //     $job_get = DB::table('jobs')->where('job_level', '=', $row['job_level'])->first();
                    //     $job_id = $job_get->id;
                    // }else{
                    //     $job_none = DB::table('jobs')->where('job_level', '=', 'NONE')->first();                            
                    //     $job_id = $job_none->id;
                    // }
                    

                    // job_level
                    if($row['job_level'] == null){
                        $job_level = $p_employee->job_level;
                    }else{
                        $num_dept = DB::table('jobs')->where('job_level', '=', $row['job_level'])->count();
                        if($num_dept > 0){
                            $job_get = DB::table('jobs')->where('job_level', '=', $row['job_level'])->first();
                            $job_id = $job_get->id;
                        }else{
                            $job_none = DB::table('jobs')->where('job_level', '=', 'NONE')->first();                            
                            $job_id = $job_none->id;
                        }
                    }

                    // department
                    if($row['department'] == null){
                        $department = $p_employee->department;
                    }else{
                        $num_dept = DB::table('departments')->where('department', '=', $row['department'])->count();
                        if($num_dept > 0){
                            $department_get = DB::table('departments')->where('department', '=', $row['department'])->first();
                            $department_id = $department_get->id;
                        }else{
                            $department_none = DB::table('departments')->where('department', '=', 'NONE')->first();                            
                            $department_id = $department_none->id;
                        }
                    }
            
                    
                    // return new Employee([
                    DB::table('employees')->insert([
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
                        'status_employee' => $status_employee,
                        'date_bpjs_ketenagakerjaan'=> date('Y-m-d'),
                        'date_bpjs_kesehatan'=> date('Y-m-d'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'job_id'=> $job_id,
                        'department_id'=> $department_id
                        ]);

                    // TAMPILKAN DATA KARYAWAN YANG SUDAH DI INSERT
                    $employee_get = DB::table('employees')->where('number_of_employees', '=', floor($row['number_of_employees']))->first();
                        
                    // return new Salary([
                        
                    DB::table('salaries')->insert([
                        'employee_id' => $employee_get->id,
                        'basic_salary' => 0,
                        'positional_allowance' => 0,
                        'transportation_allowance' => 0,
                        'attendance_allowance' => 0,
                        'grade_salary' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'total_salary' => 0
                    ]);

                    
                    // return new Startwork([
                    DB::table('startworks')->insert([
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

    }

         



}

*/


class EmployeesImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts
{




    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            // Siswa::create([
            //     'nama' => $row['nama'],
            //     'no_hp' => $row['no_hp'],
            //     'email' => $row['email'],
            //     'alamat' => $row['alamat'],
            // ]);

            if($row['number_of_employees'] == NULL){

            }else{ 

                //CEK number_of_employee sudah ada pada database belum       
                // $search_employee = DB::table('employees')->where('number_of_employees', '=', floor($row['number_of_employees']))->count();
                $search_employee = DB::table('employees')->where('number_of_employees', '=', floor($row['number_of_employees']))->count();
                
                if($search_employee > 0){
                    $p_employee = DB::table('employees')->where('number_of_employees', '=', floor($row['number_of_employees']))->first();

                    // name
                    if($row['name'] == null){
                        $name = $p_employee->name;
                    }else{
                        $name = $row['name'];
                    }

                    // gender
                    if($row['gender'] == null){
                        $gender = $p_employee->gender;
                    }else{
                        $gender = $row['gender'];
                    }


                    // place_of_birth
                    if($row['place_of_birth'] == null){
                        $place_of_birth = $p_employee->place_of_birth;
                    }else{
                        $place_of_birth = $row['place_of_birth'];
                    }

                    // place_of_birth
                    if($row['place_of_birth'] == null){
                        $place_of_birth = $p_employee->place_of_birth;
                    }else{
                        $place_of_birth = $row['place_of_birth'];
                    }



                    $date_of_birth_i = $row['date_of_birth'];
                    if($date_of_birth_i == null){
                        $date_of_birth = $p_employee->date_of_birth;
                    }else{
                        $date_of_birth = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']);
                    }
                    if($date_of_birth == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal Lahir salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    // marital_status
                    if($row['marital_status'] == null){
                        $marital_status = $p_employee->marital_status;
                    }else{
                        $marital_status = $row['marital_status'];
                    }

                    // biological_mothers_name
                    if($row['biological_mothers_name'] == null){
                        $biological_mothers_name = $p_employee->biological_mothers_name;
                    }else{
                        $biological_mothers_name = $row['biological_mothers_name'];
                    }

                    // national_id
                    if($row['national_id'] == null){
                        $national_id = $p_employee->national_id;
                    }else{
                        $national_id = $row['national_id'];
                    }

                    // address_jalan
                    if($row['address_jalan'] == null){
                        $address_jalan = $p_employee->address_jalan;
                    }else{
                        $address_jalan = $row['address_jalan'];
                    }

                    // address_rt
                    if($row['address_rt'] == null){
                        $address_rt = $p_employee->address_rt;
                    }else{
                        $address_rt = $row['address_rt'];
                    }

                    // address_rw
                    if($row['address_rw'] == null){
                        $address_rw = $p_employee->address_rw;
                    }else{
                        $address_rw = $row['address_rw'];
                    }

                    // address_village
                    if($row['address_village'] == null){
                        $address_village = $p_employee->address_village;
                    }else{
                        $address_village = $row['address_village'];
                    }

                    // address_district
                    if($row['address_district'] == null){
                        $address_district = $p_employee->address_district;
                    }else{
                        $address_district = $row['address_district'];
                    }

                    // address_city
                    if($row['address_city'] == null){
                        $address_city = $p_employee->address_city;
                    }else{
                        $address_city = $row['address_city'];
                    }

                    // address_province
                    if($row['address_province'] == null){
                        $address_province = $p_employee->address_province;
                    }else{
                        $address_province = $row['address_province'];
                    }

                    // phone
                    if($row['phone'] == null){
                        $phone = $p_employee->phone;
                    }else{
                        $phone = $row['phone'];
                    }

                    // email
                    if($row['email'] == null){
                        $email = $p_employee->email;
                    }else{
                        $email = $row['email'];
                    }

                    // npwp
                    if($row['npwp'] == null){
                        $npwp = $p_employee->npwp;
                    }else{
                        $npwp = $row['npwp'];
                    }

                    // bank_name
                    if($row['bank_name'] == null){
                        $bank_name = $p_employee->bank_name;
                    }else{
                        $bank_name = $row['bank_name'];
                    }

                    // bank_branch
                    if($row['bank_branch'] == null){
                        $bank_branch = $p_employee->bank_branch;
                    }else{
                        $bank_branch = $row['bank_branch'];
                    }

                    // bank_account_name
                    if($row['bank_account_name'] == null){
                        $bank_account_name = $p_employee->bank_account_name;
                    }else{
                        $bank_account_name = $row['bank_account_name'];
                    }

                    // bank_account_number
                    if($row['bank_account_number'] == null){
                        $bank_account_number = $p_employee->bank_account_number;
                    }else{
                        $bank_account_number = $row['bank_account_number'];
                    }

                    // bpjs_ketenagakerjaan
                    if($row['bpjs_ketenagakerjaan'] == null){
                        $bpjs_ketenagakerjaan = $p_employee->bpjs_ketenagakerjaan;
                    }else{
                        $bpjs_ketenagakerjaan = $row['bpjs_ketenagakerjaan'];
                    }

                    // bpjs_kesehatan
                    if($row['bpjs_kesehatan'] == null){
                        $bpjs_kesehatan = $p_employee->bpjs_kesehatan;
                    }else{
                        $bpjs_kesehatan = $row['bpjs_kesehatan'];
                    }


                    $hire_date_i = $row['hire_date'];
                    if($hire_date_i == null){
                         $hire_date = $p_employee->hire_date;
                    }else{
                        $hire_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hire_date']);
                    }
                    if($hire_date == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal Masuk salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    // employee_type
                    if($row['employee_type'] == null){
                        $employee_type = $p_employee->employee_type;
                    }else{
                        $employee_type = $row['employee_type'];
                    }

                    $end_of_contract_i = $row['end_of_contract'];
                    if($end_of_contract_i == null){
                        $end_of_contract = $p_employee->end_of_contract;
                    }else{
                        $end_of_contract = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['end_of_contract']);
                    }
                    if($end_of_contract == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal Selesai Kontrak salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    $date_out_i = $row['date_out'];
                    if($date_out_i == null){
                        $date_out = $p_employee->date_out;
                    }else{
                        $date_out = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_out']);
                    }
                    if($date_out == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal date_out salah. Pastikan kolom date dengan performatan date yang benar !');
                    }
                    
                    // exit_statement
                    if($row['exit_statement'] == null){
                        $exit_statement = $p_employee->exit_statement;
                    }else{
                        $exit_statement = $row['exit_statement'];
                    }


                    // job_level
                    if($row['job_level'] == null){
                        $job_level = $p_employee->job_level;
                    }else{
                        $num_dept = DB::table('jobs')->where('job_level', '=', $row['job_level'])->count();
                        if($num_dept > 0){
                            $job_get = DB::table('jobs')->where('job_level', '=', $row['job_level'])->first();
                            $job_id = $job_get->id;
                        }else{
                            $job_none = DB::table('jobs')->where('job_level', '=', 'NONE')->first();                            
                            $job_id = $job_none->id;
                        }
                    }

                    // department
                    if($row['department'] == null){
                        $department = $p_employee->department;
                    }else{
                        $num_dept = DB::table('departments')->where('department', '=', $row['department'])->count();
                        if($num_dept > 0){
                            $department_get = DB::table('departments')->where('department', '=', $row['department'])->first();
                            $department_id = $department_get->id;
                        }else{
                            $department_none = DB::table('departments')->where('department', '=', 'NONE')->first();                            
                            $department_id = $department_none->id;
                        }
                    }
                        
                    // cell
                    if($row['cell'] == null){
                        $cell = $p_employee->cell;
                    }else{
                        $cell = $row['cell'];
                    }
                        
                    // bagian
                    if($row['bagian'] == null){
                        $bagian = $p_employee->bagian;
                    }else{
                        $bagian = $row['bagian'];
                    }
                        
                    // kode_ptkp
                    if($row['kode_ptkp'] == null){
                        $kode_ptkp = $p_employee->kode_ptkp;
                    }else{
                        $kode_ptkp = $row['kode_ptkp'];
                    }
                        
                    // year_ptkp
                    if($row['year_ptkp'] == null){
                        $year_ptkp = $p_employee->year_ptkp;
                    }else{
                        $year_ptkp = $row['year_ptkp'];
                    }
                        
                    // educate
                    if($row['educate'] == null){
                        $educate = $p_employee->educate;
                    }else{
                        $educate = $row['educate'];
                    }
                        
                    // major
                    if($row['major'] == null){
                        $major = $p_employee->major;
                    }else{
                        $major = $row['major'];
                    }

                    DB::table('employees')
                    ->where('number_of_employees', floor($row['number_of_employees']))
                    ->update([                        
                        'name'=> $name,
                        'gender'=> $gender,  
                        'place_of_birth'=> $place_of_birth,
                        'date_of_birth'=> $date_of_birth,
                        'marital_status'=> $marital_status,
                        'religion'=> $religion, 
                        'biological_mothers_name' => $biological_mothers_name,
                        'national_id'=> $national_id,
                        'address_jalan'=> $address_jalan,
                        'address_rt'=> $address_rt,
                        'address_rw'=> $address_rw,
                        'address_village'=> $address_village,
                        'address_district'=> $address_district,
                        'address_city'=> $address_city,
                        'address_province'=> $address_province,
                        'phone'=> $phone,
                        'email'=> $email,
                        'npwp'=> $npwp,
                        'bank_name'=> $bank_name,
                        'bank_branch'=> $bank_branch,
                        'bank_account_name'=> $bank_account_name,
                        'bank_account_number'=> $bank_account_number,
                        'bpjs_ketenagakerjaan'=> $bpjs_ketenagakerjaan,
                        'bpjs_kesehatan' => $bpjs_kesehatan,
                        'hire_date'=> $hire_date,
                        'employee_type'=> $employee_type,
                        'end_of_contract'=> $end_of_contract,
                        'date_out'=> $date_out,
                        'exit_statement'=> $exit_statement,
                        'cell'=> $cell, 
                        'bagian'=> $bagian,
                        'kode_ptkp'=> $kode_ptkp,
                        'year_ptkp'=> $year_ptkp,
                        'educate'=> $educate,
                        'major'=> $major,
                        'finger_id' => $number_of_employees,
                        'status_employee' => $status_employee,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'job_id'=> $job_id,
                        'department_id'=> $department_id
                        ]);

                }else{

                
                    // CEK tanggal [date_of_birth, hire_date, end_of_contract, date_out, year_ptkp ]
                    
                    // CEK date_of_birth '12/04/2022
                    // $date_of_birth_t = strtotime($row['date_of_birth']);             
                    // $date_of_birth = date('Y-m-d', $date_of_birth_t);
                    // $date = intval($row['date_of_birth']);

                    // $date = $row['date_of_birth'];
                    // dd($date_of_birth_i = $row['date_of_birth']);
                    $date_of_birth_i = $row['date_of_birth'];
                    if($date_of_birth_i == null){
                        // $date = 'true';
                        // $date_of_birth = '0000-00-00';
                        $date_of_birth = NULL;
                    }else{
                        $date_of_birth = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']);
                    }

                    if($date_of_birth == 'false'){
                        // dd($date_of_birth);
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal Lahir salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    // $date_check = "2012-09-17 00:00:08";
                    // $date_of_birth = $date_of_birth->format('Y-m-d');
                    // $date_check = $date_of_birth;


                    $hire_date_i = $row['hire_date'];
                    if($hire_date_i == null){
                        // $date = 'true';
                         $hire_date = NULL;
                    }else{
                        $hire_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hire_date']);
                    }

                    if($hire_date == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal Masuk salah. Pastikan kolom date dengan performatan date yang benar !');
                    }
                    // dd($row['hire_date']);
                    // $hire_date = $hire_date->format('Y-m-d');
                    // dd($hire_date);

                   // if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date_check))

                    // Date "2012-09-17 00:00:08"
                    // if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $date_check))
                    // {
                    //     // return true;
                    //     $tanggal = 'true';
                    // }else{
                    //     $tanggal = 'false';
                    //     // return false;
                    // }
                    // dd($tanggal);

                    $end_of_contract_i = $row['end_of_contract'];
                    if($end_of_contract_i == null){
                        // $date = 'true';
                        // $end_of_contract = '0000-00-00';
                        $end_of_contract = NULL;
                    }else{
                        $end_of_contract = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['end_of_contract']);
                    }

                    if($end_of_contract == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal Selesai Kontrak salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    $date_out_i = $row['date_out'];
                    if($date_out_i == null){
                        // $date = 'true';
                        // $date_out = '0000-00-00';
                        // $time_date_out = strtotime('00/00/0000');
                        // $date_out = date('Y-m-d',$time_date_out);
                        $date_out = NULL;

                    }else{
                        $date_out = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_out']);
                    }

                    if($date_out == 'false'){
                        return redirect('/employees')->with('danger', 'Data Karyawan Mulai dari baris '. floor($row['number_of_employees']) . ' Format Tanggal date_out salah. Pastikan kolom date dengan performatan date yang benar !');
                    }
                    
                    // dd($date_out);
                    $status_employee_i = $row['exit_statement'];
                    if($status_employee_i == null OR $row['date_out'] == null){
                        // $date = 'true';
                        $status_employee = 'active';
                    }elseif($status_employee_i == '-'){
                        $status_employee = 'active';
                    }else{
                        $status_employee = 'notactive';
                    }

                    // $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']);
                    // dd($date_of_birth);

                    // CEK hire_date
                    // $hire_date_t = strtotime($row['hire_date']);             
                    // $hire_date = date('Y-m-d', $hire_date_t);

                    // CEK end_of_contract 
                    // $end_of_contract_t = strtotime($row['end_of_contract']);             
                    // $end_of_contract = date('Y-m-d', $end_of_contract_t);

                    // CEK date_out          
                    // $date_out_t = strtotime($row['date_out']);             
                    // $date_out = date('Y-m-d', $date_out_t);

                    // CEK year_ptkp
                    // $year_ptkp_t = strtotime($row['year_ptkp']);             
                    // $year_ptkp = date('Y-m-d', $year_ptkp_t);
                    

                    // 
                    // // CEK Department
                    // $num_dept = DB::table('departments')->where('department', '=', $row['department'])->count();
                    // if($num_dept > 0){
                    //     $department_get = DB::table('departments')->where('department', '=', $row['department'])->first();
                    //     $department_id = $department_get->id;
                    // }else{
                    //     $department_none = DB::table('departments')->where('department', '=', 'NONE')->first();                            
                    //     $department_id = $department_none->id;
                    // }

                    // // CEK job_level
                    // $num_dept = DB::table('jobs')->where('job_level', '=', $row['job_level'])->count();
                    // if($num_dept > 0){
                    //     $job_get = DB::table('jobs')->where('job_level', '=', $row['job_level'])->first();
                    //     $job_id = $job_get->id;
                    // }else{
                    //     $job_none = DB::table('jobs')->where('job_level', '=', 'NONE')->first();                            
                    //     $job_id = $job_none->id;
                    // }
                    // 

                    // job_level
                    if($row['job_level'] == null){
                        $job_level = $p_employee->job_level;
                    }else{
                        $num_dept = DB::table('jobs')->where('job_level', '=', $row['job_level'])->count();
                        if($num_dept > 0){
                            $job_get = DB::table('jobs')->where('job_level', '=', $row['job_level'])->first();
                            $job_id = $job_get->id;
                        }else{
                            $job_none = DB::table('jobs')->where('job_level', '=', 'NONE')->first();                            
                            $job_id = $job_none->id;
                        }
                    }

                    // department
                    if($row['department'] == null){
                        $department = $p_employee->department;
                    }else{
                        $num_dept = DB::table('departments')->where('department', '=', $row['department'])->count();
                        if($num_dept > 0){
                            $department_get = DB::table('departments')->where('department', '=', $row['department'])->first();
                            $department_id = $department_get->id;
                        }else{
                            $department_none = DB::table('departments')->where('department', '=', 'NONE')->first();                            
                            $department_id = $department_none->id;
                        }
                    }
            
                    
                    // return new Employee([
                    DB::table('employees')->insert([
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
                        'status_employee' => $status_employee,
                        'date_bpjs_ketenagakerjaan'=> date('Y-m-d'),
                        'date_bpjs_kesehatan'=> date('Y-m-d'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'job_id'=> $job_id,
                        'department_id'=> $department_id
                        ]);

                    // TAMPILKAN DATA KARYAWAN YANG SUDAH DI INSERT
                    $employee_get = DB::table('employees')->where('number_of_employees', '=', floor($row['number_of_employees']))->first();
                        
                    // return new Salary([
                        
                    DB::table('salaries')->insert([
                        'employee_id' => $employee_get->id,
                        'basic_salary' => 0,
                        'positional_allowance' => 0,
                        'transportation_allowance' => 0,
                        'attendance_allowance' => 0,
                        'grade_salary' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'total_salary' => 0
                    ]);

                    
                    // return new Startwork([
                    DB::table('startworks')->insert([
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
        }

    }



    public function batchSize(): int
    {
        return 50;
    }
    
    public function chunkSize(): int
    {
        return 50;
    }

}










/*

class EmployeesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        ini_set('max_execution_time', 7200);

        */
    /*
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
  
    */

/*
    }
}
*/
