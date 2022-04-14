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
        $emp_id = $request->emp_id;
        $status_violant_last = $request->status_violant_last;
        $violation_now = $request->violation_now;
        // $violation_id_last = $request->violation_id_last;

        //
        $sel_alphabet = DB::table('alphabets')->find($request->violation_now);
        $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
        $sel_article = DB::table('articles')->find($sel_paragraph->article_id);
        

        //LOGIKA 
        
        //JIKA TIDAK ADA PELANGGARAN AKTIF
        if($status_violant_last == 'notviolation'){
            $status_type_violation = $sel_paragraph->type_of_verse;

            $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet.'" ' .  $sel_alphabet->description;
            
            $remainder = '-';
            
            $data = [$status_type_violation,  $pasal_yang_dilanggar,  $remainder];
        }else{
            //ADA PELANGGARAN AKTIF DAN BERAKUMULASI DENGAN PELANGGARAN SEBELUMNYA
            $num_violation3 = DB::table('violations')
                ->where('employee_id', $emp_id)
                ->where('violation_accumulation3' , '!=' , '')
                ->latest()
                ->count();

            if($num_violation > 0){
                $sel_violation3 = DB::table('violations')
                    ->where('employee_id', $emp_id)
                    ->where('violation_accumulation3' , '!=' , '')
                    ->latest()
                    ->first();

            }else{
                //JIKA HANYA 
                $num_violation2 = DB::table('violations')
                    ->where('employee_id', $emp_id)
                    ->where('violation_accumulation2' , '!=' , '')
                    ->latest()
                    ->count();

                if($num_violation2 > 0){
                    $sel_violation2 = DB::table('violations')
                        ->where('employee_id', $emp_id)
                        ->where('violation_accumulation2' , '!=' , '')
                        ->latest()
                        ->first();
                }else{

                    $num_violation = DB::table('violations')
                        ->where('employee_id', $emp_id)
                        ->where('violation_accumulation' , '!=' , '')
                        ->latest()
                        ->count();

                    if($num_violation > 0){
                        $sel_violation = DB::table('violations')
                            ->where('employee_id', $emp_id)
                            ->where('violation_accumulation' , '!=' , '')
                            ->latest()
                            ->first();

                            // Pasal yang di langgar
                            $Pasal = 'Perjanjian Kerja Bersama Pasal 27 ayat (3) huruf "a" huruf "g" (akumulasi sekarang)  bunyi pasal akumulasi';

                            $ket2 = 'Bobot Pelanggaran sekarang yaitu Perjanjian Kerja Bersama Pasal 27 ayat (2) huruf "g" (pasal pelanggaran Sekarang) bunyi pasal';
                            $ket3 = 'Dalam masa Surat Peringatan Pertama (jenis_pelanggaran lalu)  Perjanjian Kerja Bersama Pasal 27 ayat (2) huruf "g" (pasal pelanggaran lalu) keterangan pelanggaran lalu';
                            

                            $status_type_violation = $sel_paragraph->type_of_verse;
                            $data = [$status_type_violation,   'Perjanjian Kerja Bersama Pasal '. $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet.'" ' .  $sel_alphabet->description];
                    }else{

                        $status_type_violation = $sel_paragraph->type_of_verse;
                        $data = [$status_type_violation,   'Perjanjian Kerja Bersama Pasal '. $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet.'" ' .  $sel_alphabet->description];

                    }

                }

            }

        }


        // Perjanjian Kerja Bersama Pasal 27 ayat (4) huruf "t" Menitipkan dan/atau dititipi scanning absensi.

        // $data = $status_type_violation;
        return response()->json($data);
    }
}
