<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use Illuminate\Support\Collection;

use Illuminate\Support\Arr;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use App\Models\Alphabet;
use App\Models\Article;
use App\Models\Paragraph;
use App\Models\Violation;

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

        if(request('search')){
            $employees->where('number_of_employees', 'like', '%' . request('search') . '%')
                      ->orWhere('name', 'like', '%' . request('search') . '%')
                      ->orWhere('national_id', 'like', '%' . request('search') . '%');
        }
        
        return view('hi.violations.index', [
            'employees' => $employees->paginate(10)->withQuerystring(),
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
        $reporting_date = $request->reporting_date;

        $alphabet_id = $request->alphabet_id;
        $last_vio = $request->last_vio;
        $last_accumulation = $request->last_accumulation;
        // $status_violant_last = $request->last_vio;
        $last_type = $request->last_type;


        //MEMBUAT INPUTAN OTOMATIS SURAT
        // NO SP 001/SP-HRD/IV/2022

        $month_m = date('m');

        $num_no_sp = DB::table('violations')
          ->whereMonth('date_of_violation',  $month_m)
          ->count();
       
        if($num_no_sp < 1){
            $no_sp = 1;
        }elseif($num_no_sp > 0){
            $sel_no_sp = DB::table('violations')
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
          
      
        $data = [
            'date_of_violation' => $date_of_violation,     
            'date_end_violation' => $date_end_violation,     
            'no_violation' => $no_sp,   
            'format' => 'SP-HRD',    
            'month_of_violation' => $month_n,     
            'violation_ROM' => $ROM,   
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

            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
            'alphabet_id' => $alphabet_id,           
            'signature_id' => $signature_id,    
            'employee_id' => $employee_id
        ];

        DB::table('violations')->insert($data);

        $select_employee = DB::table('employees')->find($employee_id);
        $remark = "menambahkan pelanggaran ".$select_employee->number_of_employees;
        $action = "add";

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $violation = DB::table('violations')->where('id', $id)
                    ->first();

        return view('hi.violations.cetak_sp', [
            
            
            'violation' => $violation
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
        $employee = DB::table('employees')->where('id', $id)
                    ->first();

        $alphabet =DB::table('alphabets')
            // ->where('employee_id', $id)
            ->get();


        $num_print_violationmigrations = DB::table('violationmigrations')
            ->where('employee_id',  $id)              
            ->count();

        $num_print_violations = DB::table('violations')
            ->where('employee_id',  $id)              
            ->count();
        
        if($num_print_violationmigrations > 0 AND $num_print_violations > 0){

            $print_violationmigrations = DB::table('violationmigrations')->where('employee_id', $id)->get();
                
            $print_violations = DB::table('violations')->where('employee_id', $id)->get();

            $array = Arr::collapse([$print_violationmigrations, $print_violations]); 
            
            function date_compare($a, $b)
            {
                $t1 = strtotime($a['reporting_date']);
                $t2 = strtotime($b['reporting_date']);
                return $t1 - $t2;
            }

            // usort($array, 'date_compare');

            $violation = $array;

        }elseif($num_print_violations == 0 AND $num_print_violationmigrations > 0){

            $print_violationmigrations = DB::table('violationmigrations')
                ->where('employee_id',  $id)              
                ->get();

            $violation = $print_violationmigrations;

        }elseif($num_print_violationmigrations == 0 AND $num_print_violations > 0){

            $print_violations = DB::table('violations')
                ->where('employee_id',  $id)              
                ->get();

            $violation = $print_violations;

        }elseif($num_print_violationmigrations == 0 AND $num_print_violations == 0){
            $violation = DB::table('violations')
                ->where('employee_id',  $id)              
                ->get();
        }else{
            $violation = DB::table('violations')
            ->where('employee_id',  $id)              
            ->get();
        }
      
        return view('hi.violations.edit', [
            
            'employee' => $employee,
            'violations' => DB::table('violations')->where('employee_id', $id)->get(),
            // 'violations' => $violation,
            'alphabets' => $alphabet,
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
        Violation::destroy($id);
        return redirect('hiviolation')->with('success', 'Data Pelanggaran Berhasil di hapus!');
        // ->with('success', 'Post has been deleted!');
    }


    public function get_type_violation(Request $request)
    {

        //ambil data employee_id, status_violant_last, violation_now, violation_id
        $employee_id = $request->id_emp;
        $status_violant_last = $request->status_violant_last;
        $violation_now = $request->violation_now;
        $last_type = $request->last_type;
        $last_accumulation = $request->last_accumulation;

        //Mencari pelanggaran saat ini
        $sel_alphabet = DB::table('alphabets')->find($request->violation_now);
        $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
        $sel_article = DB::table('articles')->find($sel_paragraph->article_id);
       
        $sel_paragraph_type_of_verse = $sel_paragraph->type_of_verse;

        //LOGIKA MENAMPILKAN DATA PASAL DAN PASAL DELIK
        
        //GET JIKA TIDAK ADA PELANGGARAN AKTIF
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
                                ->latest()                       
                                ->count();

                            if($num_vio_accumulation > 0){
                                //LOGIKA AKUMULASI KEDUA

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
                            ->latest()                       
                            ->count();

                        if($num_vio_accumulation > 0){
                            //LOGIKA AKUMULASI KEDUA

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
                            ->latest()                       
                            ->count();

                        if($num_vio_accumulation > 0){
                            //LOGIKA AKUMULASI KEDUA

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
                        ->latest()                       
                        ->count();

                    if($num_vio_accumulation > 0){
                        //LOGIKA AKUMULASI KEDUA

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
        }

        return response()->json($data);
    }


    public function list()
    {
        // $violations = Violation::oldest();
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
                 )
                ->orderByDesc('violations.id');

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


}