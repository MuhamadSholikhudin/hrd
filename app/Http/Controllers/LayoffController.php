<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use App\Models\Alphabet;
use App\Models\Article;
use App\Models\Paragraph;
use App\Models\Violation;
use App\Models\Layoff;

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
        $layoffs = DB::table('layoffs')
            ->leftJoin('employees', 'employees.id', '=', 'layoffs.employee_id')
            ->select('layoffs.*', 'layoffs.id as id',
            'layoffs.layoff_date as layoff_date',
            'layoffs.no_layoff as no_layoff',
            'layoffs.layoff_date_start as layoff_date_start',
            'layoffs.rom_layoff as rom_layoff',
            'layoffs.type_of_layoff as type_of_layoff',
            'layoffs.alphabet_id as alphabet_id',
            'layoffs.layoff_description as layoff_description',
            'employees.name as name',
            'employees.number_of_employees as number_of_employees',
            )
            ->orderByDesc('layoffs.id');
        if(request('search')){
            $layoffs->where('layoff_date', 'like', '%' . request('search') . '%')
                        ->orWhere('layoff_date_start', 'like', '%' . request('search') . '%')
                        ->orWhere('name', 'like', '%' . request('search') . '%')
                        ->orWhere('number_of_employees', 'like', '%' . request('search') . '%')
                        ->orWhere('layoff_description', 'like', '%' . request('search') . '%');
        }
        
        return view('hi.layoffs.index', [
            'layoffs' => $layoffs->paginate(10)->withQuerystring(),
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
        // $alphabet = DB::table('alphabets')
            // ->rightJoin('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
            // ->where('paragraphs.type_of_verse', 'Pemutusan Hubungan Kerja')
        //     // ->select('alphabets.id as id' , 'paragraphs.id as paragraph_id')
            // ->get();

        $alphabet = DB::select( DB::raw("SELECT * FROM alphabets
        WHERE paragraph_id BETWEEN 6 AND 38") );

        return view('hi.layoffs.create',[
            'alphabets' =>  $alphabet,
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
        $month_m = date('m');
        $num_lf = DB::table('layoffs')
            ->whereMonth('layoff_date',  $month_m)
            ->count();

        if($num_lf < 1){
            $no_lf = 1;
        }elseif($num_lf > 0){
            $last_lf = DB::table('layoffs')
                ->latest()
                ->first();
            $no_lf = $last_lf->no_layoff + 1;
        }

        $date = $request->layoff_date;
        $date_layoff = new \DateTime($date .' 00:00:00');

        $date_year = date_format($date_layoff, "Y"); //for Display Year
        $date_month =  date_format($date_layoff, "m"); //for Display Month
        $date_day = date_format($date_layoff, "d");

    //     $day = gmdate($date_of_layoff, time()+60*60*7);
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

        $employee = DB::table('employees')->where('number_of_employees', $request->phk_employee)->first();

        DB::table('layoffs')->insert([
            'alphabet_id' => $request->alphabet_id,
            'employee_id' => $employee->id,
            'read' => $request->read,
            'layoff_description' => $request->layoff_description,
            'no_layoff' => $request->no_layoff,
            'rom_layoff' => $request->rom_layoff,
            'layoff_date_start' => $request->layoff_date_start,
            'layoff_date' => $request->layoff_date,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $select_employee = DB::table('employees')->find($employee->id);
        $remark = "menambahkan PHK ".$select_employee->number_of_employees;
        $action = "add";

        DB::table('histories')->insert([
            'user_id' => auth()->user()->id,
            'role_id' => auth()->user()->role_id,
            'remark' => $remark,
            'action' => $action,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect('/layoffs');
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

    $layoff = DB::table('layoffs')->find($id);

        return view('hi.layoffs.cetak',[
            'layoff' => $layoff,
            // 'job' => $job,
            // 'department' => $department
        ]);
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

        $layoff = DB::table('layoffs')->find($id);

        $employee = DB::table('employees')->find($layoff->employee_id);        
        $job = DB::table('jobs')->find($employee->job_id);
        $department = DB::table('departments')->find($employee->department_id);


        return view('hi.layoffs.edit',[
            'alphabets' => Alphabet::all(),
            'layoff' => $layoff,
            'job' => $job,
            'department' => $department
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

        DB::table('layoffs')
            ->where('id', $id)
            ->update([
                'alphabet_id' => $request->alphabet_id,
                'layoff_description' => $request->layoff_description,
                'layoff_date_start' => $request->layoff_date_start,
                'layoff_date' => $request->layoff_date
        ]);

        return redirect('/layoffs');
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
        $select_layoffs = DB::table('layoffs')->find($id);

        $select_employee = DB::table('employees')->find($select_layoffs->employee_id);

        $remark = "menghapus phk ".$select_employee->number_of_employees;
        $action = "delete";

        DB::table('histories')->insert([
            'user_id' => auth()->user()->id,
            'role_id' => auth()->user()->role_id,
            'remark' => $remark,
            'action' => $action,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        Layoff::destroy($id);
        return redirect('/layoffs');
    }

    public function get_pasal_phk(Request $request){

        $sel_alphabet = DB::table('alphabets')->find($request->pasal_phk);
        $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
        $sel_article = DB::table('articles')->find($sel_paragraph->article_id);
        
        // $pasal = 'Perjanjian Kerja Bersama Pasal '.$sel_article->article.'. Jenis Pelanggaran dan Sanksi ayat ('.$sel_paragraph->paragraph.') 
        $kecil = strtolower($sel_article->chapters);
        $chapters = ucwords($kecil);
        $pasal = 'Perjanjian Kerja Bersama Pasal '.$sel_article->article.' '.
        $chapters .'. ayat ('.$sel_paragraph->paragraph.') tentang '
        .$sel_paragraph->sub_chapters .' ' 
        . $sel_alphabet->alphabet.' .'
        .$sel_alphabet->alphabet_sound.'';
        // I. Pengusaha dapat melakukan Pemutusan Hubungan Kerja (PHK) tanpa memberikan Pesangon, apabila melakukan kesalahan berat sebagai berikut : '
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

        
        $c_employee = DB::table('employees')
            ->where('number_of_employees', $signature_employee)
            ->count();

        if($c_employee > 0){
            
            $employee = DB::table('employees')->where('number_of_employees', $signature_employee)->first();

            $department = DB::table('departments')->find($employee->department_id);
            $job = DB::table('jobs')->find($employee->job_id);
    
            $data = [$employee->name, $employee->bagian, $employee->number_of_employees,  $department->department,  $job->job_level, $employee->hire_date];   

            // $data = [1, "NULL", "NULL",  "NULL",  "NULL", "NULL"];   
        }else{
            $data = ["NULL", "NULL", "NULL",  "NULL",  "NULL", "NULL"];   
            
        }

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
