<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ViolationsImport;
use App\Imports\ViolationmigrationImport;

use App\Exports\ViolationsExport;
use App\Exports\ViolationsEditExport;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use App\Models\Alphabet;
use App\Models\Article;
use App\Models\Paragraph;
use App\Models\Violation;
use App\Models\Violationmigration;

class HiViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanggal_hari_ini = date('Y-m-d');// pendefinisian tanggal awal
        
        DB::table('violations')
        ->where('date_end_violation', '<', $tanggal_hari_ini)
        ->update([
            'violation_status' => 'notactive'
        ]);

        /*
            $cari_vio_alpha_not_null = DB::table('violations')

        */

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
                 )->orderByDesc('violations.id')
                //  ->orderByDesc('violations.no_violation')
                 ;

        if(request('search')){
            $violations->where('date_end_violation', 'like', '%' . request('search') . '%')
                      ->orWhere('date_of_violation', 'like', '%' . request('search') . '%')
                      ->orWhere('name', 'like', '%' . request('search') . '%')
                      ->orWhere('number_of_employees', 'like', '%' . request('search') . '%')
                      ->orWhere('other_information', 'like', '%' . request('search') . '%');
        }
        
        return view('hi.violations.list', [
            'violations' => $violations->paginate(10)->withQuerystring(),
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
        echo 1;
    }

    public function getedit($id)
    {
        //
        $violation = DB::table('violations')->find($id);

        $alphabet =DB::table('alphabets')
            // ->where('employee_id', $id)
            ->get();
        
        return view('hi.violations.getedit', [
            'violation' => $violation,
            'alphabets' => $alphabet
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        //MENANGKAP DATA REQUEST HTML
        $violation_id = $request->violation_id;
        $employee_id = $request->employee_id;
        $job_level = $request->job_level;
        $department = $request->department;
        $signature_id = $request->signature_id;

        $other_information = $request->other_information;
        $date_of_violation = $request->date_of_violation;
        $reporting_date = $request->reporting_date;
        $no_violation = $request->no_violation;
        $violation_ROM = $request->violation_ROM;

        $alphabet_id = $request->alphabet_id;
        $last_vio = $request->last_vio;
        $last_accumulation = $request->last_accumulation;
        $last_type = $request->last_type;
        
        
        //MEMBUAT INPUTAN OTOMATIS SURAT
        // NO SP 001/SP-HRD/IV/2022
        
        $month_m = date('m');
        $yaer_y_bul = date('Y');
        $num_no_sp = DB::table('violations')
            ->whereMonth('date_of_violation',  $month_m)
            ->whereYear('date_of_violation',  $yaer_y_bul)  
            ->count();
               
        if($num_no_sp < 1){
            $no_sp = 1;
        }elseif($num_no_sp > 0){
            $sel_no_sp = DB::table('violations')
                ->whereMonth('date_of_violation',  $month_m)
                ->whereYear('date_of_violation',  $yaer_y_bul)  
                ->orderByDesc('no_violation')
                ->first();
            $no_sp = $sel_no_sp->no_violation + 1 ;
        }
        
        require_once 'GetViolationFormat.php';

        //LOGIKAN PENENTUAN MENDAPATKAN PELANGGARAN
        $sel_alphabet = DB::table('alphabets')->find($alphabet_id);
        $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
        $sel_article = DB::table('articles')->find($sel_paragraph->article_id);
        
        //JIKA TIDAK ADA PELANGGARAN AKTIF
        if($last_vio == 'notactive' OR $last_type == 'notviolation')
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

            $num_vio_accumulation3 = DB::table('violations')
                ->where('employee_id',  $employee_id) 
                ->where('violation_accumulation', '!=',  null) 
                ->where('violation_accumulation2', '!=',  null) 
                ->where('violation_accumulation3', '!=',  null) 
                ->where('alphabet_accumulation', '!=',  null) 
                ->where('violation_status', 'active')
                ->where('id', '<', $violation_id) 
                ->latest()                       
                ->count();

            if($num_vio_accumulation3 > 0){

                            // GET LOGIKA AKUMULASI KEEMPAT
                $get_first_vio_accumulation3 = DB::table('violations')
                    ->where('employee_id',  $employee_id) 
                    ->where('violation_accumulation', '!=',  null) 
                    ->where('violation_accumulation2', '!=',  null) 
                    ->where('violation_accumulation3', '!=',  null) 
                    ->where('alphabet_accumulation', '!=',  null) 
                    ->where('violation_status', 'active') 
                    ->where('id', '<', $violation_id)
                    ->latest()                       
                    ->first();

                $get_num_vio_accumulation3 = DB::table('violations')
                    ->where('employee_id',  $employee_id) 
                    ->where('violation_accumulation', $get_first_vio_accumulation3->id) 
                    ->where('violation_status', 'active')       
                    ->count();

                if($get_num_vio_accumulation3 > 0){
                    // GET LOGIKA AKUMULASI PERINGATAN LISAN
                    require_once 'GetViolationArticleUpdate.php';

                    $cek_pelanggran_sebelumnya2 = DB::table('violations')
                        ->where('employee_id',  $employee_id) 
                        ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                        ->latest()                       
                        ->count();
                    if($cek_pelanggran_sebelumnya2 > 0){
                        $pelanggran_sebelumnya2 = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                            ->latest()                       
                            ->first();
                        $cek_pelanggran_sebelumnya3 = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                            ->latest()                       
                            ->count(); 
                        if($cek_pelanggran_sebelumnya3 > 0){
                            $pelanggran_sebelumnya3 = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                ->latest()                       
                                ->first();   
                                $pelanggran_sebelumnya3_id = $pelanggran_sebelumnya3->id;
                        }else{
                            $pelanggran_sebelumnya3_id = null;
                        }
                        $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                    }else{
                        $pelanggran_sebelumnya2_id = null;
                        $pelanggran_sebelumnya3_id = null;
                    }                               
                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                    $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                    $violation_accumulation3 = $pelanggran_sebelumnya3_id;   
                
                }else{
                    // BATAS AKUMULASI

                    // CARI PELANGGARAN AKUMULASI 3               
                    $num_vio_accumulation2 = DB::table('violations')
                        ->where('employee_id',  $employee_id) 
                        ->where('violation_accumulation', '!=',  null) 
                        ->where('violation_accumulation2', '!=',  null) 
                        ->where('alphabet_accumulation', '!=',  null) 
                        ->where('violation_status', 'active') 
                        ->where('id', '<', $violation_id)
                        ->latest()                       
                        ->count();

                    if($num_vio_accumulation2 > 0){
                                        
                        // LOGIKA AKUMULSI KETIGA
                        $get_first_vio_accumulation2 = DB::table('violations')
                            ->where('violation_accumulation', '!=',  null) 
                            ->where('violation_accumulation2', '!=',  null) 
                            ->where('alphabet_accumulation', '!=',  null) 
                            ->where('violation_status', 'active') 
                            ->where('id', '<', $violation_id)
                            ->latest()                       
                            ->first();
            
                        $get_num_vio_accumulation2 = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->where('violation_accumulation', $get_first_vio_accumulation2->id) 
                            ->where('violation_status', 'active')       
                            ->count();

                            if($get_num_vio_accumulation2 > 0){
                                require_once 'GetViolationArticleUpdate.php';

                                $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                    ->latest()                       
                                    ->count();
                                if($cek_pelanggran_sebelumnya2 > 0){
                                    $pelanggran_sebelumnya2 = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                        ->latest()                       
                                        ->first();
                                    $cek_pelanggran_sebelumnya3 = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                        ->latest()                       
                                        ->count(); 
                                    if($cek_pelanggran_sebelumnya3 > 0){
                                        $pelanggran_sebelumnya3 = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                            ->latest()                       
                                            ->first();   
                                            $pelanggran_sebelumnya3_id = $pelanggran_sebelumnya3->id;
                                    }else{
                                        $pelanggran_sebelumnya3_id = null;
                                    }
                                    $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                                }else{
                                    $pelanggran_sebelumnya2_id = null;
                                    $pelanggran_sebelumnya3_id = null;
                                }                               
                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                                $violation_accumulation3 = $pelanggran_sebelumnya3_id;  
                
                            }else{

                            // BATAS AKUMULASI 

                                $num_vio_accumulation = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('violation_accumulation', '!=',  null) 
                                    ->where('alphabet_accumulation', '!=',  null) 
                                    ->where('violation_status', 'active')
                                    ->where('id', '<', $violation_id) 
                                    ->latest()                       
                                    ->count();
                    
                                if($num_vio_accumulation > 0){
                    
                                    $get_first_vio_accumulation = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('violation_accumulation', '!=',  null) 
                                        ->where('alphabet_accumulation', '!=',  null) 
                                        ->where('violation_status', 'active') 
                                        ->where('id', '<', $violation_id)
                                        ->latest()                       
                                        ->first();
                    
                                    $get_num_vio_accumulation = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id', $get_first_vio_accumulation->id) 
                                        ->where('violation_status', 'active')       
                                        ->count();
                    
                                        if($get_num_vio_accumulation > 0){
                    
                                            require_once 'GetViolationArticleUpdate.php';
                                            $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                                ->where('employee_id',  $employee_id) 
                                                ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                ->latest()                       
                                                ->count();
        
                                            if($cek_pelanggran_sebelumnya2 > 0){
                                                $pelanggran_sebelumnya2 = DB::table('violations')
                                                ->where('employee_id',  $employee_id) 
                                                ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                ->latest()                       
                                                ->first();
                                                $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                                            }else{
                                                $pelanggran_sebelumnya2_id = null;
                                            }
                                            
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                                            $violation_accumulation3 = null;    
                                            $violation_accumulation3 = null;  
                    
                                        }else{
                                            //LOGIKA AKUMULSAI PERTAMA
                                            require_once 'GetViolationArticleUpdate.php';
                                            
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = null;    
                                            $violation_accumulation3 = null;  
                                        }
                    
                                }else{
                                    //LOGIKA AKUMULSAI PERTAMA
                                    require_once 'GetViolationArticleUpdate.php';
                                    
                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                    $violation_accumulation2 = null;    
                                    $violation_accumulation3 = null;  
                                }
                            }
                    
                        }else{

                            $num_vio_accumulation = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('violation_accumulation', '!=',  null) 
                                ->where('alphabet_accumulation', '!=',  null) 
                                ->where('violation_status', 'active') 
                                ->where('id', '<', $violation_id)
                                ->latest()                       
                                ->count();
            
                            if($num_vio_accumulation > 0){
                
                                $get_first_vio_accumulation = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('violation_accumulation', '!=',  null) 
                                    ->where('alphabet_accumulation', '!=',  null) 
                                    ->where('violation_status', 'active') 
                                    ->where('id', '<', $violation_id)
                                    ->latest()                       
                                    ->first();
                
                                $get_num_vio_accumulation = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('id', $get_first_vio_accumulation->id) 
                                    ->where('violation_status', 'active')       
                                    ->count();
                
                                    if($get_num_vio_accumulation > 0){
                
                                        require_once 'GetViolationArticleUpdate.php';
                                        $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                            ->latest()                       
                                            ->count();

                                        if($cek_pelanggran_sebelumnya2 > 0){
                                            $pelanggran_sebelumnya2 = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                            ->latest()                       
                                            ->first();
                                            $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                                        }else{
                                            $pelanggran_sebelumnya2_id = null;
                                        }
                                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                                        $violation_accumulation3 = null;      
                                        $violation_accumulation3 = null;  
                
                                    }else{
                                        //LOGIKA AKUMULSAI PERTAMA
                                        require_once 'GetViolationArticleUpdate.php';
                                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = null;    
                                        $violation_accumulation3 = null;  
                                    }
                
                            }else{
                                //LOGIKA AKUMULSAI PERTAMA
                                require_once 'GetViolationArticleUpdate.php';
                                
                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                $violation_accumulation2 = null;    
                                $violation_accumulation3 = null;  
                            }
                        
                        }
                }
            
            }else{
                // BATAS AKUMULASI
                // CARI PELANGGARAN AKUMULASI 3               
                $num_vio_accumulation2 = DB::table('violations')
                    ->where('employee_id',  $employee_id) 
                    ->where('violation_accumulation', '!=',  null) 
                    ->where('violation_accumulation2', '!=',  null) 
                    ->where('alphabet_accumulation', '!=',  null) 
                    ->where('violation_status', 'active') 
                    ->where('id', '<', $violation_id)
                    ->latest()                       
                    ->count();

                if($num_vio_accumulation2 > 0){
                                        
                    // LOGIKA AKUMULSI KETIGA
                    $get_first_vio_accumulation2 = DB::table('violations')
                        ->where('violation_accumulation', '!=',  null) 
                        ->where('violation_accumulation2', '!=',  null) 
                        ->where('alphabet_accumulation', '!=',  null) 
                        ->where('violation_status', 'active') 
                        ->where('id', '<', $violation_id)
                        ->latest()                       
                        ->first();
        
                    $get_num_vio_accumulation2 = DB::table('violations')
                        ->where('employee_id',  $employee_id) 
                        ->where('violation_accumulation', $get_first_vio_accumulation2->id) 
                        ->where('violation_status', 'active')       
                        ->count();

                        if($get_num_vio_accumulation2 > 0){
                            require_once 'GetViolationArticleUpdate.php';
    
                            $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                ->latest()                       
                                ->count();
                            if($cek_pelanggran_sebelumnya2 > 0){
                                $pelanggran_sebelumnya2 = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                    ->latest()                       
                                    ->first();
                                $cek_pelanggran_sebelumnya3 = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                    ->latest()                       
                                    ->count(); 
                                if($cek_pelanggran_sebelumnya3 > 0){
                                    $pelanggran_sebelumnya3 = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                        ->latest()                       
                                        ->first();   
                                        $pelanggran_sebelumnya3_id = $pelanggran_sebelumnya3->id;
                                }else{
                                    $pelanggran_sebelumnya3_id = null;
                                }
                                $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                            }else{
                                $pelanggran_sebelumnya2_id = null;
                                $pelanggran_sebelumnya3_id = null;
                            }                               
                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                            $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                            $violation_accumulation3 = $pelanggran_sebelumnya3_id;    
            
                        }else{

                        // BATAS AKUMULASI 

                            $num_vio_accumulation = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('violation_accumulation', '!=',  null) 
                                ->where('alphabet_accumulation', '!=',  null) 
                                ->where('violation_status', 'active') 
                                ->where('id', '<', $violation_id)
                                ->latest()                       
                                ->count();
                
                            if($num_vio_accumulation > 0){
                
                                $get_first_vio_accumulation = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('violation_accumulation', '!=',  null) 
                                    ->where('alphabet_accumulation', '!=',  null) 
                                    ->where('violation_status', 'active') 
                                    ->where('id', '<', $violation_id)
                                    ->latest()                       
                                    ->first();
                
                                $get_num_vio_accumulation = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('id', $get_first_vio_accumulation->id) 
                                    ->where('violation_status', 'active')       
                                    ->count();
                
                                    if($get_num_vio_accumulation > 0){
                
                                        require_once 'GetViolationArticleUpdate.php';
                                        $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                            ->latest()                       
                                            ->count();

                                        if($cek_pelanggran_sebelumnya2 > 0){
                                            $pelanggran_sebelumnya2 = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                            ->latest()                       
                                            ->first();
                                            $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                                        }else{
                                            $pelanggran_sebelumnya2_id = null;
                                        }
                                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                                        $violation_accumulation3 = null;  
                
                                    }else{
                                        //LOGIKA AKUMULSAI PERTAMA
                                        require_once 'GetViolationArticleUpdate.php';
                                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = null;    
                                        $violation_accumulation3 = null;  
                                    }
                
                            }else{
                                //LOGIKA AKUMULSAI PERTAMA
                                require_once 'GetViolationArticleUpdate.php';
                                
                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                $violation_accumulation2 = null;    
                                $violation_accumulation3 = null;  
                            }
                        }
                
                    }else{

                        $num_vio_accumulation = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->where('violation_accumulation', '!=',  null) 
                            ->where('alphabet_accumulation', '!=',  null) 
                            ->where('violation_status', 'active') 
                            ->where('id', '<', $violation_id)
                            ->latest()                       
                            ->count();
        
                        if($num_vio_accumulation > 0){
            
                            $get_first_vio_accumulation = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('violation_accumulation', '!=',  null) 
                                ->where('alphabet_accumulation', '!=',  null) 
                                ->where('violation_status', 'active') 
                                ->where('id', '<', $violation_id)
                                ->latest()                       
                                ->first();
            
                            $get_num_vio_accumulation = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('id', $get_first_vio_accumulation->id) 
                                ->where('violation_status', 'active')       
                                ->count();
            
                                if($get_num_vio_accumulation > 0){
            
                                    require_once 'GetViolationArticleUpdate.php';
                                    $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                        ->latest()                       
                                        ->count();

                                    if($cek_pelanggran_sebelumnya2 > 0){
                                        $pelanggran_sebelumnya2 = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                        ->latest()                       
                                        ->first();
                                        $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                                    }else{
                                        $pelanggran_sebelumnya2_id = null;
                                    }
                                    
                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                    $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                                    $violation_accumulation3 = null;  
            
                                }else{
                                    //LOGIKA AKUMULSAI PERTAMA
                                    require_once 'GetViolationArticleUpdate.php';
                                    
                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                    $violation_accumulation2 = null;    
                                    $violation_accumulation3 = null;  
                                }
            
                        }else{
                            //LOGIKA AKUMULSAI PERTAMA
                            require_once 'GetViolationArticleUpdate.php';
                            
                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                            $violation_accumulation2 = null;    
                            $violation_accumulation3 = null;  
                        }
                    }
            }
        } 
                  
              
        $cari_vio = DB::table('violations')->find($violation_id);
        $data = [
            'date_of_violation' => $date_of_violation,     
            'date_end_violation' => $date_end_violation,     
            'no_violation' => $no_violation,   
            'format' => 'SP-HRD',    
            'month_of_violation' => $month_n,     
            'violation_ROM' => $violation_ROM,   
            'reporting_day' =>  $day_indo,     
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

            'created_at' => $cari_vio->created_at,
            'updated_at' => date('Y-m-d H:i:s'),
            
            'alphabet_id' => $alphabet_id,           
            'signature_id' => $signature_id,    
            'employee_id' => $employee_id
        ];

        DB::table('violations')
            ->where('id', $violation_id)
            ->update($data);

        $select_employee = DB::table('employees')->find($employee_id);
        $remark = "mengubah pelanggaran ".$select_employee->number_of_employees;
        $action = "ubah";

        DB::table('histories')->insert([
            'user_id' => auth()->user()->id,
            'role_id' => auth()->user()->role_id,
            'remark' => $remark,
            'action' => $action,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect('/violations/' . $employee_id . '/edit');
    }
    
    public function cancel(Request $request)
    {
        //
        // Violation::destroy($violation->id);
       
        $select_vio = DB::table('violations')->find($request->id);

        $select_employee = DB::table('employees')->find($select_vio->employee_id);


        if($select_vio->violation_status == 'active'){
            $data = [                    
                'violation_status' => 'cancel',     
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $ses = "batalkan";
        }else{
            $data = [                    
                'violation_status' => 'active',     
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $ses = "activate";
        }

        $remark = $ses." pelanggaran ".$select_employee->number_of_employees.' NOMER ' . $select_vio->no_violation.'/SP-HRD/'.$select_vio->violation_ROM.'/'.tahun($select_vio->date_of_violation);
        $action = $ses;

        DB::table('histories')->insert([
            'user_id' => auth()->user()->id,
            'role_id' => auth()->user()->role_id,
            'remark' => $remark,
            'action' => $action,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);


        

        DB::table('violations')
            ->where('id', $request->id)
            ->update($data);

        return redirect('hiviolations')->with('success', 'Data Pelanggaran '.$select_employee->number_of_employees.' NOMER 	'. $select_vio->no_violation.'/SP-HRD/'.$select_vio->violation_ROM.'/'.tahun($select_vio->date_of_violation).' Berhasil di '. $ses);

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
        
        return redirect('hiviolations')->with('success', 'Data Pelanggaran Berhasil di hapus!');
    }

    public function importmigration()
    {
        $rows =  Excel::toArray(new ViolationsImport, request()->file('file'));
        ini_set('max_execution_time', 7200);

        foreach($rows as $row):
            $jumlahTotal = 0;
            foreach($row as $x):
                //Memastikan tidak ada nilai null NIK
                            // 27 ayat (3) huruf "a"
            if($x['number_of_employees'] == NULL){

            }else{ 
                //Mencari Karywan
                if($x['number_of_employees'] == ""){
                    $search_employee = DB::table('employees')->where('number_of_employees', '=', $x['number_of_employees'])->count();
                }elseif($x['number_of_employees'] == "-"){
                    $search_employee = DB::table('employees')->where('number_of_employees', '=', $x['number_of_employees'])->count();

                }else{
                    $search_employee = DB::table('employees')->where('number_of_employees', '=', floor($x['number_of_employees']))->count();
                }

                if($search_employee < 1){

                }else{
                    $employee = DB::table('employees')->where('number_of_employees', '=', floor($x['number_of_employees']))->first();

                    $employee_id = $employee->id;
                    
                    // $date_of_violation = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['date_of_violation']);
                    // $reporting_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['reporting_date']);

                    $date_of_violation = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['date_of_violation']);
                    if($date_of_violation == 'false'){
                        return redirect('/hiviolations')->with('danger', 'Data Karyawan Mulai dari baris '. floor($x['number_of_employees']) . ' Format Tanggal date_of_violation salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    $reporting_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['reporting_date']);
                    if($date_of_violation == 'false'){
                        return redirect('/hiviolations')->with('danger', 'Data Karyawan Mulai dari baris '. floor($x['number_of_employees']) . ' Format Tanggal reporting_date salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    $date_end_violation = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['date_end_violation']);
                    if($date_of_violation == 'false'){
                        return redirect('/hiviolations')->with('danger', 'Data Karyawan Mulai dari baris '. floor($x['number_of_employees']) . ' Format Tanggal date_end_violation salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    $datev = $date_of_violation;
                    $dater = $reporting_date;
                    $datee = $date_end_violation;

                    $resultv = $datev->format('Y-m-d');
                    $resultr = $dater->format('Y-m-d');
                    $resulte = $datee->format('Y-m-d');
                    
                    // $alphabet_id = floor($x['alphabet_id']);

                    $no_violation = $x['no_violation'];
                    $job_level = $x['job_level'];
                    $department = $x['department'];
                    $type_of_verse = $x['type_of_verse'];
                    $other_information = $x['other_information'];    
                    $accumulation = $x['accumulation'];    
                    
                    $month_of_violation = $x['month_of_violation'];                        
                    $violation_ROM = $x['violation_rom'];    
                    $reporting_day = $x['reporting_day'];    

                    $alphabet_id = $x['alphabet_id'];  

                    if($x['alphabet_accumulation'] == NULL){
                        // $alphabet_accumulation = floor($x['alphabet_accumulation']);                 
                        $alphabet_accumulation = NULL;                            
                        $violation_accumulation = NULL;
                        $violation_accumulation2 = NULL;

                    }elseif($x['alphabet_accumulation'] == ""){
                        $alphabet_accumulation = NULL;
                        $violation_accumulation = NULL;
                        $violation_accumulation2 = NULL;
                    }else{
                        $alphabet_accumulation = $x['alphabet_accumulation']; 

                        $sel_num_vio = DB::table('violations')->where('employee_id', $employee->id)->count();
                        if($sel_num_vio == 0){
                            $violation_accumulation = NULL;
                            $violation_accumulation2 = NULL;
                            $violation_accumulation3 = NULL;
                            
                        }else{
                            $sel_vio = DB::table('violations')->where('employee_id', $employee->id)->latest()->first();

                            $car_date_end = $sel_vio->date_end_violation;

                            if($car_date_end > $resulte){ 
                                $violation_accumulation = $sel_vio->id;
                                $vi_accumulation = $sel_vio->violation_accumulation2;

                                if($vi_accumulation == NULL){
                                    if($sel_vio->violation_accumulation !== NULL){
                                        $violation_accumulation2 = $sel_vio->violation_accumulation;
                                        $violation_accumulation3 = NULL;
                                    }else{
                                        $violation_accumulation2 = NULL;
                                        $violation_accumulation3 = NULL;
                                    }

                                }else{
                                        $violation_accumulation2 = $sel_vio->violation_accumulation;
                                        $violation_accumulation3 = $sel_vio->violation_accumulation2;
                                }
    
                            }elseif($car_date_end < $resulte){
                                $violation_accumulation = NULL;
                                $violation_accumulation2 = NULL;
                                $violation_accumulation3 = NULL;
                            }else{
                                $violation_accumulation = NULL;
                                $violation_accumulation2 = NULL;
                                $violation_accumulation3 = NULL;
                            }
                                $violation_accumulation = NULL;
                                $violation_accumulation2 = NULL; 
                                $violation_accumulation3 = NULL; 
                        }                                     
                    }
                    
                    $signature = DB::table('signatures')->where('status_signature', 'active')->first();
                    
                    $signature_id = $signature->id;

                // percobaan
                    // if($alphabet_accumulation !== NULL){
                    //     $sel_num_vio = DB::table('violations')->where('employee_id', $employee->id)->count();
                    //     if($sel_num_vio == 0){
                    //         $violation_accumulation = NULL;
                    //         $violation_accumulation2 = NULL;
                            
                    //       }else{
                    //         $sel_vio = DB::table('violations')->where('employee_id', $employee->id)->latest()->first();

                    //         $car_date_end = $sel_vio->date_end_violation;

                    //         if($car_date_end > $resulte){ 

                    //             $violation_accumulation = $sel_vio->id;

                    //             if($sel_vio->violation_accumulation !== NULL){
                    //                 $violation_accumulation2 = $sel_vio->violation_accumulation;
                    //             }else{
                    //                 $violation_accumulation2 = NULL;
                    //             }

                    //         }elseif($car_date_end < $resulte){
                    //             $violation_accumulation = NULL;
                    //             $violation_accumulation2 = NULL;

                    //         }else{
                    //             $violation_accumulation = NULL;
                    //             $violation_accumulation2 = NULL;

                    //         }
                    //              $violation_accumulation = NULL;
                    //             $violation_accumulation2 = NULL;

                    //     }

                    // }else{
                    //     $violation_accumulation = NULL;
                    //     $violation_accumulation2 = NULL;
                    // }
                // percobaan

                /*
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
                        $num_vio_accumulation3 = DB::table('violations')
                        ->where('employee_id',  $employee_id) 
                        ->where('violation_accumulation', '!=',  null) 
                        ->where('violation_accumulation2', '!=',  null) 
                        ->where('violation_accumulation3', '!=',  null) 
                        ->where('alphabet_accumulation', '!=',  null) 
                        ->where('violation_status', 'active') 
                        ->latest()                       
                        ->count();
        
                    if($num_vio_accumulation3 > 0){
        
                                    // GET LOGIKA AKUMULASI KEEMPAT
                        $get_first_vio_accumulation3 = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->where('violation_accumulation', '!=',  null) 
                            ->where('violation_accumulation2', '!=',  null) 
                            ->where('violation_accumulation3', '!=',  null) 
                            ->where('alphabet_accumulation', '!=',  null) 
                            ->where('violation_status', 'active') 
                            ->latest()                       
                            ->first();
        
                        $get_num_vio_accumulation3 = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->where('violation_accumulation', $get_first_vio_accumulation3->id) 
                            ->where('violation_status', 'active')       
                            ->count();
        
                        if($get_num_vio_accumulation3 > 0){
                            // GET LOGIKA AKUMULASI PERINGATAN LISAN
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
        
                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                            $violation_accumulation2 = $pelanggran_sebelumnya2->id;    
                            $violation_accumulation3 = $pelanggran_sebelumnya3->id;  
                        
                        }else{
                            // BATAS AKUMULASI
        
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
                                $get_first_vio_accumulation2 = DB::table('violations')
                                    ->where('violation_accumulation', '!=',  null) 
                                    ->where('violation_accumulation2', '!=',  null) 
                                    ->where('alphabet_accumulation', '!=',  null) 
                                    ->where('violation_status', 'active') 
                                    ->latest()                       
                                    ->first();
                    
                                $get_num_vio_accumulation2 = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('violation_accumulation', $get_first_vio_accumulation2->id) 
                                    ->where('violation_status', 'active')       
                                    ->count();
        
                                    if($get_num_vio_accumulation2 > 0){
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
                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = $pelanggran_sebelumnya2->id;    
                                        $violation_accumulation3 = $pelanggran_sebelumnya3->id;  
                        
                                    }else{
        
                                    // BATAS AKUMULASI 
        
                                        $num_vio_accumulation = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('violation_accumulation', '!=',  null) 
                                            ->where('alphabet_accumulation', '!=',  null) 
                                            ->where('violation_status', 'active') 
                                            ->latest()                       
                                            ->count();
                            
                                        if($num_vio_accumulation > 0){
                            
                                            $get_first_vio_accumulation = DB::table('violations')
                                                ->where('employee_id',  $employee_id) 
                                                ->where('violation_accumulation', '!=',  null) 
                                                ->where('alphabet_accumulation', '!=',  null) 
                                                ->where('violation_status', 'active') 
                                                ->latest()                       
                                                ->first();
                            
                                            $get_num_vio_accumulation = DB::table('violations')
                                                ->where('employee_id',  $employee_id) 
                                                ->where('id', $get_first_vio_accumulation->id) 
                                                ->where('violation_status', 'active')       
                                                ->count();
                            
                                                if($get_num_vio_accumulation > 0){
                            
                                                    require_once 'GetViolationArticle.php';
                                                    $pelanggran_sebelumnya2 = DB::table('violations')
                                                        ->where('employee_id',  $employee_id) 
                                                        ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                        ->latest()                       
                                                        ->first();
                                                    
                                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                    $violation_accumulation2 = $pelanggran_sebelumnya2->id;    
                                                    $violation_accumulation3 = null;  
                            
                                                }else{
                                                    //LOGIKA AKUMULSAI PERTAMA
                                                    require_once 'GetViolationArticle.php';
                                                    
                                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                    $violation_accumulation2 = null;    
                                                    $violation_accumulation3 = null;  
                                                }
                            
                                        }else{
                                            //LOGIKA AKUMULSAI PERTAMA
                                            require_once 'GetViolationArticle.php';
                                            
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = null;    
                                            $violation_accumulation3 = null;  
                                        }
                                    }
                            
                                }else{
        
                                    $num_vio_accumulation = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('violation_accumulation', '!=',  null) 
                                        ->where('alphabet_accumulation', '!=',  null) 
                                        ->where('violation_status', 'active') 
                                        ->latest()                       
                                        ->count();
                    
                                    if($num_vio_accumulation > 0){
                        
                                        $get_first_vio_accumulation = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('violation_accumulation', '!=',  null) 
                                            ->where('alphabet_accumulation', '!=',  null) 
                                            ->where('violation_status', 'active') 
                                            ->latest()                       
                                            ->first();
                        
                                        $get_num_vio_accumulation = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id', $get_first_vio_accumulation->id) 
                                            ->where('violation_status', 'active')       
                                            ->count();
                        
                                            if($get_num_vio_accumulation > 0){
                        
                                                require_once 'GetViolationArticle.php';
                                                $pelanggran_sebelumnya2 = DB::table('violations')
                                                    ->where('employee_id',  $employee_id) 
                                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                    ->latest()                       
                                                    ->first();
                                                
                                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                $violation_accumulation2 = $pelanggran_sebelumnya2->id;    
                                                $violation_accumulation3 = null;  
                        
                                            }else{
                                                //LOGIKA AKUMULSAI PERTAMA
                                                require_once 'GetViolationArticle.php';
                                                
                                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                $violation_accumulation2 = null;    
                                                $violation_accumulation3 = null;  
                                            }
                        
                                    }else{
                                        //LOGIKA AKUMULSAI PERTAMA
                                        require_once 'GetViolationArticle.php';
                                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = null;    
                                        $violation_accumulation3 = null;  
                                    }
                                
                                }
        
        
                        }
                    
                    }else{
                        // BATAS AKUMULASI
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
                            $get_first_vio_accumulation2 = DB::table('violations')
                                ->where('violation_accumulation', '!=',  null) 
                                ->where('violation_accumulation2', '!=',  null) 
                                ->where('alphabet_accumulation', '!=',  null) 
                                ->where('violation_status', 'active') 
                                ->latest()                       
                                ->first();
                
                            $get_num_vio_accumulation2 = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('violation_accumulation', $get_first_vio_accumulation2->id) 
                                ->where('violation_status', 'active')       
                                ->count();
        
                                if($get_num_vio_accumulation2 > 0){
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
                    
                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                    $violation_accumulation2 = $pelanggran_sebelumnya2->id;    
                                    $violation_accumulation3 = $pelanggran_sebelumnya3->id;  
                    
                                }else{
        
                                // BATAS AKUMULASI 
        
                                    $num_vio_accumulation = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('violation_accumulation', '!=',  null) 
                                        ->where('alphabet_accumulation', '!=',  null) 
                                        ->where('violation_status', 'active') 
                                        ->latest()                       
                                        ->count();
                        
                                    if($num_vio_accumulation > 0){
                        
                                        $get_first_vio_accumulation = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('violation_accumulation', '!=',  null) 
                                            ->where('alphabet_accumulation', '!=',  null) 
                                            ->where('violation_status', 'active') 
                                            ->latest()                       
                                            ->first();
                        
                                        $get_num_vio_accumulation = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id', $get_first_vio_accumulation->id) 
                                            ->where('violation_status', 'active')       
                                            ->count();
                        
                                            if($get_num_vio_accumulation > 0){
                        
                                                require_once 'GetViolationArticle.php';
                                                $pelanggran_sebelumnya2 = DB::table('violations')
                                                    ->where('employee_id',  $employee_id) 
                                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                    ->latest()                       
                                                    ->first();
                                                
                                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                $violation_accumulation2 = $pelanggran_sebelumnya2->id;    
                                                $violation_accumulation3 = null;  
                        
                                            }else{
                                                //LOGIKA AKUMULSAI PERTAMA
                                                require_once 'GetViolationArticle.php';
                                                
                                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                $violation_accumulation2 = null;    
                                                $violation_accumulation3 = null;  
                                            }
                        
                                    }else{
                                        //LOGIKA AKUMULSAI PERTAMA
                                        require_once 'GetViolationArticle.php';
                                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = null;    
                                        $violation_accumulation3 = null;  
                                    }
                                }
                        
                            }else{
        
                                $num_vio_accumulation = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('violation_accumulation', '!=',  null) 
                                    ->where('alphabet_accumulation', '!=',  null) 
                                    ->where('violation_status', 'active') 
                                    ->latest()                       
                                    ->count();
                
                                if($num_vio_accumulation > 0){
                    
                                    $get_first_vio_accumulation = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('violation_accumulation', '!=',  null) 
                                        ->where('alphabet_accumulation', '!=',  null) 
                                        ->where('violation_status', 'active') 
                                        ->latest()                       
                                        ->first();
                    
                                    $get_num_vio_accumulation = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id', $get_first_vio_accumulation->id) 
                                        ->where('violation_status', 'active')       
                                        ->count();
                    
                                        if($get_num_vio_accumulation > 0){
                    
                                            require_once 'GetViolationArticle.php';
                                            $pelanggran_sebelumnya2 = DB::table('violations')
                                                ->where('employee_id',  $employee_id) 
                                                ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                ->latest()                       
                                                ->first();
                                            
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = $pelanggran_sebelumnya2->id;    
                                            $violation_accumulation3 = null;  
                    
                                        }else{
                                            //LOGIKA AKUMULSAI PERTAMA
                                            require_once 'GetViolationArticle.php';
                                            
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = null;    
                                            $violation_accumulation3 = null;  
                                        }
                    
                                }else{
                                    //LOGIKA AKUMULSAI PERTAMA
                                    require_once 'GetViolationArticle.php';
                                    
                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                    $violation_accumulation2 = null;    
                                    $violation_accumulation3 = null;  
                                }
                            
                            }
        
                    }
                }
                    */    
                
                    // Violation::create([
                    $data = [
                        'date_of_violation' => $date_of_violation,     
                        'date_end_violation' => $date_end_violation,     
                        'no_violation' => $no_violation,   
                        'format' => 'SP-HRD',    
                        'month_of_violation' => $x['month_of_violation'],     
                        'violation_ROM' => $violation_ROM,   
                        'reporting_day' => $reporting_day,     
                        'reporting_date' => $reporting_date,   
                        'job_level' => $job_level,   
                        'department' => $department,   
                        'other_information' => $other_information,   
                                
                        'violation_status' => $x['violation_status'],     
                        'type_of_violation' => $x['type_of_verse'],   
                    
                        'accumulation' => $accumulation,    
                        'alphabet_accumulation' => $alphabet_accumulation,    
                        'violation_accumulation' => $violation_accumulation,    
                        'violation_accumulation2' => $violation_accumulation2,     
        
                        'created_at' => $date_of_violation,
                        'updated_at' => $date_of_violation,
                        
                        'alphabet_id' => $x['alphabet_id'],           
                        'signature_id' => $signature_id,    
                        'employee_id' => $employee_id
                    ];
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

    public function import() 
    {
        // Excel::import(new ViolationsImport, request()->file('file'));        
        
        $rows =  Excel::toArray(new ViolationsImport, request()->file('file'));
        foreach($rows as $row):
            $jumlahTotal = 0;
            foreach($row as $x):
                //Memastikan tidak ada nilai null NIK
                          // 27 ayat (3) huruf "a"
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
                        if($date_of_violation == 'false'){
                            return redirect('/hiviolations')->with('danger', 'Data Karyawan Mulai dari baris '. floor($x['number_of_employees']) . ' Format Tanggal date_of_violation salah. Pastikan kolom date dengan performatan date yang benar !');
                        }
    
                        $reporting_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['reporting_date']);
                        if($date_of_violation == 'false'){
                            return redirect('/hiviolations')->with('danger', 'Data Karyawan Mulai dari baris '. floor($x['number_of_employees']) . ' Format Tanggal reporting_date salah. Pastikan kolom date dengan performatan date yang benar !');
                        }
    
                        $datev = new $date_of_violation;
                        $dater = new $reporting_date;
                        $resultv = $datev->format('Y-m-d');
                        $resultr = $dater->format('Y-m-d');
                        // $alphabet_id = floor($x['alphabet_id']);                  
                    
                        $sel_num_vio = DB::table('violations')
                            ->where('employee_id', $employee->id)
                            ->where('violation_status', '!=', 'cancel')
                            ->count();

                        if($sel_num_vio < 1){
                            $sta_viol = 'notactive';
                            $type_viol = 'notviolation';
                            $last_accumulation = 0;

                        }else{
                            $sel_vio = DB::table('violations')
                                ->where('employee_id', $employee->id)
                                ->where('violation_status', '!=', 'cancel')
                                ->latest()
                                ->first();

                            $date_str_reporting_date = strtotime(date('Y-m-d'));
                            $date_str_date_end_violation_lasst = strtotime($sel_vio->date_end_violation);
                            $differencs_date = $date_str_date_end_violation_lasst - $date_str_reporting_date;
                
                            if($differencs_date <= 0){
                                $sta_viol = 'notactive';
                                $type_viol = 'notviolation';
                                $last_accumulation = 0;
                            }else{
                                if($sel_vio->violation_status == 'cancel'){
                                    $sta_viol = 'notactive';
                                    $type_viol = 'notviolation';
                                    $last_accumulation = 0;
                                }elseif($sel_vio->violation_status == 'active'){
                                    $sta_viol = $sel_vio->violation_status;
                                    $type_viol = $sel_vio->type_of_violation;
                                    $last_accumulation = $sel_vio->accumulation;
                                }else{
                                    $sta_viol = 'notactive';
                                    $type_viol = 'notviolation';
                                    $last_accumulation = 0;
                                }
                            }
                        }
    
                        // $alphabet_id = floor($x['alphabet_id']);
                        $cek_alphabet = is_numeric($x['alphabet_id']);
                        if($cek_alphabet == 1){
                            $alphabet_id = floor($x['alphabet_id']);
                        }else{
                            return redirect('/hiviolations')->with('danger', 'Data Karyawan Mulai dari baris '. floor($x['number_of_employees']) . ' Format alphabet_id salah. Pastikan kolom alphabet dengan performatan numeric yang benar !');
                        }
                       
                        $last_vio = $sta_viol;
                        $status_violant_last = $sta_viol;
                        // $accumulation = $last_accumulation;
                        $last_type = $type_viol;
                        
                        $bul = date('m');
                        $yaer_y_bul = date('Y');
                        $num_sp = DB::table('violations')
                            ->whereMonth('date_of_violation', $bul)
                            ->whereYear('date_of_violation',  $yaer_y_bul)  
                            ->count();
            
                        if($num_sp < 1){
                            $no_sp = $x['no'];
                            
                        }elseif($num_sp > 0){
                            $last_sp = DB::table('violations')
                                ->whereMonth('date_of_violation', $bul)
                                ->whereYear('date_of_violation',  $yaer_y_bul)  
                                ->orderByDesc('no_violation')
                                ->first();
                                // $no_sp = $last_sp->no_violation + floor($x['no']);
                                $no_sp = $last_sp->no_violation + 1;
                        }
    
                   
                        $date_violation = new \DateTime($resultr.'00:00:00' );
    
                        $date_year = date_format($date_violation, "Y"); //for Display Year
                        $date_month =  date_format($date_violation, "m"); //for Display Month
                        $date_day = date_format($date_violation, "d"); //for Display Date
                
                    
            
                        // $tahun = YEAR($date_of_violation);
            
                        // Prints October 3, 1975 was on a Thursday
                        //   echo "Oct 3, 1975 was on a ".gmdate("l", mktime(0,0,0,$date_day,$date_month,$date_year)) . "<br>";
            
                        // $day = gmdate($resultv, time()+60*60*7);
                        $day = date("l", gmmktime(0,0,0, $date_month, $date_day, $date_year));
            
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
    
                        //LOGIKAN PENENTUAN MENDAPATKAN PELANGGARAN
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
    
                            require 'violationinsert.php';
                        }else{
    
                            $num_vio_accumulation3 = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('violation_accumulation', '!=',  null) 
                                ->where('violation_accumulation2', '!=',  null) 
                                ->where('violation_accumulation3', '!=',  null) 
                                ->where('alphabet_accumulation', '!=',  null) 
                                ->where('violation_status', 'active') 
                                ->latest()                       
                                ->count();
    
                            if($num_vio_accumulation3 > 0){
    
                                // GET LOGIKA AKUMULASI KEEMPAT
                                $get_first_vio_accumulation3 = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('violation_accumulation', '!=',  null) 
                                    ->where('violation_accumulation2', '!=',  null) 
                                    ->where('violation_accumulation3', '!=',  null) 
                                    ->where('alphabet_accumulation', '!=',  null) 
                                    ->where('violation_status', 'active') 
                                    ->latest()                       
                                    ->first();
    
                                $get_num_vio_accumulation3 = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('violation_accumulation', $get_first_vio_accumulation3->id) 
                                    ->where('violation_status', 'active')       
                                    ->count();
    
                                if($get_num_vio_accumulation3 > 0){
                                    // GET LOGIKA AKUMULASI PERINGATAN LISAN
                                    require 'GetViolationArticle.php';
                                    $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                        ->latest()                       
                                        ->count();
                                    if($cek_pelanggran_sebelumnya2 > 0){
                                        $pelanggran_sebelumnya2 = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                            ->latest()                       
                                            ->first();
                                        $cek_pelanggran_sebelumnya3 = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                            ->latest()                       
                                            ->count(); 
                                        if($cek_pelanggran_sebelumnya3 > 0){
                                            $pelanggran_sebelumnya3 = DB::table('violations')
                                                ->where('employee_id',  $employee_id) 
                                                ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                                ->latest()                       
                                                ->first();   
                                                $pelanggran_sebelumnya3_id = $pelanggran_sebelumnya3->id;
                                        }else{
                                            $pelanggran_sebelumnya3_id = null;
                                        }
                                        $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                                    }else{
                                        $pelanggran_sebelumnya2_id = null;
                                        $pelanggran_sebelumnya3_id = null;
                                    }                               
                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                    $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                                    $violation_accumulation3 = $pelanggran_sebelumnya3_id;  
                                    require 'violationinsert.php';
                                }else{
                                    // BATAS AKUMULASI
    
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
                                        $get_first_vio_accumulation2 = DB::table('violations')
                                            ->where('violation_accumulation', '!=',  null) 
                                            ->where('violation_accumulation2', '!=',  null) 
                                            ->where('alphabet_accumulation', '!=',  null) 
                                            ->where('violation_status', 'active') 
                                            ->latest()                       
                                            ->first();
                            
                                        $get_num_vio_accumulation2 = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('violation_accumulation', $get_first_vio_accumulation2->id) 
                                            ->where('violation_status', 'active')       
                                            ->count();
    
                                        if($get_num_vio_accumulation2 > 0){
                                            require 'GetViolationArticle.php';
    
                                            $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                                ->where('employee_id',  $employee_id) 
                                                ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                ->latest()                       
                                                ->count();
                                            if($cek_pelanggran_sebelumnya2 > 0){
                                                $pelanggran_sebelumnya2 = DB::table('violations')
                                                    ->where('employee_id',  $employee_id) 
                                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                    ->latest()                       
                                                    ->first();
                                                $cek_pelanggran_sebelumnya3 = DB::table('violations')
                                                    ->where('employee_id',  $employee_id) 
                                                    ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                                    ->latest()                       
                                                    ->count(); 
                                                if($cek_pelanggran_sebelumnya3 > 0){
                                                    $pelanggran_sebelumnya3 = DB::table('violations')
                                                        ->where('employee_id',  $employee_id) 
                                                        ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                                        ->latest()                       
                                                        ->first();   
                                                        $pelanggran_sebelumnya3_id = $pelanggran_sebelumnya3->id;
                                                }else{
                                                    $pelanggran_sebelumnya3_id = null;
                                                }
                                                $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                                            }else{
                                                $pelanggran_sebelumnya2_id = null;
                                                $pelanggran_sebelumnya3_id = null;
                                            }                               
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                                            $violation_accumulation3 = $pelanggran_sebelumnya3_id;  
          
                                            require 'violationinsert.php';
                                        }else{
    
                                            // BATAS AKUMULASI 
                                            $num_vio_accumulation = DB::table('violations')
                                                ->where('employee_id',  $employee_id) 
                                                ->where('violation_accumulation', '!=',  null) 
                                                ->where('alphabet_accumulation', '!=',  null) 
                                                ->where('violation_status', 'active') 
                                                ->latest()                       
                                                ->count();
                    
                                            if($num_vio_accumulation > 0){
                                
                                                $get_first_vio_accumulation = DB::table('violations')
                                                    ->where('employee_id',  $employee_id) 
                                                    ->where('violation_accumulation', '!=',  null) 
                                                    ->where('alphabet_accumulation', '!=',  null) 
                                                    ->where('violation_status', 'active') 
                                                    ->latest()                       
                                                    ->first();
                                
                                                $get_num_vio_accumulation = DB::table('violations')
                                                    ->where('employee_id',  $employee_id) 
                                                    ->where('id', $get_first_vio_accumulation->id) 
                                                    ->where('violation_status', 'active')       
                                                    ->count();
                                
                                                    if($get_num_vio_accumulation > 0){
                                
                                                        require 'GetViolationArticle.php';
                                                        $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                                            ->where('employee_id',  $employee_id) 
                                                            ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                            ->latest()                       
                                                            ->count();
    
                                                        if($cek_pelanggran_sebelumnya2 > 0){
                                                            $pelanggran_sebelumnya2 = DB::table('violations')
                                                            ->where('employee_id',  $employee_id) 
                                                            ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                            ->latest()                       
                                                            ->first();
                                                            $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                                                        }else{
                                                            $pelanggran_sebelumnya2_id = null;
                                                        }
                                                        
                                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                        $violation_accumulation2 = $pelanggran_sebelumnya2_id;  
                                                        $violation_accumulation3 = null;  
                                                        require 'violationinsert.php';
                                                    }else{
                                                        //LOGIKA AKUMULSAI PERTAMA
                                                        require 'GetViolationArticle.php';
                                                        
                                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                        $violation_accumulation2 = null;    
                                                        $violation_accumulation3 = null;  
                                                        require 'violationinsert.php';
                                                    }
                                
                                            }else{
                                                //LOGIKA AKUMULSAI PERTAMA
                                                require 'GetViolationArticle.php';
                                                
                                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                $violation_accumulation2 = null;    
                                                $violation_accumulation3 = null;  
                                                require 'violationinsert.php';
                                            }
                                        }
                    
                                }else{
    
                                    $num_vio_accumulation = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('violation_accumulation', '!=',  null) 
                                        ->where('alphabet_accumulation', '!=',  null) 
                                        ->where('violation_status', 'active') 
                                        ->latest()                       
                                        ->count();
                    
                                    if($num_vio_accumulation > 0){
                        
                                        $get_first_vio_accumulation = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('violation_accumulation', '!=',  null) 
                                            ->where('alphabet_accumulation', '!=',  null) 
                                            ->where('violation_status', 'active') 
                                            ->latest()                       
                                            ->first();
                        
                                        $get_num_vio_accumulation = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id', $get_first_vio_accumulation->id) 
                                            ->where('violation_status', 'active')       
                                            ->count();
                        
                                            if($get_num_vio_accumulation > 0){
                        
                                                require 'GetViolationArticle.php';
                                                $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                                    ->where('employee_id',  $employee_id) 
                                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                    ->latest()                       
                                                    ->count();
    
                                                if($cek_pelanggran_sebelumnya2 > 0){
                                                    $pelanggran_sebelumnya2 = DB::table('violations')
                                                    ->where('employee_id',  $employee_id) 
                                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                    ->latest()                       
                                                    ->first();
                                                    $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                                                }else{
                                                    $pelanggran_sebelumnya2_id = null;
                                                }
                                                
                                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                                                $violation_accumulation3 = null;  
                                                require 'violationinsert.php';
                                            }else{
                                                //LOGIKA AKUMULSAI PERTAMA
                                                require 'GetViolationArticle.php';
                                                
                                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                $violation_accumulation2 = null;    
                                                $violation_accumulation3 = null;  
                                                require 'violationinsert.php';
                                            }
                        
                                    }else{
                                        //LOGIKA AKUMULSAI PERTAMA
                                        require 'GetViolationArticle.php';
                                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = null;    
                                        $violation_accumulation3 = null;  
                                        require 'violationinsert.php';
                                    }
                                }
                            }
            
                    }else{
                        // BATAS AKUMULASI
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
                            $get_first_vio_accumulation2 = DB::table('violations')
                                ->where('violation_accumulation', '!=',  null) 
                                ->where('violation_accumulation2', '!=',  null) 
                                ->where('alphabet_accumulation', '!=',  null) 
                                ->where('violation_status', 'active') 
                                ->latest()                       
                                ->first();
                
                            $get_num_vio_accumulation2 = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('violation_accumulation', $get_first_vio_accumulation2->id) 
                                ->where('violation_status', 'active')       
                                ->count();
    
                                if($get_num_vio_accumulation2 > 0){
                                    require 'GetViolationArticle.php';
            
                                    $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                        ->latest()                       
                                        ->count();
                                    if($cek_pelanggran_sebelumnya2 > 0){
                                        $pelanggran_sebelumnya2 = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                            ->latest()                       
                                            ->first();
                                        $cek_pelanggran_sebelumnya3 = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                            ->latest()                       
                                            ->count(); 
                                        if($cek_pelanggran_sebelumnya3 > 0){
                                            $pelanggran_sebelumnya3 = DB::table('violations')
                                                ->where('employee_id',  $employee_id) 
                                                ->where('id',  $pelanggran_sebelumnya2->violation_accumulation) 
                                                ->latest()                       
                                                ->first();   
                                                $pelanggran_sebelumnya3_id = $pelanggran_sebelumnya3->id;
                                        }else{
                                            $pelanggran_sebelumnya3_id = null;
                                        }
                                        $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                                    }else{
                                        $pelanggran_sebelumnya2_id = null;
                                        $pelanggran_sebelumnya3_id = null;
                                    }                               
                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                    $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                                    $violation_accumulation3 = $pelanggran_sebelumnya3_id;  
     
                                    require 'violationinsert.php';
                                }else{
    
                                    // BATAS AKUMULASI 
    
                                    $num_vio_accumulation = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('violation_accumulation', '!=',  null) 
                                        ->where('alphabet_accumulation', '!=',  null) 
                                        ->where('violation_status', 'active') 
                                        ->latest()                       
                                        ->count();
                        
                                    if($num_vio_accumulation > 0){
                        
                                        $get_first_vio_accumulation = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('violation_accumulation', '!=',  null) 
                                            ->where('alphabet_accumulation', '!=',  null) 
                                            ->where('violation_status', 'active') 
                                            ->latest()                       
                                            ->first();
                    
                                        $get_num_vio_accumulation = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id', $get_first_vio_accumulation->id) 
                                            ->where('violation_status', 'active')       
                                            ->count();
                        
                                            if($get_num_vio_accumulation > 0){
                        
                                                require 'GetViolationArticle.php';
                                                $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                                    ->where('employee_id',  $employee_id) 
                                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                    ->latest()                       
                                                    ->count();
    
                                                if($cek_pelanggran_sebelumnya2 > 0){
                                                    $pelanggran_sebelumnya2 = DB::table('violations')
                                                    ->where('employee_id',  $employee_id) 
                                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                    ->latest()                       
                                                    ->first();
                                                    $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                                                }else{
                                                    $pelanggran_sebelumnya2_id = null;
                                                }
                                                
                                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                                                $violation_accumulation3 = null;  
                                                require 'violationinsert.php';
                                            }else{
                                                //LOGIKA AKUMULSAI PERTAMA
                                                require 'GetViolationArticle.php';
                                                
                                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                $violation_accumulation2 = null;    
                                                $violation_accumulation3 = null;  
                                            }
                    
                                        }else{
                                            //LOGIKA AKUMULSAI PERTAMA
                                            require 'GetViolationArticle.php';
                                            
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = null;    
                                            $violation_accumulation3 = null; 
                                            require 'violationinsert.php'; 
                                        }
                                    }
                    
                                }else{
    
                                    $num_vio_accumulation = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('violation_accumulation', '!=',  null) 
                                        ->where('alphabet_accumulation', '!=',  null) 
                                        ->where('violation_status', 'active') 
                                        ->latest()                       
                                        ->count();
            
                                    if($num_vio_accumulation > 0){
                        
                                        $get_first_vio_accumulation = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('violation_accumulation', '!=',  null) 
                                            ->where('alphabet_accumulation', '!=',  null) 
                                            ->where('violation_status', 'active') 
                                            ->latest()                       
                                            ->first();
                        
                                        $get_num_vio_accumulation = DB::table('violations')
                                            ->where('employee_id',  $employee_id) 
                                            ->where('id', $get_first_vio_accumulation->id) 
                                            ->where('violation_status', 'active')       
                                            ->count();
                
                                        if($get_num_vio_accumulation > 0){
                    
                                            require 'GetViolationArticle.php';
                                            $cek_pelanggran_sebelumnya2 = DB::table('violations')
                                                ->where('employee_id',  $employee_id) 
                                                ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                ->latest()                       
                                                ->count();
    
                                            if($cek_pelanggran_sebelumnya2 > 0){
                                                $pelanggran_sebelumnya2 = DB::table('violations')
                                                ->where('employee_id',  $employee_id) 
                                                ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                                ->latest()                       
                                                ->first();
                                                $pelanggran_sebelumnya2_id = $pelanggran_sebelumnya2->id;
                                            }else{
                                                $pelanggran_sebelumnya2_id = null;
                                            }
                                            
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = $pelanggran_sebelumnya2_id;    
                                            $violation_accumulation3 = null;  
                                            require 'violationinsert.php';
                                        }else{
                                            //LOGIKA AKUMULSAI PERTAMA
                                            require 'GetViolationArticle.php';
                                            
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = null;    
                                            $violation_accumulation3 = null;  
                                            require 'violationinsert.php';
                                        }
                
                                    }else{
                                        //LOGIKA AKUMULSAI PERTAMA
                                        require 'GetViolationArticle.php';
                                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = null;    
                                        $violation_accumulation3 = null;  
                                        require 'violationinsert.php';
                                    }
                                
                                }
                            }
                        } 
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
        
        return redirect('/hiviolations')->with('success', 'Data Pelanggaran Berhasil di tambahkan!');

    }

    public function violationmigrations(){

        // Excel::import(new ViolationmigrationsImport, request()->file('file'));

        $rows =  Excel::toArray(new ViolationmigrationImport, request()->file('file'));

        foreach($rows as $row):
            foreach($row as $x):

                if($x['employee_id'] == NULL){

                }else{
               

                    $date_of_violation_i = $x['date_of_violation'];
                    if($date_of_violation_i == null){
                        $date_of_violation = NULL;
                    }else{
                        $date_of_violation = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['date_of_violation']);
                    }
                    if($date_of_violation == 'false'){
                        return redirect('/hiviolations')->with('danger', 'Data Pelanggran Mulai dari baris '. $x['employee_id'] . ' Format Tanggal salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    $date_end_violation_i = $x['date_end_violation'];
                    if($date_end_violation_i == null){
                        $date_end_violation = NULL;
                    }else{
                        $date_end_violation = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['date_end_violation']);
                    }
                    if($date_end_violation == 'false'){
                        return redirect('/hiviolations')->with('danger', 'Data Pelanggran Mulai dari baris '. $x['employee_id'] . ' Format Tanggal salah. Pastikan kolom date dengan performatan date yang benar !');
                    }
                    
                    $reporting_date_i = $x['reporting_date'];
                    if($reporting_date_i == null){
                        $reporting_date = NULL;
                    }else{
                        $reporting_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['reporting_date']);
                    }
                    if($reporting_date == 'false'){
                        return redirect('/hiviolations')->with('danger', 'Data Pelanggran Mulai dari baris '. $x['employee_id'] . ' Format Tanggal salah. Pastikan kolom date dengan performatan date yang benar !');
                    }

                    DB::table('violationmigrations')->insert([
                        "employee_id" => floor($x['employee_id']),	
                        "date_of_violation" => $date_of_violation,
                        "date_end_violation" => $date_end_violation,
                        "reporting_date"  =>  $reporting_date,
                        "no_violation" => floor($x['no_violation']),
                        "format" => "SP-HRD",
                        "month_of_violation" => floor($x['month_of_violation']),
                        "reporting_day" => $x['reporting_day'],
                        "job_level"  => $x['job_level'],
                        "department"   => $x['department'],
                        "other_information"  => $x['other_information'],
                        "violation_status"  => $x['violation_status'],
                        "type_of_violation"  => $x['type_of_violation'],
                        "alphabet_id"  => $x['alphabet_id'],
                        'alphabet_accumulation' => $alphabet_accumulation,    
                        "violation_accumulation"  => $x['violation_accumulation'],
                        "violation_accumulation2"  => $x['violation_accumulation2'],
                        'violation_accumulation3' => $violation_accumulation3,   

                        "violation_ROM" => $x['violation_rom'],
                        "signature_id"  => floor($x['signature_id'])
                    ]);

            }

            endforeach;
        endforeach;


        return redirect('/hiviolations');
    }

    public function export(){
        return Excel::download(new ViolationsExport, 'Master_Pelanggaran.xlsx');        
    }


    public function get_type_hiviolation(Request $request)
    {

        //ambil data employee_id, status_violant_last, violation_now, violation_id
        $violation_id = $request->violation_id;
        $employee_id = $request->id_emp;
        $status_violant_last = $request->status_violant_last;
        $violation_now = $request->violation_now;
        $last_type = $request->last_type;
        $last_accumulation = $request->last_accumulation;

        // Mencari pelanggaran saat ini
        $sel_alphabet = DB::table('alphabets')->find($request->violation_now);
        $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
        $sel_article = DB::table('articles')->find($sel_paragraph->article_id);
       
        $sel_paragraph_type_of_verse = $sel_paragraph->type_of_verse;

        // $status_type_violation = $sel_paragraph->type_of_verse;
        // $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet.'" ' .  $sel_alphabet->alphabet_sound;
        
        // $remainder1 = '-';
        // $remainder2 = '';
                   
        // $data = [ $status_type_violation, $pasal_yang_dilanggar, $remainder1, $remainder2];


        // LOGIKA MENAMPILKAN DATA PASAL DAN PASAL DELIK
        if($status_violant_last == 'notactive' OR $last_type == 'notviolation'){

            $status_type_violation = $sel_paragraph->type_of_verse;
            $pasal_yang_dilanggar = 'Perjanjian Kerja Bersama Pasal '. $sel_article->article.' ayat ('.$sel_paragraph->paragraph .') huruf "'. $sel_alphabet->alphabet.'" ' .  $sel_alphabet->alphabet_sound;
            
            $remainder1 = '-';
            $remainder2 = '';
                       
            $data = [ $status_type_violation, $pasal_yang_dilanggar, $remainder1, $remainder2];
            
        }else{

            $num_vio_accumulation3 = DB::table('violations')
                ->where('employee_id',  $employee_id) 
                ->where('violation_accumulation', '!=',  null) 
                ->where('violation_accumulation2', '!=',  null) 
                ->where('violation_accumulation3', '!=',  null) 
                ->where('alphabet_accumulation', '!=',  null) 
                ->where('violation_status', 'active') 
                ->where('id', '<', $violation_id) 
                ->latest()                       
                ->count();

            if($num_vio_accumulation3 > 0){
                                
                // GET LOGIKA AKUMULASI KEEMPAT
                $get_first_vio_accumulation3 = DB::table('violations')
                    ->where('employee_id',  $employee_id) 
                    ->where('violation_accumulation', '!=',  null) 
                    ->where('violation_accumulation2', '!=',  null) 
                    ->where('violation_accumulation3', '!=',  null) 
                    ->where('alphabet_accumulation', '!=',  null) 
                    ->where('violation_status', 'active') 
                    ->where('id', '<', $violation_id) 
                    ->latest()                       
                    ->first();

                $get_num_vio_accumulation3 = DB::table('violations')
                    ->where('employee_id',  $employee_id) 
                    ->where('violation_accumulation', $get_first_vio_accumulation3->id) 
                    ->where('violation_status', 'active')       
                    ->count();

                if($get_num_vio_accumulation3 > 0){
                
                    // GET LOGIKA AKUMULASI PERINGATAN LISAN
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

                    require_once 'Violationjsondatas.php';
                }else{
                    // BATAS AKUMULASI
                    // CARI PELANGGARAN AKUMULASI 3               
                    $num_vio_accumulation2 = DB::table('violations')
                        ->where('employee_id',  $employee_id) 
                        ->where('violation_accumulation', '!=',  null) 
                        ->where('violation_accumulation2', '!=',  null) 
                        ->where('alphabet_accumulation', '!=',  null) 
                        ->where('violation_status', 'active') 
                        ->where('id', '<', $violation_id)
                        ->latest()                       
                        ->count();
                    if($num_vio_accumulation2 > 0){

                        // LOGIKA AKUMULSI KETIGA
                        $get_first_vio_accumulation2 = DB::table('violations')
                            ->where('violation_accumulation', '!=',  null) 
                            ->where('violation_accumulation2', '!=',  null) 
                            ->where('alphabet_accumulation', '!=',  null) 
                            ->where('violation_status', 'active') 
                            ->where('id', '<', $violation_id)
                            ->latest()                       
                            ->first();

                        $get_num_vio_accumulation2 = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->where('violation_accumulation', $get_first_vio_accumulation2->id) 
                            ->where('violation_status', 'active')       
                            ->count(); 
                        
                        if($get_num_vio_accumulation2  > 0){

                            require_once 'GetAccumulation.php';

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
                                require_once 'Violationjsondatas.php';
                        }else{

                            $num_vio_accumulation = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('violation_accumulation', '!=',  NULL) 
                                ->where('alphabet_accumulation', '!=',  NULL) 
                                ->where('violation_status', 'active') 
                                ->where('id', '<', $violation_id)
                                ->latest()                       
                                ->count();

                            if($num_vio_accumulation > 0){
                                //LOGIKA AKUMULASI KEDUA

                                $get_first_vio_accumulation = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('violation_accumulation', '!=',  null) 
                                    ->where('alphabet_accumulation', '!=',  null) 
                                    ->where('violation_status', 'active') 
                                    ->where('id', '<', $violation_id)
                                    ->latest()                       
                                    ->first();

                                $get_num_vio_accumulation = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('id', $get_first_vio_accumulation->id) 
                                    ->where('violation_status', 'active')       
                                    ->count();

                                if($get_num_vio_accumulation > 0){

                                    require_once 'GetAccumulation.php';

                                    $pelanggran_sebelumnya2 = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                        ->latest()                       
                                        ->first();

                                        require_once 'Violationjsondatas.php';
                                    
                                }else{
                                    //LOGIKA AKUMULSAI PERTAMA
                                    require_once 'GetAccumulation.php';                                          

                                    require_once 'Violationjsondata.php';   
                                }
                            }else{
                                //LOGIKA AKUMULSAI PERTAMA
                                require_once 'GetAccumulation.php';                                          

                                require_once 'Violationjsondata.php';    
                            }
                        }

                    }else{
                        $num_vio_accumulation = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->where('violation_accumulation', '!=',  NULL) 
                            ->where('alphabet_accumulation', '!=',  NULL) 
                            ->where('violation_status', 'active') 
                            ->where('id', '<', $violation_id)
                            ->latest()                       
                            ->count();

                        if($num_vio_accumulation > 0){
                            //LOGIKA AKUMULASI KEDUA

                            $get_first_vio_accumulation = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('violation_accumulation', '!=',  null) 
                                ->where('alphabet_accumulation', '!=',  null) 
                                ->where('violation_status', 'active') 
                                ->where('id', '<', $violation_id)
                                ->latest()                       
                                ->first();

                            $get_num_vio_accumulation = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('id', $get_first_vio_accumulation->id) 
                                ->where('violation_status', 'active')       
                                ->count();

                                if($get_num_vio_accumulation > 0){

                                    require_once 'GetAccumulation.php';

                                    $pelanggran_sebelumnya2 = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                        ->latest()                       
                                        ->first();
                                                
                                        require_once 'Violationjsondatas.php';   
                                }else{
                                    //LOGIKA AKUMULSAI PERTAMA
                                    require_once 'GetAccumulation.php';                                          

                                    require_once 'Violationjsondata.php';   
                                }
                        }else{
                            //LOGIKA AKUMULSAI PERTAMA
                            require_once 'GetAccumulation.php'; 

                            require_once 'Violationjsondata.php';                                         
                        }
                    }
                }
            }else{
                // BATAS AKUMULASI
                // CARI PELANGGARAN AKUMULASI 3               
                $num_vio_accumulation2 = DB::table('violations')
                    ->where('employee_id',  $employee_id) 
                    ->where('violation_accumulation', '!=',  null) 
                    ->where('violation_accumulation2', '!=',  null) 
                    ->where('alphabet_accumulation', '!=',  null) 
                    ->where('violation_status', 'active') 
                    ->where('id', '<', $violation_id)
                    ->latest()                       
                    ->count();
                if($num_vio_accumulation2 > 0){

                    // LOGIKA AKUMULSI KETIGA
                    $get_first_vio_accumulation2 = DB::table('violations')
                        ->where('violation_accumulation', '!=',  null) 
                        ->where('violation_accumulation2', '!=',  null) 
                        ->where('alphabet_accumulation', '!=',  null) 
                        ->where('violation_status', 'active') 
                        ->where('id', '<', $violation_id)
                        ->latest()                       
                        ->first();

                    $get_num_vio_accumulation2 = DB::table('violations')
                        ->where('employee_id',  $employee_id) 
                        ->where('violation_accumulation', $get_first_vio_accumulation2->id) 
                        ->where('violation_status', 'active')       
                        ->count(); 
                    
                    if($get_num_vio_accumulation2  > 0){

                        require_once 'GetAccumulation.php';

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
                            require_once 'Violationjsondatas.php';
                    }else{

                        $num_vio_accumulation = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->where('violation_accumulation', '!=',  NULL) 
                            ->where('alphabet_accumulation', '!=',  NULL) 
                            ->where('violation_status', 'active') 
                            ->where('id', '<', $violation_id)
                            ->latest()                       
                            ->count();

                        if($num_vio_accumulation > 0){
                            //LOGIKA AKUMULASI KEDUA

                            $get_first_vio_accumulation = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('violation_accumulation', '!=',  null) 
                                ->where('alphabet_accumulation', '!=',  null) 
                                ->where('violation_status', 'active') 
                                ->where('id', '<', $violation_id)
                                ->latest()                       
                                ->first();

                            $get_num_vio_accumulation = DB::table('violations')
                                ->where('employee_id',  $employee_id) 
                                ->where('id', $get_first_vio_accumulation->id) 
                                ->where('violation_status', 'active')       
                                ->count();

                            if($get_num_vio_accumulation > 0){

                                require_once 'GetAccumulation.php';

                                $pelanggran_sebelumnya2 = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                    ->latest()                       
                                    ->first();

                                    require_once 'Violationjsondatas.php';
                                
                            }else{
                                //LOGIKA AKUMULSAI PERTAMA
                                require_once 'GetAccumulation.php';                                          

                                require_once 'Violationjsondata.php';   
                            }
                        }else{
                            //LOGIKA AKUMULSAI PERTAMA
                            require_once 'GetAccumulation.php';                                          

                            require_once 'Violationjsondata.php';    
                        }
                    }

                }else{
                    $num_vio_accumulation = DB::table('violations')
                        ->where('employee_id',  $employee_id) 
                        ->where('violation_accumulation', '!=',  NULL) 
                        ->where('alphabet_accumulation', '!=',  NULL) 
                        ->where('violation_status', 'active') 
                        ->where('id', '<', $violation_id)
                        ->latest()                       
                        ->count();

                    if($num_vio_accumulation > 0){
                        //LOGIKA AKUMULASI KEDUA

                        $get_first_vio_accumulation = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->where('violation_accumulation', '!=',  null) 
                            ->where('alphabet_accumulation', '!=',  null) 
                            ->where('violation_status', 'active') 
                            ->where('id', '<', $violation_id)
                            ->latest()                       
                            ->first();

                        $get_num_vio_accumulation = DB::table('violations')
                            ->where('employee_id',  $employee_id) 
                            ->where('id', $get_first_vio_accumulation->id) 
                            ->where('violation_status', 'active')       
                            ->where('id', '<', $violation_id)
                            ->count();

                            if($get_num_vio_accumulation > 0){

                                require_once 'GetAccumulation.php';

                                $pelanggran_sebelumnya2 = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                    ->where('id', '<', $violation_id)
                                    ->latest()                       
                                    ->first();
                                            
                                    require_once 'Violationjsondatas.php';   
                                
                            }else{
                                //LOGIKA AKUMULSAI PERTAMA
                                require_once 'GetAccumulation.php';                                          

                                require_once 'Violationjsondata.php';   
                            }
                    }else{
                        //LOGIKA AKUMULSAI PERTAMA
                        require_once 'GetAccumulation.php'; 

                        require_once 'Violationjsondata.php';                                         

                    }

                }
                
            }
        }


        return response()->json($data);
    }
}
