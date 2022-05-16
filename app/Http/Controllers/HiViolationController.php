<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ViolationsImport;

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
    $violations = DB::table('violations')
                ->leftJoin('employees', 'employees.id', '=', 'violations.employee_id')
                ->select('violations.*', 'violations.id as id',
                 'violations.date_of_violation as date_of_violation',
                 'violations.no_violation as no_violation',
                 'violations.violation_ROM as violation_ROM',
                 'violations.date_end_violation as date_end_violation',
                 'violations.type_of_violation as type_of_violation',
                 'violations.alphabet_id as alphabet_id',
                 'violations.other_information as other_information',
                 'violations.violation_status as violation_status',
                 'employees.name as name',
                 'employees.number_of_employees as number_of_employees'
                 )->orderByDesc('violations.id');

        if(request('search')){
            $violations->where('date_end_violation', 'like', '%' . request('search') . '%')
                      ->orWhere('date_of_violation', 'like', '%' . request('search') . '%')
                      ->orWhere('name', 'like', '%' . request('search') . '%')
                      ->orWhere('number_of_employees', 'like', '%' . request('search') . '%')
                      ->orWhere('other_information', 'like', '%' . request('search') . '%');
        }
        return view('hi.violations.list', [
            'violations' => $violations->paginate(10),
            'count' => DB::table('violations')->count()
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
    // public function destroy(Violation $violation)
    public function destroy(Request $requset) 
    {
            // Violation::destroy($violation->id);
        $select_vio = DB::table('violations')->find($requset->id);

        $select_employee = DB::table('employees')->find($select_vio->employee_id);
        $remark = "menghapus pelanggaran ".$select_employee->number_of_employees;
        $action = "delete";

        DB::table('histories')->insert([
            'user_id' => auth()->user()->id,
            'role_id' => auth()->user()->role_id,
            'remark' => $remark,
            'action' => $action,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('violations')->where('id', $requset->id)->delete();
        return redirect('hiviolations');
    }
    
    public function hapus(Request $requset) 
    {
        $select_vio = DB::table('violations')->find($requset->id);

        $select_employee = DB::table('employees')->find($select_vio->employee_id);
        $remark = "menghapus pelanggaran ".$select_employee->number_of_employees;
        $action = "delete";

        DB::table('histories')->insert([
            'user_id' => auth()->user()->id,
            'role_id' => auth()->user()->role_id,
            'remark' => $remark,
            'action' => $action,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('violations')->where('id', $requset->id)->delete();
        
        return redirect('hiviolations');
    }

    public function import() 
    {
        $rows =  Excel::toArray(new ViolationsImport, request()->file('file'));

        foreach($rows as $row):
            $jumlahTotal = 0;
            foreach($row as $x):
                //Memastikan tidak ada nilai null NIK
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
                    $date_of_violation = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['date_of_violation']);
                    $reporting_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['reporting_date']);
                    
                    $datev = new $date_of_violation;
                    $dater = new $reporting_date;
                    $resultv = $datev->format('Y-m-d');
                    $resultr = $dater->format('Y-m-d');
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
                        $no_sp = floor($x['no']);
                    }elseif($num_sp > 0){
                        $last_sp = DB::table('violations')
                            ->latest()
                            ->first();
                        $no_sp = $last_sp->no_violation + floor($x['no']);
                    }

                   
                    $date_violation = new \DateTime($resultr.'00:00:00' );

                    $date_year = date_format($date_violation, "Y"); //for Display Year
                    $date_month =  date_format($date_violation, "m"); //for Display Month
                    $date_day = date_format($date_violation, "d"); //for Display Date
            
                    
            
                        // $tahun = YEAR($date_of_violation);
            
                        // Prints October 3, 1975 was on a Thursday
                        //   echo "Oct 3, 1975 was on a ".gmdate("l", mktime(0,0,0,$date_day,$date_month,$date_year)) . "<br>";
            
                        // $day = gmdate($resultv, time()+60*60*7);
                        $day = date("l", gmmktime(0,0,0, $date_month,$date_day, $date_year));
            
                      if($day == 'Monday'){
                        $day_num = '1';
                        $day_indo = 'Senin';
                      }elseif($day == 'Tuesday'){
                        $day_num = '2';
                        $day_indo = 'Selasa';            
                      }elseif($day == 'Wednesday'){
                        $day_num = '3';
                        $day_indo = 'Rabu';            
                      }elseif($day == 'Thursday'){
                        $day_num = '4';
                        $day_indo = 'Kamis';            
                      }elseif($day == 'Friday'){
                        $day_num = '5';
                        $day_indo = 'Jumat';            
                      }elseif($day == 'Saturday'){
                        $day_num = '6';
                        $day_indo = 'Sabtu';            
                      }elseif($day == 'Sunday'){
                        $day_num = '7';
                        $day_indo = 'Minggu';            
                      }
                    
                       $month_n = date("n", gmmktime(0,0,0, $date_month, $date_day, $date_year));
                     
                       if($month_n == 1){
                        $ROM = 'I';
                      }elseif($month_n == 2){
                        $ROM = 'II';
                      }elseif($month_n == 3){
                        $ROM = 'III';
                      }elseif($month_n == 4){
                        $ROM = 'IV';
                      }elseif($month_n == 5){
                        $ROM = 'V';
                      }elseif($month_n == 6){
                        $ROM = 'VI';
                      }elseif($month_n == 7){
                        $ROM = 'VII';
                      }elseif($month_n == 8){
                        $ROM = 'VIII';
                      }elseif($month_n == 9){
                        $ROM = 'IX';
                      }elseif($month_n == 10){
                        $ROM = 'X';
                      }elseif($month_n == 11){
                        $ROM = 'XI';
                      }elseif($month_n == 12){
                        $ROM = 'XII';
                      }
            
                    //   $tgl1 = $date_of_violation;// pendefinisian tanggal awal
            
                      //Pembuatan 6 bulan berakhir
                    //   $date_end_violation = date('Y-m-d', strtotime('+180 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
                      
                    //   echo $hari_apa = date('Y-m-d');
            
                    
                    $d_l = date("d", gmmktime(0,0,0, $date_month, $date_day, $date_year));
                    $n_l = date("n", gmmktime(0,0,0, $date_month, $date_day, $date_year));
                    $y_l = date("Y", gmmktime(0,0,0, $date_month, $date_day, $date_year));
             
                      $data_hari = $d_l;
                      $data_bulan = $n_l;
                      $data_tahun = $y_l;
            
                      //data manipulasi
                      $jumlah_bulan = $data_bulan + 6;
                      if($jumlah_bulan > 12){
                        $cari_bulan = $jumlah_bulan - 12;
                        $m_bulan = $cari_bulan;
                        $m_tahun = $data_tahun + 1;
                        $m_day = cal_days_in_month(CAL_GREGORIAN, $m_bulan, $m_tahun);
                      }else{
                        $m_bulan = $jumlah_bulan;
                        $m_tahun = $data_tahun;
                        $m_day = cal_days_in_month(CAL_GREGORIAN, $m_bulan, $m_tahun); 
                      }
            
                      // manipulasi hari
                      if($data_hari == 1 AND $m_bulan == 1){
                        $bulan_fix = 12;
                        $tahun_fix =  $m_tahun - 1;
                        $hari_fix = cal_days_in_month(CAL_GREGORIAN, $bulan_fix, $tahun_fix);
                      }elseif($data_hari == 1){
                        $bulan_fix = $m_bulan - 1;
                        $tahun_fix = $m_tahun;
                        $hari_fix = cal_days_in_month(CAL_GREGORIAN, $bulan_fix, $tahun_fix);
                      }elseif($data_hari <= $m_day){
                        $bulan_fix = $m_bulan;
                        $tahun_fix = $m_tahun;
                        $hari_fix = $data_hari - 1;
                      }elseif($data_hari > $m_day){
                        $bulan_fix = $m_bulan;
                        $tahun_fix = $m_tahun;
                        $hari_fix = cal_days_in_month(CAL_GREGORIAN, $bulan_fix, $tahun_fix);
                      }
            
                        if(strlen($hari_fix) == '1'){
                          $hari_s = '0'. $hari_fix;
                        }elseif(strlen($hari_fix) == '2'){
                          $hari_s = $hari_fix;
                        }
            
                        if(strlen($bulan_fix) == '1'){
                          $bulan_s = '0'. $bulan_fix;
                        }elseif(strlen($bulan_fix) == '2'){
                          $bulan_s = $bulan_fix;
                        }
            
                        $te = $bulan_s. "/".$hari_s."/".$tahun_fix;
                        $test = new \DateTime($te);

                        $date_end_violation = date_format($test, 'Y-m-d'); 

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
                    

                    // Violation::create([
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

                    $jumlahTotal += 1;
                }
            }
            endforeach;

            $remark = "upload pelanggaran SP jumlah ".$jumlahTotal;
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

        return redirect('/hiviolations');

    }
}
