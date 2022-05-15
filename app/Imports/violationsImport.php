<?php

namespace App\Imports;

use App\Models\Violation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\DB;

use App\Models\Employee;
use App\Models\Salary;
use App\Models\Startwork;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Hash;

class violationsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        ini_set('max_execution_time', 7200);

        foreach($rows as $x) 
        {
            //
            if($x['number_of_employees'] == NULL){

            }else{ 
                //Mencari Karywan
                $search_employee = DB::table('employees')->where('number_of_employees', '=', floor($x['number_of_employees']))->count();
                if($search_employee < 1){

                }else{
                    $employee = DB::table('employees')->where('number_of_employees', '=', floor($x['number_of_employees']))->first();

                    $employee_id = $employee->id;

                    $job = DB::table('jobs')->find($employee->job_id);
                    $department = DB::table('departments')->find($employee->department_id);

                    $job_level = $job->job_level;
                    $department = $department->department;

                    $signature = DB::table('signatures')->where('status_signature', 'active')->first();
                    
                    $signature_id = $signature->id;
            
                    
                    $other_information = $x['other_information'];
                    // $date_of_violation = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['date_of_violation']);
                    // $reporting_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['reporting_date']);
                    $date_of_violation = date('Y-m-d');
                    $reporting_date = date('Y-m-d');
            
                    // $alphabet_id = floor($x['alphabet_id']);
                    $alphabet_id = floor($x['alphabet_id']);

                    

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
                    
                    $bul = date('m');
                    $num_sp = DB::table('violations')
                      ->whereMonth('date_of_violation', $bul)
                      ->count();
            
                    if($num_sp < 1){
                        $no_sp = floor($x['no_violation']);
                    }elseif($num_sp > 0){
                        $last_sp = DB::table('violations')
                            ->latest()
                            ->first();
                        $no_sp = $last_sp->no_violation + floor($x['no_violation']);
                    }

                    require_once 'GetViolationFormat.php';

                    $sel_alphabet = DB::table('alphabets')->find($alphabet_id);
                    $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
                    $sel_article = DB::table('articles')->find($sel_paragraph->article_id);


                    //JIKA TIDAK ADA PELANGGARAN AKTIF
                    if($last_vio == 'notactive' AND $last_type == 'notviolation')
                    {
                        $status_type_violation = $sel_paragraph->type_of_verse;

                        if($sel_paragraph->type_of_verse == "Peringatan Lisan"){
                            $accumulation = 0.5;                                                                                                                
                        }elseif($sel_paragraph->type_of_verse == "Surat Peringatan Pertama"){
                            $accumulation = 1;                                                                                                                                                
                        }elseif($sel_paragraph->type_of_verse == "Surat Peringatan Kedua"){
                            $accumulation = 2;                                                                                                                                                
                        }elseif($sel_paragraph->type_of_verse == "Surat Peringatan Ketiga"){
                            $accumulation = 3;                                                                                                                                                
                        }elseif($sel_paragraph->type_of_verse == "Surat Peringatan Terakhir"){
                            $accumulation = 4;                                                                                                                                                
                        }

                        $violation_accumulation = null;    
                        $alphabet_accumulation = null;    
                        $violation_accumulation2 = null;    
                        $violation_accumulation3 = null;  

                    }else{

                        // CARI PELANGGARAN AKUMULASI 4               
                        $num_vio_accumulation3 = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->where('violation_accumulation', '!=',  null) 
                            ->where('violation_accumulation2', '!=',  null) 
                            ->where('violation_accumulation3', '!=',  null) 
                            ->where('alphabet_accumulation', '!=',  null) 
                            ->where('violation_status', 'active') 
                            ->latest()                       
                            ->count();

                        // dd($num_vio_accumulation3);
                        if($num_vio_accumulation3 > 0){
                            // LOGIKA AKUMULSI KEEMPAT
                            // return redirect('hi/violations/' . $employee_id . '/edit');
                            require_once 'GetViolationArticle.php';

                            $pelanggran_sebelumnya2 = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('id',  $pelanggran_sebelumnya->violation_accumulation) 
                                ->latest()                       
                                ->first();

                            $pelanggran_sebelumnya3 = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                ->latest()                       
                                ->first(); 

                            $alphabet_accumulation = $cari_pasal_akumulasi->id;    
                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                            $violation_accumulation2 = $pelanggran_sebelumnya2->id;    
                            $violation_accumulation3 = $pelanggran_sebelumnya3->id;  

                        }else{

                            // CARI PELANGGARAN AKUMULASI 3               
                            $num_vio_accumulation2 = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('violation_accumulation', '!=',  null) 
                                ->where('violation_accumulation2', '!=',  null) 
                                ->where('alphabet_accumulation', '!=',  null) 
                                ->where('violation_status', 'active') 
                                ->latest()                       
                                ->count();

                            if($num_vio_accumulation2 > 0){
                                // LOGIKA AKUMULSI KETIGA
                                require_once 'GetViolationArticle.php';

                                $pelanggran_sebelumnya2 = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('id',  $pelanggran_sebelumnya->violation_accumulation) 
                                    ->latest()                       
                                    ->first();

                                // $pelanggran_sebelumnya3 = DB::table('violations')
                                //     ->where('employee_id',  $employee_id) 
                                //     ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                //     ->latest()                       
                                //     ->first();         

                                $alphabet_accumulation = $cari_pasal_akumulasi->id;    
                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                $violation_accumulation2 = $pelanggran_sebelumnya->violation_accumulation2;    
                                $violation_accumulation3 = $pelanggran_sebelumnya->violation_accumulation3;  
                            
                            }else{
                                // CARI PELANGGARAN AKUMULASI 1
                                $num_vio_accumulation = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('violation_accumulation', '!=',  null) 
                                    ->where('alphabet_accumulation', '!=',  null) 
                                    ->where('violation_status', 'active') 
                                    ->latest()                       
                                    ->count();

                                if($num_vio_accumulation > 0)
                                {
                                    //LOGIKA AKUMULASI KEDUA
                                    require_once 'GetViolationArticle.php';

                                    $pelanggran_sebelumnya2 = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id',  $pelanggran_sebelumnya->violation_accumulation) 
                                        ->latest()                       
                                        ->first();
                                                
                                    $alphabet_accumulation = $cari_pasal_akumulasi->id;    
                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                    $violation_accumulation2 = $pelanggran_sebelumnya->violation_accumulation;    
                                    $violation_accumulation3 = null;  
                                    
                                }else{
                                    //LOGIKA AKUMULSAI PERTAMA
                                    require_once 'GetViolationArticle.php';
                                        
                                    $alphabet_accumulation = $cari_pasal_akumulasi->id;    
                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                    $violation_accumulation2 = null;    
                                    $violation_accumulation3 = null;  
                                }
                            }
                        }   
                    }
                    

                    Violation::create([
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
                    ]);
                    // dd($data);
                    // DB::table('violations')->insert($data);
                }


            }

        }
    }
}
