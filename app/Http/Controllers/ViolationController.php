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

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = Employee::oldest();

        // $employees = DB::table('employees')
        //     ->leftJoin('jobs', 'employees.job_id', '=', 'jobs.id')
        //     ->Join('departments', 'employees.department_id', '=', 'departments.id');
            // ->get();

        if(request('search')){
            $employees->where('number_of_employees', 'like', '%' . request('search') . '%')
                      ->orWhere('name', 'like', '%' . request('search') . '%')
                      ->orWhere('national_id', 'like', '%' . request('search') . '%');
        }
        
        return view('hi.violations.index', [
            'employees' => $employees->paginate(10),
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
        //MENANGKAP DATA REQUEST HTML
        $employee_id = $request->employee_id;
        $job_level = $request->job_level;
        $department = $request->department;
        $signature_id = $request->signature_id;

        $other_information = $request->other_information;
        $date_of_violation = $request->date_of_violation;

        $last_vio = $request->last_vio;
        $alphabet_id = $request->alphabet_id;
        $status_violant_last = $request->last_vio;
        $last_type = $request->last_type;


        //MEMBUAT INPUTAN OTOMATIS SURAT
        // NO SP 001/SP-HRD/IV/2022

        $num_sp = DB::table('violations')->count();

        if($num_sp < 1){
            $no_sp = 1;
        }elseif($num_sp > 0){
            $last_sp = DB::table('violations')
                ->latest()
                ->first();
            $no_sp = $last_sp->no_violation + 1;
        }

        $date_violation = new \DateTime($date_of_violation .' 4:06:37');

        $date_year = date_format($date_violation, "Y"); //for Display Year
        $date_month =  date_format($date_violation, "m"); //for Display Month
        $date_day = date_format($date_violation, "d"); //for Display Date

// $tahun = YEAR($date_of_violation);

// Prints October 3, 1975 was on a Thursday
//   echo "Oct 3, 1975 was on a ".gmdate("l", mktime(0,0,0,$date_day,$date_month,$date_year)) . "<br>";

            // $day = gmdate($date_of_violation, time()+60*60*7);
            $day = gmdate("l", mktime(0,0,0,$date_day,$date_month,$date_year));

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
        
          $month_n = gmdate("n", mktime(0,0,0,$date_day,$date_month,$date_year));
          
          if($month_n == '1'){
            $ROM = 'I';
          }elseif($month_n == '2'){
            $ROM = 'II';
          }elseif($month_n == '3'){
            $ROM = 'III';
          }elseif($month_n == '4'){
            $ROM = 'IV';
          }elseif($month_n == '5'){
            $ROM = 'V';
          }elseif($month_n == '6'){
            $ROM = 'VI';
          }elseif($month_n == '7'){
            $ROM = 'VII';
          }elseif($month_n == '8'){
            $ROM = 'VIII';
          }elseif($month_n == '9'){
            $ROM = 'IX';
          }elseif($month_n == '10'){
            $ROM = 'X';
          }elseif($month_n == '11'){
            $ROM = 'XI';
          }elseif($month_n == '12'){
            $ROM = 'XII';
          }

          $tgl1 = $date_of_violation;// pendefinisian tanggal awal
          $date_end_violation = date('Y-m-d', strtotime('+180 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
          // echo $date_end_violation; //print tanggal

        //   dd($date_end_violation);

        //LOGIKAN PENENTUAN MENDAPATKAN PELANGGARAN
        $sel_alphabet = DB::table('alphabets')->find($alphabet_id);
        $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
        $sel_article = DB::table('articles')->find($sel_paragraph->article_id);

        
        //JIKA TIDAK ADA PELANGGARAN AKTIF
        if($last_vio == 'notactive' AND $last_type == 'notviolation'){
            // $type_of_violation = $sel_paragraph->type_of_verse;

            $violation_accumulation = null;    
            $alphabet_accumulation = null;    
            $violation_accumulation2 = null;    
            $violation_accumulation3 = null;  

        }else{
            if($last_type == 'Surat Peringatan Pertama' AND $sel_paragraph->type_of_verse == 'Surat Peringatan Pertama'){
                $status_type_violation = 'Surat Peringatan Kedua';
                
                // Cari pasal akumulasi
                $cari_pasal_akumulasi = DB::table('alphabets')
                                            ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                                            ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                                            ->where('paragraphs.type_of_verse', 'Surat Peringatan Kedua')
                                            ->where('alphabets.alphabet_accumulation', 'Surat Peringatan Pertama')
                                            ->select('alphabets.id')
                                            ->first();

                $pelanggran_sebelumnya = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->latest()                       
                            ->first();

                $cari_pasal_sebelumnya = DB::table('alphabets')
                            ->leftJoin('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                            ->leftJoin('articles', 'paragraphs.article_id', '=', 'articles.id')
                            ->where('alphabets.id',  $pelanggran_sebelumnya->alphabet_id)              
                            ->first();
                            

                $violation_accumulation = $pelanggran_sebelumnya;    
                $alphabet_accumulation = $cari_pasal_akumulasi->id;    
                $violation_accumulation2 = null;    
                $violation_accumulation3 = null;  
            }

        }
     
        DB::table('violations')->insert([
                'date_of_violation' => $date_of_violation,     
                'date_end_violation' => $date_end_violation,     
                'no_violation' => $no_sp,   
                'format' => 'SP-HRD',    
                'month_of_violation' => $month_n,     
                'violation_ROM' => $ROM,   
                'reporting_day' => '',     
                'reporting_date' => null,   
                'job_level' => $job_level,   
                'department' => $department,   
                'other_information' => $other_information,   
                        
                'violation_status' => 'active',     
                'type_of_violation' => $type_of_violation,   
            
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

        return redirect('hi/violations/' . $employee_id . '/edit');
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
        $employee = DB::table('employees')->where('id', $id)
                    ->first();

        return view('hi.violations.edit', [
            'employee' => $employee,
            'violations' => DB::table('violations')->where('employee_id', $id)->get(),
            'alphabets' => Alphabet::all(),
            'jobs' => Job::all(),
            'departments' => Department::all()
        ]);

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


    public function get_type_violation(Request $request)
    {

        //ambil data employee_id, status_violant_last, violation_now, violation_id
        $emp_id = $request->id_emp;
        $status_violant_last = $request->status_violant_last;
        $violation_now = $request->violation_now;
        $last_type = $request->last_type;

        //
        $sel_alphabet = DB::table('alphabets')->find($request->violation_now);
        $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
        $sel_article = DB::table('articles')->find($sel_paragraph->article_id);
        

        //LOGIKA MENAMPILKAN DATA PASAL DAN PASAL DELIK
        
        //JIKA TIDAK ADA PELANGGARAN AKTIF
        if($status_violant_last == 'notactive' AND $last_type == 'notviolation'){
            $status_type_violation = $sel_paragraph->type_of_verse;

            $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet.'" ' .  $sel_alphabet->description;
            
            $remainder = '-';
            
            $data = [$status_type_violation,  $pasal_yang_dilanggar,  $remainder];
        }else{

            if($last_type == 'Surat Peringatan Pertama' AND $sel_paragraph->type_of_verse == 'Surat Peringatan Pertama'){
                $status_type_violation = 'Surat Peringatan Kedua';
                
                // Cari pasal akumulasi
                $cari_pasal_akumulasi = DB::table('alphabets')
                                            ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                                            ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
                                            ->where('paragraphs.type_of_verse', 'Surat Peringatan Kedua')
                                            ->where('alphabets.alphabet_accumulation', 'Surat Peringatan Pertama')
                                            ->first();

                $pelanggran_sebelumnya = DB::table('violations')
                            ->where('employee_id',  $emp_id) 
                            ->latest()                       
                            ->first();

                $cari_pasal_sebelumnya = DB::table('alphabets')
                            ->leftJoin('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
                            ->leftJoin('articles', 'paragraphs.article_id', '=', 'articles.id')
                            ->where('alphabets.id',  $pelanggran_sebelumnya->alphabet_id)              
                            ->first();
                            
                $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $cari_pasal_akumulasi->article.' ayat   ('.$cari_pasal_akumulasi->paragraph .') huruf "'. $cari_pasal_akumulasi->alphabet.'" '. $cari_pasal_akumulasi->alphabet_sound;

                $remainder = '<p>Bobot Pelanggran sekarang yaitu Perjanjian Kerja Bersama Pasal '. $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet.'" ' .  $sel_alphabet->alphabet_sound . 
                '<b/> Dalam masa ' . $last_type . ' Perjanjian Kerja Bersama Pasal '. $cari_pasal_sebelumnya->article . ' ayat ('. $cari_pasal_sebelumnya->paragraph. ') huruf "'.$cari_pasal_sebelumnya->alphabet.'", ' .$pelanggran_sebelumnya->other_information .'</p>';
                
                $data = [ $status_type_violation, $pasal_yang_dilanggar, $remainder];
            }
        }




        // Perjanjian Kerja Bersama Pasal 27 ayat (4) huruf "t" Menitipkan dan/atau dititipi scanning absensi.

        // $data = $status_type_violation;
        return response()->json($data);
    }
}
