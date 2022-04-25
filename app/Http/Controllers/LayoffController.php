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

class LayoffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        return view('hi.layoffs.index', [
            'layoffs' => DB::table('layoffs')->paginate(10),
            'count' => DB::table('layoffs')->count()
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
        return view('hi.layoffs.create',[
            'alphabets' => Alphabet::all(),
            'employees' => Employee::all()
        ]);
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
        $num_lf = DB::table('layoffs')->count();

        if($num_lf < 1){
            $no_lf = 1;
        }elseif($num_lf > 0){
            $last_lf = DB::table('layoffs')
                ->latest()
                ->first();
            $no_lf = $last_lf->no_layoff + 1;
        }

    //     $date_violation = new \DateTime($reporting_date .' 00:00:00');

    //     $date_year = date_format($date_violation, "Y"); //for Display Year
    //     $date_month =  date_format($date_violation, "m"); //for Display Month
    //     $date_day = date_format($date_violation, "d");

    //     $day = gmdate($date_of_violation, time()+60*60*7);
    //     $day = date("l", gmmktime(0,0,0, $date_month,$date_day, $date_year));

    //   if($day == 'Monday'){
    //     $day_num = '1';
    //     $day_indo = 'Senin';
    //   }elseif($day == 'Tuesday'){
    //     $day_num = '2';
    //     $day_indo = 'Selasa';            
    //   }elseif($day == 'Wednesday'){
    //     $day_num = '3';
    //     $day_indo = 'Rabu';            
    //   }elseif($day == 'Thursday'){
    //     $day_num = '4';
    //     $day_indo = 'Kamis';            
    //   }elseif($day == 'Friday'){
    //     $day_num = '5';
    //     $day_indo = 'Jumat';            
    //   }elseif($day == 'Saturday'){
    //     $day_num = '6';
    //     $day_indo = 'Sabtu';            
    //   }elseif($day == 'Sunday'){
    //     $day_num = '7';
    //     $day_indo = 'Minggu';            
    //   }

        $month_n = date("n", gmmktime(0,0,0, $date_month, $date_day, $date_year));
          
        if($month_n == '1'){
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


        DB::table('layoffs')->insert([
            'alphabet_id' => $request->alphabet_id,
            'employee_id' => $request->employee_id,
            'layoff_description' => $request->layoff_description,
            'no_layoff' => $no_lf,
            'layoff_date_start' => $request->layoff_date_start,
            'layoff_date' => $request->layoff_date
        ]);

        return redirect('/hi/layoffs');
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
        return view('hi.layoffs.edit',[
            'layoff' => DB::table('layoffs')->find($id)
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

    public function get_pasal_phk(Request $request){

        $sel_alphabet = DB::table('alphabets')->find($request->pasal_phk);
        $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
        $sel_article = DB::table('articles')->find($sel_paragraph->article_id);
        
        $pasal = 'Perjanjian Kerja Bersama Pasal '.$sel_article->article.'. Jenis Pelanggaran dan Sanksi ayat ('.$sel_paragraph->paragraph.') tentang Pemutusan Hubungan Kerja (PHK) tanpa memberikan Pesangon. I. Pengusaha dapat melakukan Pemutusan Hubungan Kerja (PHK) tanpa memberikan Pesangon, apabila melakukan kesalahan berat sebagai berikut : '.$sel_alphabet->alphabet.'. '.$sel_alphabet->alphabet_sound.'';
        // $pasal = '1';
        $employees = DB::table('employees')
            ->select('id','number_of_employees', 'name')
            ->get();

        $data =  [$pasal, $employees];
        echo json_encode($data);
        // return response()->json($data);
    }

    public function get_karyawan_phk(Request $request){

        $signature_employee = $request->karyawan_phk;

        $employee = DB::table('employees')->find($signature_employee);

        $department = DB::table('departments')->find($employee->department_id);
        $job = DB::table('jobs')->find($employee->job_id);

        $data = [$employee->name, $employee->bagian, $employee->number_of_employees,  $department->department,  $job->job_level, $employee->hire_date];

        return response()->json($data);
    }

    public function karyawan_phk(){

       $employee = DB::table('employees')->get();
            // ->leftJoin('jobs', 'employees.job_id', '=', 'jobs.id')
            // ->leftJoin('departments', 'employees.department_id', '=', 'departments.id');

        $data = $employees;

        return response()->json($data);
    }
}
