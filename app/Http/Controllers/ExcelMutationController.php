<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\EmployeesExport;
use App\Exports\MutationsExport;

use App\Imports\EmployeesImport;
use App\Imports\MutationsImport;

use App\Models\Employee;
use App\Models\Mutation;

class ExcelMutationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mutations = mutation::get();
  
        return view('mutations', compact('mutations'));
    }

    public function export() 
    {
        return Excel::download(new MutationsExport, 'Mutations.xlsx');
    }

    public function import() 
    {
        // Excel::import(new EmployeesImport, request()->file('file'));

        $rows =  Excel::toArray(new MutationsImport, request()->file('file'));
        
        // dd($rows);
        foreach($rows as $row):
            $jumlahTotal = 0;
            foreach($row as $x):
                if($x['number_of_employees'] == NULL){

                }else{ 

                //CEK number_of_employee sudah ada pada database belum       

                        // // CEK Department
                        // $num_dept = DB::table('departments')->where('department', '=', $x['department'])->count();
                        // if($num_dept > 0){
                        //     $department_get = DB::table('departments')->where('department', '=', $x['department'])->first();
                        //     $department_id = $department_get->id;
                        // }else{
                        //     $department_id = 12;
                        // }

                        // // CEK job_level
                        // $num_dept = DB::table('jobs')->where('job_level', '=', $x['job_level'])->count();
                        // if($num_dept > 0){
                        //     $job_get = DB::table('jobs')->where('job_level', '=', $x['job_level'])->first();
                        //     $job_id = $job_get->id;
                        // }else{
                        //     $job_id = 12;
                        // }
                    $search_employee = DB::table('employees')->where('number_of_employees', '=', floor($x['number_of_employees']))->count();
                    
                    if($search_employee > 0){

                        // TAMPILKAN DATA KARYAWAN YANG SUDAH DI CARI
                        $employee_get = DB::table('employees')
                                    ->where('number_of_employees', '=',  floor($x['number_of_employees']))
                                    ->first();

                        $mutation_date_i = $row['mutation_date'];
                        if($mutation_date_i == null){
                            $mutation_date = $p_employee->date_of_birth;
                            return redirect('/mutations')->with('danger', 'Data Karyawan Mulai dari baris '. floor($x['number_of_employees']) . ' Format Tanggal Mutasi salah. Pastikan kolom date dengan performatan date yang benar !');                            
                        }else{
                            $mutation_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['date_of_birth']);
                        }
                        if($mutation_date == 'false'){
                            return redirect('/mutations')->with('danger', 'Data Karyawan Mulai dari baris '. floor($x['number_of_employees']) . ' Format Tanggal Mutasi salah. Pastikan kolom date dengan performatan date yang benar !');
                        }

                        if($x['job_level'] == null){
                            $job_id = $employee_get->job_id;
                        }else{
                            $num_dept = DB::table('jobs')->where('job_level', '=', $x['job_level'])->count();
                            if($num_dept > 0){
                                $job_get = DB::table('jobs')->where('job_level', '=', $x['job_level'])->first();
                                $job_id = $job_get->id;
                            }else{
                                $job_id = $employee_get->job_id;
                            }
                        }

                        // department
                        if($x['department'] == null){
                            $department_id = $employee_get->department_id;
                            return redirect('/mutations')->with('danger', 'Data Karyawan Mulai dari baris '. floor($x['number_of_employees']) . ' Format Mutasi Department Tidak Boleh Kosong. Pastikan kolom date dengan performatan date yang benar !');                            
                        }else{
                            $num_dept = DB::table('departments')->where('department', '=', $x['department'])->count();
                            if($num_dept > 0){
                                $department_get = DB::table('departments')->where('department', '=', $x['department'])->first();
                                $department_id = $department_get->id;
                            }else{
                                $department_id = $employee_get->department_id;
                                return redirect('/mutations')->with('danger', 'Data Karyawan Mulai dari baris '. floor($x['number_of_employees']) . ' Format Mutasi isi Department salah. Pastikan kolom department dengan performatan department yang benar !');                                                            
                            }
                        }


                        DB::table('employees')
                            ->where('id', $employee_get->id)
                            ->update([
                                'updated_at' => date('Y-m-d H:i:s'),
                                'job_id'=> $job_id,
                                'department_id'=> $department_id
                            ]);
                         
                        DB::table('mutations')
                            ->insert([
                                'mutation_date'=> $mutation_date,
                                'bagian'=> $x['bagian'],
                                'cell'=> $x['cell'],
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                                'job_id'=> $job_id,
                                'department_id'=> $department_id,
                                'employee_id'=> $employee_get->id
                            ]);

                        $jumlahTotal += 1;
                    }    
                }
            endforeach;

            $remark = "upload Mutasi jumlah ".$jumlahTotal;
            $action = "upload";
    
            DB::table('histories')->insert([
                'user_id' => auth()->user()->id,
                'role_id' => auth()->user()->role_id,
                'remark' => $remark,
                'action' => $action,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        endforeach;
        return redirect('/mutations')->with('success', 'Data Promosi Karaywan Berhasil di tambahkan!');
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

                $employee_get = DB::table('employees')
                        ->where('number_of_employees', '=',  floor($x['number_of_employees']))
                        ->first();
                
                $mutation_date_con = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['mutation_date']);
                
                DB::table('mutation')
                    ->where('id', $employee_get->id)
                    ->where('mutation_date', '=',  $mutation_date_con)
                    ->update([
                        'bagian'=> $x['bagian'],
                        'cell'=> $x['cell'],
                        'updated_at' => date('Y-m-d H:i:s'),
                        'job_id'=> $job_id,
                        'department_id'=> $department_id,
                        'employee_id'=> $employee_get->id
                    ]);
                }

            endforeach;
            
           
        endforeach;

        return redirect('/mutations')->with('success', 'Data Mutasi Karaywan Berhasil di update!');
            
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function show(Mutation $mutation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function edit(Mutation $mutation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Mutation $mutation)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mutation $mutation)
    {
        //
    }
}
