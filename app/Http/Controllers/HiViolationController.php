<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use App\Models\Alphabet;
use App\Models\Article;
use App\Models\Paragraph;
use App\Models\Violation;

class HiViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('hi.violations.list', [
            'violations' => Violation::all()->paginate(10),
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

    public function import() 
    {
        $rows =  Excel::toArray(new ViolationsImport, request()->file('file'));

        foreach($rows as $row):
            foreach($row as $x):
                //Memastikan tidak ada nilai null NIK
                if($x['number_of_employees'] == NULL){

                }else{ 
                    //Mencari Karywan
                    $search_employee = DB::table('employees')->where('number_of_employees', '=', floor($x['number_of_employees']))->count();
                    if($search_employee < 1){

                    }else{


                        $employee_id = $search_employee->employee_id;

                        $job = DB::table('jobs')->find($search_employee->job_id);
                        $department = DB::table('departments')->find($search_employee->department_id);

                        $job_level = $job->job_level;
                        $department = $department->department;

                        $signature = DB::table('signatures')->where('status_signature', 'active')->first();
                        
                        $signature_id = $signature->id;
                
                        $other_information = $request->other_information;
                        $date_of_violation = $request->date_of_violation;
                        $reporting_date = $request->reporting_date;
                
                        $alphabet_id = $request->alphabet_id;


                        $sel_num_vio = DB::table('violations')->where('employee_id', $employee->id)->count();
                        if($sel_num_vio == 0){
                          $sta_viol = 'notactive';
                          $type_viol = 'notviolation';
                          $last_accumulation = 0;
                          
                        }else{
                          $sel_vio = DB::table('violations')->where('employee_id', $employee->id)->latest()->first();
                          $date_now = date_create();
                          $date_sta = date_create($sel_vio->date_end_violation);
                          $diffx  = date_diff($date_sta, $date_now);
              
                          if($diffx->d <= 0){
                            $sta_viol = 'notactive';
                            $type_viol = 'notviolation';
                            $last_accumulation = 0;
                          }else{
                            $sta_viol = $sel_vio->violation_status;
                            $type_viol = $sel_vio->type_of_violation;
                            $last_accumulation = $sel_vio->accumulation;
                          }
                        }


                        $last_vio = $sta_viol;
                        $status_violant_last = $sta_viol;
                        $last_type = $type_viol;
                        $accumulation = $last_accumulation;



                        

                        $data = [
                            'date_of_violation' => $date_of_violation,     
                            'date_end_violation' => $date_end_violation,     
                            'no_violation' => $no_sp,   
                            'format' => 'SP-HRD',    
                            'month_of_violation' => $month_n,     
                            'violation_ROM' => $ROM,   
                            'reporting_day' => null,     
                            'reporting_date' => $reporting_date,   
                            'job_level' => $job_level,   
                            'department' => $department,   
                            'other_information' => $other_information,   
                                    
                            'violation_status' => 'active',     
                            'type_of_violation' => $status_type_violation,   
                        
                            'accumulation' => $accumulation,    
                            'alphabet_accumulation' => $alphabet_accumulation,    
                            'violation_accumulation' => $violation_accumulation,    
                            'violation_accumulation2' => $violation_accumulation2,     
                            'violation_accumulation3' => $violation_accumulation3,   
            
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            
                            'alphabet_id' => $alphabet_id,           
                            'signature_id' => $signature_id,    
                            'employee_id' => $employee_id
                        ];
                        // dd($data);
                    DB::table('violations')->insert($data);
                    }


                }
            endforeach;
        endforeach;
        return redirect('/hi/violations');

    }
}
