<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\EmployeesExport;
use App\Exports\PromotionsExport;

use App\Imports\EmployeesImport;
use App\Imports\PromotionsImport;

use App\Models\Employee;
use App\Models\Promotion;

class ExcelPromotionController extends Controller
{
        /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
        $promotions = Promotion::get();
  
        return view('promotions', compact('promotions'));
    }
        
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new PromotionsExport, 'promotions.xlsx');
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        // Excel::import(new EmployeesImport, request()->file('file'));

        $rows =  Excel::toArray(new PromotionsImport, request()->file('file'));
        
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
                         
                        DB::table('promotions')
                            ->insert([
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
        return redirect('/promotions')->with('success', 'Data Promosi Karaywan Berhasil di tambahkan!');
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
                
                $promotion_date_con = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['promotion_date']);
                
                DB::table('promotion')
                    ->where('id', $employee_get->id)
                    ->where('promotion_date', '=',  $promotion_date_con)
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

        return redirect('/promotions')->with('success', 'Data Promosi Karaywan Berhasil di update!');
            
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
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Promotion $promotion)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
