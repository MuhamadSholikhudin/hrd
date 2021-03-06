<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\EmployeesExport;
use App\Exports\DemotionsExport;

use App\Imports\EmployeesImport;
use App\Imports\DemotionsImport;

use App\Models\Employee;
use App\Models\Promotion;
use App\Models\Demotion;

class ExcelDemotionController extends Controller
{
        /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
        $demotions = Demotion::get();
  
        return view('demotions', compact('demotions'));
    }
        
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new DemotionsExport, 'demotions.xlsx');
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        // Excel::import(new EmployeesImport, request()->file('file'));

        $rows =  Excel::toArray(new DemotionsImport, request()->file('file'));
        
        // dd($rows);
        foreach($rows as $row):
            foreach($row as $x):
                if($x['number_of_employees'] == NULL){

                }else{ 

                //CEK number_of_employee sudah ada pada database belum       

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

                        // TAMPILKAN DATA KARYAWAN YANG SUDAH DI CARI
                        $employee_get = DB::table('employees')
                                    ->where('number_of_employees', '=',  floor($x['number_of_employees']))
                                    ->first();

                        DB::table('employees')
                            ->where('id', $employee_get->id)
                            ->update([
                                'updated_at' => date('Y-m-d H:i:s'),
                                'job_id'=> $job_id,
                                'department_id'=> $department_id
                            ]);
                         
                        DB::table('demotions')
                            ->insert([
                                'demotion_date'=> date('Y-m-d'),
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
        return redirect('/demotions')->with('success', 'Data Promosi Karaywan Berhasil di tambahkan!');
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
                
                $demotion_date_con = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['demotion_date']);
                
                DB::table('demotions')
                    ->where('id', $employee_get->id)
                    ->where('demotion_date', '=',  $demotion_date_con)
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

        return redirect('/demotions')->with('success', 'Data Promosi Karaywan Berhasil di update!');
            
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
     * @param  \App\Models\Demotion  $demotion
     * @return \Illuminate\Http\Response
     */
    public function show(Demotion $demotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demotion  $demotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Demotion $demotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Demotion  $demotion
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Demotion $demotion)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demotion  $demotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demotion $demotion)
    {
        //
    }
}
