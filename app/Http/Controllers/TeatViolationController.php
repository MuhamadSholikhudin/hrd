<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ViolationsImport;
use App\Imports\ViolationsEditImport;
use App\Imports\ViolationmigrationImport;

use App\Exports\ViolationsExport;
use App\Exports\ViolationsEditExport;

use Illuminate\Support\Collection;

use Illuminate\Support\Arr;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use App\Models\Alphabet;
use App\Models\Article;
use App\Models\Paragraph;
use App\Models\Violation;


class TeatViolationController extends Controller
{
    //
    public function index(){
        echo "oke";
    }

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

        require 'GetViolationFormat.php';

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
                    require_once 'GetViolationArticleTest.php';

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
                                require_once 'GetViolationArticleTest.php';

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
                    
                                            require_once 'GetViolationArticleTest.php';
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
                                            require_once 'GetViolationArticleTest.php';
                                            
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = null;    
                                            $violation_accumulation3 = null;  
                                        }
                    
                                }else{
                                    //LOGIKA AKUMULSAI PERTAMA
                                    require_once 'GetViolationArticleTest.php';
                                    
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
                
                                        require_once 'GetViolationArticleTest.php';
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
                                        require_once 'GetViolationArticleTest.php';
                                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = null;    
                                        $violation_accumulation3 = null;  
                                    }
                
                            }else{
                                //LOGIKA AKUMULSAI PERTAMA
                                require_once 'GetViolationArticleTest.php';
                                
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
                            require_once 'GetViolationArticleTest.php';
    
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
                
                                        require_once 'GetViolationArticleTest.php';
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
                                        require_once 'GetViolationArticleTest.php';
                                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = null;    
                                        $violation_accumulation3 = null;  
                                    }
                
                            }else{
                                //LOGIKA AKUMULSAI PERTAMA
                                require_once 'GetViolationArticleTest.php';
                                
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
            
                                    require_once 'GetViolationArticleTest.php';
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
                                    require_once 'GetViolationArticleTest.php';
                                    
                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                    $violation_accumulation2 = null;    
                                    $violation_accumulation3 = null;  
                                }
            
                        }else{
                            //LOGIKA AKUMULSAI PERTAMA
                            require_once 'GetViolationArticleTest.php';
                            
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

        return redirect('/violations/' . $employee_id . '/testedit');
    }



    public function get_type_violation(Request $request)
    {
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

        // LOGIKA MENAMPILKAN DATA PASAL DAN PASAL DELIK
        
        // GET JIKA TIDAK ADA PELANGGARAN AKTIF
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
                    require_once 'GetAccumulationtest.php';

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

                            require_once 'GetAccumulationtest.php';

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

                                    require_once 'GetAccumulationtest.php';

                                    $pelanggran_sebelumnya2 = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                        ->latest()                       
                                        ->first();

                                        require_once 'Violationjsondatas.php';
                                    
                                }else{
                                    //LOGIKA AKUMULSAI PERTAMA
                                    require_once 'GetAccumulationtest.php';                                          

                                    require_once 'Violationjsondata.php';   
                                }
                            }else{
                                //LOGIKA AKUMULSAI PERTAMA
                                require_once 'GetAccumulationtest.php';                                          

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

                                    require_once 'GetAccumulationtest.php';

                                    $pelanggran_sebelumnya2 = DB::table('violations')
                                        ->where('employee_id',  $employee_id) 
                                        ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                        ->latest()                       
                                        ->first();
                                                
                                        require_once 'Violationjsondatas.php';   
                                }else{
                                    //LOGIKA AKUMULSAI PERTAMA
                                    require_once 'GetAccumulationtest.php';                                          

                                    require_once 'Violationjsondata.php';   
                                }
                        }else{
                            //LOGIKA AKUMULSAI PERTAMA
                            require_once 'GetAccumulationtest.php'; 

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

                        require_once 'GetAccumulationtest.php';

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

                                require_once 'GetAccumulationtest.php';

                                $pelanggran_sebelumnya2 = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                    ->latest()                       
                                    ->first();

                                    require_once 'Violationjsondatas.php';
                                
                            }else{
                                //LOGIKA AKUMULSAI PERTAMA
                                require_once 'GetAccumulationtest.php';                                          

                                require_once 'Violationjsondata.php';   
                            }
                        }else{
                            //LOGIKA AKUMULSAI PERTAMA
                            require_once 'GetAccumulationtest.php';                                          

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

                                require_once 'GetAccumulationtest.php';

                                $pelanggran_sebelumnya2 = DB::table('violations')
                                    ->where('employee_id',  $employee_id) 
                                    ->where('id', $pelanggran_sebelumnya->violation_accumulation) 
                                    ->latest()                       
                                    ->first();
                                            
                                    require_once 'Violationjsondatas.php';   
                                
                            }else{
                                //LOGIKA AKUMULSAI PERTAMA
                                require_once 'GetAccumulationtest.php';                                          

                                require_once 'Violationjsondata.php';   
                            }
                    }else{
                        //LOGIKA AKUMULSAI PERTAMA
                        require_once 'GetAccumulationtest.php'; 

                        require_once 'Violationjsondata.php';                                         

                    }

                }
                
            }
        }
        return response()->json($data);
    }

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
                    require_once 'GetViolationArticleUpdateTest.php';

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
                                require_once 'GetViolationArticleUpdateTest.php';

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
                    
                                            require_once 'GetViolationArticleUpdateTest.php';
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
                                            require_once 'GetViolationArticleUpdateTest.php';
                                            
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = null;    
                                            $violation_accumulation3 = null;  
                                        }
                    
                                }else{
                                    //LOGIKA AKUMULSAI PERTAMA
                                    require_once 'GetViolationArticleUpdateTest.php';
                                    
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
                
                                        require_once 'GetViolationArticleUpdateTest.php';
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
                                        require_once 'GetViolationArticleUpdateTest.php';
                                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = null;    
                                        $violation_accumulation3 = null;  
                                    }
                
                            }else{
                                //LOGIKA AKUMULSAI PERTAMA
                                require_once 'GetViolationArticleUpdateTest.php';
                                
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
                            require_once 'GetViolationArticleUpdateTest.php';
    
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
                
                                        require_once 'GetViolationArticleUpdateTest.php';
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
                                        require_once 'GetViolationArticleUpdateTest.php';
                                        
                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                        $violation_accumulation2 = null;    
                                        $violation_accumulation3 = null;  
                                    }
                
                            }else{
                                //LOGIKA AKUMULSAI PERTAMA
                                require_once 'GetViolationArticleUpdateTest.php';
                                
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
            
                                    require_once 'GetViolationArticleUpdateTest.php';
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
                                    require_once 'GetViolationArticleUpdateTest.php';
                                    
                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                    $violation_accumulation2 = null;    
                                    $violation_accumulation3 = null;  
                                }
            
                        }else{
                            //LOGIKA AKUMULSAI PERTAMA
                            require_once 'GetViolationArticleUpdateTest.php';
                            
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

    public function updateimport(){
        $rows =  Excel::toArray(new ViolationsEditImport, request()->file('file'));
        foreach($rows as $row):
            $jumlahTotal = 0;
            foreach($row as $x):
                //Memastikan tidak ada nilai null NIK
                          // 27 ayat (3) huruf "a"
                if($x['id'] == NULL){
    
                }else{ 
                    //Mencari Karywan
                    $search_violation = DB::table('violations')->where('id', floor($x['id']))->count();

                    if( $search_violation > 0){
                        $cari_vio = DB::table('violations')->find(floor($x['id']));

                        $violation_id = $cari_vio->id;
                        $no_violation = $cari_vio->no_violation;
                        $violation_ROM = $cari_vio->violation_ROM;
                        $job_level = $cari_vio->job_level;
                        $department = $cari_vio->department;

                        $search_employee = DB::table('employees')->where('number_of_employees', '=', floor($x['number_of_employees']))->count();
                        if($search_employee > 0){
                            $employee = DB::table('employees')->where('number_of_employees', '=', floor($x['number_of_employees']))->first();
        
                            $employee_id = $employee->id;
                            $_id = $employee->id;
        
                            $signature = DB::table('signatures')->where('status_signature', 'active')->first();
                            
                            $signature_id = $signature->id;
                            
                            $other_information = $x['other_information'];

                            if($x['date_of_violation'] == NULL){
                                $date_of_violation = $cari_vio->date_of_violation;
                            }elseif($x['date_of_violation'] == ""){
                                $date_of_violation = $cari_vio->date_of_violation;
                            }else{
                                $date_of_violation = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['date_of_violation']);
                                if($date_of_violation == 'false'){
                                    $remark = "upload update pelanggaran SP jumlah ".$jumlahTotal;
                                    $action = "upload update";
                            
                                    DB::table('histories')->insert([
                                        'user_id' => auth()->user()->id,
                                        'role_id' => auth()->user()->role_id,
                                        'remark' => $remark,
                                        'action' => $action,
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s')
                                    ]);
                                    return redirect('/hiviolations')->with('danger', 'Data Karyawan Mulai dari baris '. floor($x['number_of_employees']) . ' Format Tanggal date_of_violation salah. Pastikan kolom date dengan performatan date yang benar !');
                                }
                            }

                            if($x['reporting_date'] == NULL){
                                $reporting_date = $cari_vio->reporting_date;
                            }elseif($x['reporting_date'] == ""){
                                $reporting_date = $cari_vio->reporting_date;
                            }else{
                                $reporting_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($x['reporting_date']);
                                if($date_of_violation == 'false'){
                                    $remark = "upload update pelanggaran SP jumlah ".$jumlahTotal;
                                    $action = "upload update";
                            
                                    DB::table('histories')->insert([
                                        'user_id' => auth()->user()->id,
                                        'role_id' => auth()->user()->role_id,
                                        'remark' => $remark,
                                        'action' => $action,
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s')
                                    ]);
                                    return redirect('/hiviolations')->with('danger', 'Data Karyawan Mulai dari baris '. floor($x['number_of_employees']) . ' Format Tanggal reporting_date salah. Pastikan kolom date dengan performatan date yang benar !');
                                }
                            }      

                            $datev = new $date_of_violation;
                            $dater = new $reporting_date;
                            $resultv = $datev->format('Y-m-d');
                            $resultr = $dater->format('Y-m-d');
                            // $alphabet_id = floor($x['alphabet_id']);                  
                        
                        //hitung sp terakhir ada apa tidak
                        $sel_num_vio = DB::table('violations')
                            ->where('employee_id', $employee->id)
                            ->where('violation_status', '!=', 'cancel')
                            ->where('id', '<', $violation_id)
                            ->count();
              
                            //jika ada sp masaih aktif
                        if($sel_num_vio > 0){
                        
                            //taampilkan sp terkhhiir
                            $sel_last_vio = DB::table('violations')
                                ->where('employee_id', $employee->id)
                                ->where('violation_status', '!=', 'cancel')
                                ->where('date_end_violation', '>=', $resultr)
                                ->where('id', '<', $violation_id)
                                ->orderByDesc('id')
                                ->first();

                                // jika sp terakhir sama dengan Peringatan LIsan
                            if($sel_last_vio->type_of_violation == "Peringatan Lisan"){
                            
                              $sp_lisan_terakhir = $sel_last_vio->violation_status;
              
                                // cari sp sebelum sp lisan yang aktif
                                $cari_sp_sebelum_sp_lisan = DB::table('violations')
                                    ->where('employee_id', $employee->id)
                                    ->where('violation_status', '!=', 'cancel')
                                    ->where('date_end_violation', '>=', $resultr)
                                    ->where('id', '<', $sel_last_vio->id)
                                    ->count();
              
                                    // jika ada sebelum sp lisan yang aktif
                                if($cari_sp_sebelum_sp_lisan > 0){
              
                                  // cari sp terakhir sebelum sp lisan active
                                    $count_sp_terakhir_sebelum_sp_lisan = DB::table('violations')
                                        ->where('employee_id', $employee->id)
                                        ->where('violation_status', '!=', 'cancel')
                                        ->where('date_end_violation', '>=', $resultr)
                                        ->where('id', '<', $sel_last_vio->id)
                                        ->where("type_of_violation", "!=" , "Peringatan Lisan")
                                        ->count();
              
                                        // jika ada sp terakhir sebelum sp lisan active
                                    if($count_sp_terakhir_sebelum_sp_lisan > 0){
              
                                        //tampilkan sp terakhir sebelum sp lisan active
                                        $cari_sp_terakhir_sebelum_sp_lisan = DB::table('violations')
                                            ->where('employee_id', $employee->id)
                                            ->where('violation_status', '!=', 'cancel')
                                            ->where('date_end_violation', '>=', $resultr)
                                            ->where('id', '<', $sel_last_vio->id)
                                            ->where("type_of_violation", "!=" , "Peringatan Lisan")
                                            ->orderByDesc('id')
                                            ->first();
              
                                            // $cari_sp_terakhir_sebelum_sp_lisan_type = cari_sp_terakhir_sebelum_sp_lisan_type($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation);
                                        
                                            if($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Peringatan Lisan"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 0.5;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Surat Peringatan Pertama"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 1;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Surat Peringatan Kedua"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 2;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Surat Peringatan Ketiga"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 3;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Surat Peringatan Terakhir"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 4;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Pemutusan Hubungan Kerja"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 5;    
                                            }

                                            //cari sp lisan sebelum sp lisan
                                        $cari_sp_lisan_sebelum_sp_lisan = DB::table("violations")
                                            ->where("employee_id", $employee->id)
                                            ->where("violation_status", "!=", "cancel")
                                            ->where('date_end_violation', '>=', $resultr)
                                            ->where("type_of_violation", "Peringatan Lisan")
                                            ->where("id", "<", $sel_last_vio->id)
                                            ->count();
                                        
                                        // sp_gab($cari_sp_lisan_sebelum_sp_lisan);
                                        if($cari_sp_lisan_sebelum_sp_lisan == 1){
                                            $s_p_1 = 0;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }elseif($cari_sp_lisan_sebelum_sp_lisan == 2){
                                            $s_p_1 = 0.5;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }elseif($cari_sp_lisan_sebelum_sp_lisan == 3){
                                            $s_p_1 = 0;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }elseif($cari_sp_lisan_sebelum_sp_lisan == 4){
                                            $s_p_1 = 0;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }else{
                                            $s_p_1 = 0;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }
              
                                        // jika tidak ada sp terakhir sebelum sp lisan active selain sp lisan
                                    }else{
                                      $sp_gab = 0.5;
                                    }
              
                                // jika tidak ada sp terakhir setelah SP lisan
                                }else{
                                    $s_p_1 = 0.5;
                                    $sp_gab = $s_p_1;
                                }
              
                                // jika sp terakhir tidak sama dengan Peringatan Lisan
                            }else{
              
                                // $cari_sp_terakhir_sebelum_sp_lisan_type = cari_sp_terakhir_sebelum_sp_lisan_type($sel_last_vio->type_of_violation);
                                if($sel_last_vio->type_of_violation == "Peringatan Lisan"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 0.5;
                                }elseif($sel_last_vio->type_of_violation == "Surat Peringatan Pertama"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 1;
                                }elseif($sel_last_vio->type_of_violation == "Surat Peringatan Kedua"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 2;
                                }elseif($sel_last_vio->type_of_violation == "Surat Peringatan Ketiga"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 3;
                                }elseif($sel_last_vio->type_of_violation == "Surat Peringatan Terakhir"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 4;
                                }elseif($sel_last_vio->type_of_violation == "Pemutusan Hubungan Kerja"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 5;    
                                }

                                $cari_sp_lisan_sebelum_sp_lisan = DB::table('violations')
                                    ->where('employee_id', $employee->id)
                                    ->where('violation_status', '!=', 'cancel')
                                    ->where('date_end_violation', '>=', $resultr)
                                    ->where('type_of_violation', 'Peringatan Lisan')
                                    ->where('id', '<', $sel_last_vio->id)
                                    ->count();
              
                                if($cari_sp_lisan_sebelum_sp_lisan == 1){
                                    $s_p_1 = 0.5;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }elseif($cari_sp_lisan_sebelum_sp_lisan == 2){
                                    $s_p_1 = 0;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }elseif($cari_sp_lisan_sebelum_sp_lisan == 3){
                                    $s_p_1 = 0.5;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }elseif($cari_sp_lisan_sebelum_sp_lisan == 4){
                                    $s_p_1 = 0;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }else{
                                    $s_p_1 = 0;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }
                            }
                           
                                if($sp_gab == 0.5){
                                    $status_type_violation_akhir = 'Peringatan Lisan';
                                }elseif($sp_gab >= 1 AND $sp_gab <= 1.5){
                                    $status_type_violation_akhir = 'Surat Peringatan Pertama';
                                }elseif($sp_gab >= 2 AND $sp_gab <= 2.5){
                                    $status_type_violation_akhir = 'Surat Peringatan Kedua';
                                }elseif($sp_gab >= 3 AND $sp_gab <= 3.5){
                                    $status_type_violation_akhir = 'Surat Peringatan Ketiga';
                                }elseif($sp_gab >= 4 AND $sp_gab <= 4.5){
                                    $status_type_violation_akhir = 'Surat Peringatan Terakhir';
                                }elseif($sp_gab >= 5 AND $sp_gab <= 5.5){
                                    $status_type_violation_akhir = 'Pemutusan Hubungan Kerja';
                                } 
                                              
                                $sta_viol = $sel_last_vio->violation_status;
                                $type_viol = $status_type_violation_akhir;
                                $last_accumulation = $sp_gab;
                
                            }else{
                                $sp_gab = 0;
                
                                $sta_viol = 'notactive';
                                $type_viol = 'notviolation';
                                $last_accumulation = $sp_gab;
                            }
        
                            // $alphabet_id = floor($x['alphabet_id']);
                            $cek_alphabet = is_numeric($x['alphabet_id']);
                            if($cek_alphabet == 1){
                                $alphabet_id = floor($x['alphabet_id']);
                            }else{
                                $remark = "upload update pelanggaran SP jumlah ".$jumlahTotal;
                                $action = "upload update";
                        
                                DB::table('histories')->insert([
                                    'user_id' => auth()->user()->id,
                                    'role_id' => auth()->user()->role_id,
                                    'remark' => $remark,
                                    'action' => $action,
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
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
                
                            // if($num_sp < 1){
                            //     $no_sp = $x['no'];
                                
                            // }elseif($num_sp > 0){
                            //     $last_sp = DB::table('violations')
                            //         ->whereMonth('date_of_violation', $bul)
                            //         ->whereYear('date_of_violation',  $yaer_y_bul)  
                            //         ->orderByDesc('no_violation')
                            //         ->first();
                            //         // $no_sp = $last_sp->no_violation + floor($x['no']);
                            //         $no_sp = $last_sp->no_violation + 1;
                            // }
        
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
        
                                require 'violationupdate.php';
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
                                        require 'GetViolationArticleUpdateTest.php';
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
                                        require 'violationupdate.php';
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
                                                require 'GetViolationArticleUpdateTest.php';
        
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
              
                                                require 'violationupdate.php';
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
                                    
                                                            require 'GetViolationArticleUpdateTest.php';
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
                                                            require 'violationupdate.php';
                                                        }else{
                                                            //LOGIKA AKUMULSAI PERTAMA
                                                            require 'GetViolationArticleUpdateTest.php';
                                                            
                                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                            $violation_accumulation2 = null;    
                                                            $violation_accumulation3 = null;  
                                                            require 'violationupdate.php';
                                                        }
                                    
                                                }else{
                                                    //LOGIKA AKUMULSAI PERTAMA
                                                    require 'GetViolationArticleUpdateTest.php';
                                                    
                                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                    $violation_accumulation2 = null;    
                                                    $violation_accumulation3 = null;  
                                                    require 'violationupdate.php';
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
                            
                                                    require 'GetViolationArticleUpdateTest.php';
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
                                                    require 'violationupdate.php';
                                                }else{
                                                    //LOGIKA AKUMULSAI PERTAMA
                                                    require 'GetViolationArticleUpdateTest.php';
                                                    
                                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                    $violation_accumulation2 = null;    
                                                    $violation_accumulation3 = null;  
                                                    require 'violationupdate.php';
                                                }
                            
                                        }else{
                                            //LOGIKA AKUMULSAI PERTAMA
                                            require 'GetViolationArticleUpdateTest.php';
                                            
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = null;    
                                            $violation_accumulation3 = null;  
                                            require 'violationupdate.php';
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
                                            require 'GetViolationArticleUpdateTest.php';
                    
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
            
                                            require 'violationupdate.php';
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
                                
                                                        require 'GetViolationArticleUpdateTest.php';
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
                                                        require 'violationupdate.php';
                                                    }else{
                                                        //LOGIKA AKUMULSAI PERTAMA
                                                        require 'GetViolationArticleUpdateTest.php';
                                                        
                                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                        $violation_accumulation2 = null;    
                                                        $violation_accumulation3 = null;  
                                                    }
                            
                                                }else{
                                                    //LOGIKA AKUMULSAI PERTAMA
                                                    require 'GetViolationArticleUpdateTest.php';
                                                    
                                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                    $violation_accumulation2 = null;    
                                                    $violation_accumulation3 = null; 
                                                    require 'violationupdate.php'; 
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
                            
                                                    require 'GetViolationArticleUpdateTest.php';
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
                                                    require 'violationupdate.php';
                                                }else{
                                                    //LOGIKA AKUMULSAI PERTAMA
                                                    require 'GetViolationArticleUpdateTest.php';
                                                    
                                                    $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                    $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                    $violation_accumulation2 = null;    
                                                    $violation_accumulation3 = null;  
                                                    require 'violationupdate.php';
                                                }
                        
                                            }else{
                                                //LOGIKA AKUMULSAI PERTAMA
                                                require 'GetViolationArticleUpdateTest.php';
                                                
                                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                $violation_accumulation2 = null;    
                                                $violation_accumulation3 = null;  
                                                require 'violationupdate.php';
                                            }
                                        
                                        }
                                    }
                                } 
                                $jumlahTotal += 1;
                            }

                        }
                    }
    
            endforeach;
            

            $remark = "upload update pelanggaran SP jumlah ".$jumlahTotal;
            $action = "upload update";
    
            DB::table('histories')->insert([
                'user_id' => auth()->user()->id,
                'role_id' => auth()->user()->role_id,
                'remark' => $remark,
                'action' => $action,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

    
        endforeach;

        return redirect('/hiviolations')->with('success', 'Data Pelanggaran Berhasil di update!');
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
                                 
                        //hitung sp terakhir ada apa tidak
                        $sel_num_vio = DB::table('violations')
                            ->where('employee_id', $employee->id)
                            ->where('violation_status', '!=', 'cancel')
                            ->where('violation_status', 'active')
                            ->count();
              
                            //jika ada sp masaih aktif
                        if($sel_num_vio > 0){
                        
                            //taampilkan sp terkhhiir
                            $sel_last_vio = DB::table('violations')
                                ->where('employee_id', $employee->id)
                                ->where('violation_status', '!=', 'cancel')
                                ->where('violation_status', 'active')
                                ->orderByDesc('id')
                                ->first();
              
                                // jika sp terakhir sama dengan Peringatan LIsan
                            if($sel_last_vio->type_of_violation == "Peringatan Lisan"){
                            
                              $sp_lisan_terakhir = $sel_last_vio->violation_status;
              
                                // cari sp sebelum sp lisan yang aktif
                                $cari_sp_sebelum_sp_lisan = DB::table('violations')
                                    ->where('employee_id', $employee->id)
                                    ->where('violation_status', '!=', 'cancel')
                                    ->where('violation_status', 'active')
                                    ->where('id', '<', $sel_last_vio->id)
                                    ->count();
              
                                    // jika ada sebelum sp lisan yang aktif
                                if($cari_sp_sebelum_sp_lisan > 0){
              
                                  // cari sp terakhir sebelum sp lisan active
                                    $count_sp_terakhir_sebelum_sp_lisan = DB::table('violations')
                                        ->where('employee_id', $employee->id)
                                        ->where('violation_status', '!=', 'cancel')
                                        ->where('violation_status', 'active')
                                        ->where('id', '<', $sel_last_vio->id)
                                        ->where("type_of_violation", "!=" , "Peringatan Lisan")
                                        ->count();
              
                                        // jika ada sp terakhir sebelum sp lisan active
                                    if($count_sp_terakhir_sebelum_sp_lisan > 0){
              
                                        //tampilkan sp terakhir sebelum sp lisan active
                                        $cari_sp_terakhir_sebelum_sp_lisan = DB::table('violations')
                                            ->where('employee_id', $employee->id)
                                            ->where('violation_status', '!=', 'cancel')
                                            ->where('violation_status', 'active')
                                            ->where('id', '<', $sel_last_vio->id)
                                            ->where("type_of_violation", "!=" , "Peringatan Lisan")
                                            ->orderByDesc('id')
                                            ->first();
              
                                            // $cari_sp_terakhir_sebelum_sp_lisan_type = cari_sp_terakhir_sebelum_sp_lisan_type($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation);
                                        
                                            if($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Peringatan Lisan"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 0.5;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Surat Peringatan Pertama"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 1;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Surat Peringatan Kedua"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 2;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Surat Peringatan Ketiga"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 3;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Surat Peringatan Terakhir"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 4;
                                            }elseif($cari_sp_terakhir_sebelum_sp_lisan->type_of_violation == "Pemutusan Hubungan Kerja"){
                                                $cari_sp_terakhir_sebelum_sp_lisan_type = 5;    
                                            }

                                            //cari sp lisan sebelum sp lisan
                                        $cari_sp_lisan_sebelum_sp_lisan = DB::table("violations")
                                            ->where("employee_id", $employee->id)
                                            ->where("violation_status", "!=", "cancel")
                                            ->where("violation_status", "active")
                                            ->where("type_of_violation", "Peringatan Lisan")
                                            ->where("id", "<", $sel_last_vio->id)
                                            ->count();
                                        
                                        // sp_gab($cari_sp_lisan_sebelum_sp_lisan);
                                        if($cari_sp_lisan_sebelum_sp_lisan == 1){
                                            $s_p_1 = 0;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }elseif($cari_sp_lisan_sebelum_sp_lisan == 2){
                                            $s_p_1 = 0.5;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }elseif($cari_sp_lisan_sebelum_sp_lisan == 3){
                                            $s_p_1 = 0;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }elseif($cari_sp_lisan_sebelum_sp_lisan == 4){
                                            $s_p_1 = 0;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }else{
                                            $s_p_1 = 0;
                                            $sp_last = 0.5;
                                            $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                            $sp_gab = $sp_tidak_lisan + $s_p_1 + $sp_last;
                                        }
              
                                        // jika tidak ada sp terakhir sebelum sp lisan active selain sp lisan
                                    }else{
                                      $sp_gab = 0.5;
                                    }
              
                                // jika tidak ada sp terakhir setelah SP lisan
                                }else{
                                    $s_p_1 = 0.5;
                                    $sp_gab = $s_p_1;
                                }
              
                                // jika sp terakhir tidak sama dengan Peringatan Lisan
                            }else{
              
                                // $cari_sp_terakhir_sebelum_sp_lisan_type = cari_sp_terakhir_sebelum_sp_lisan_type($sel_last_vio->type_of_violation);
                                if($sel_last_vio->type_of_violation == "Peringatan Lisan"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 0.5;
                                }elseif($sel_last_vio->type_of_violation == "Surat Peringatan Pertama"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 1;
                                }elseif($sel_last_vio->type_of_violation == "Surat Peringatan Kedua"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 2;
                                }elseif($sel_last_vio->type_of_violation == "Surat Peringatan Ketiga"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 3;
                                }elseif($sel_last_vio->type_of_violation == "Surat Peringatan Terakhir"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 4;
                                }elseif($sel_last_vio->type_of_violation == "Pemutusan Hubungan Kerja"){
                                    $cari_sp_terakhir_sebelum_sp_lisan_type = 5;    
                                }

                                $cari_sp_lisan_sebelum_sp_lisan = DB::table('violations')
                                    ->where('employee_id', $employee->id)
                                    ->where('violation_status', '!=', 'cancel')
                                    ->where('violation_status', 'active')
                                    ->where('type_of_violation', 'Peringatan Lisan')
                                    ->where('id', '<', $sel_last_vio->id)
                                    ->count();
              
                                if($cari_sp_lisan_sebelum_sp_lisan == 1){
                                    $s_p_1 = 0.5;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }elseif($cari_sp_lisan_sebelum_sp_lisan == 2){
                                    $s_p_1 = 0;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }elseif($cari_sp_lisan_sebelum_sp_lisan == 3){
                                    $s_p_1 = 0.5;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }elseif($cari_sp_lisan_sebelum_sp_lisan == 4){
                                    $s_p_1 = 0;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }else{
                                    $s_p_1 = 0;
                                    $sp_tidak_lisan = $cari_sp_terakhir_sebelum_sp_lisan_type;
                                    $sp_gab = $sp_tidak_lisan + $s_p_1;
                                }
                            }
                           
                                if($sp_gab == 0.5){
                                    $status_type_violation_akhir = 'Peringatan Lisan';
                                }elseif($sp_gab >= 1 AND $sp_gab <= 1.5){
                                    $status_type_violation_akhir = 'Surat Peringatan Pertama';
                                }elseif($sp_gab >= 2 AND $sp_gab <= 2.5){
                                    $status_type_violation_akhir = 'Surat Peringatan Kedua';
                                }elseif($sp_gab >= 3 AND $sp_gab <= 3.5){
                                    $status_type_violation_akhir = 'Surat Peringatan Ketiga';
                                }elseif($sp_gab >= 4 AND $sp_gab <= 4.5){
                                    $status_type_violation_akhir = 'Surat Peringatan Terakhir';
                                }elseif($sp_gab >= 5 AND $sp_gab <= 5.5){
                                    $status_type_violation_akhir = 'Pemutusan Hubungan Kerja';
                                } 
                                              
                            $sta_viol = $sel_last_vio->violation_status;
                            $type_viol = $status_type_violation_akhir;
                            $last_accumulation = $sp_gab;
              
                        }else{
                            $sp_gab = 0;
              
                            $sta_viol = 'notactive';
                            $type_viol = 'notviolation';
                            $last_accumulation = $sp_gab;
                            
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
                                    require 'GetViolationArticleTest.php';
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
                                            require 'GetViolationArticleTest.php';
    
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
                                
                                                        require 'GetViolationArticleTest.php';
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
                                                        require 'GetViolationArticleTest.php';
                                                        
                                                        $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                        $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                        $violation_accumulation2 = null;    
                                                        $violation_accumulation3 = null;  
                                                        require 'violationinsert.php';
                                                    }
                                
                                            }else{
                                                //LOGIKA AKUMULSAI PERTAMA
                                                require 'GetViolationArticleTest.php';
                                                
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
                        
                                                require 'GetViolationArticleTest.php';
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
                                                require 'GetViolationArticleTest.php';
                                                
                                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                $violation_accumulation2 = null;    
                                                $violation_accumulation3 = null;  
                                                require 'violationinsert.php';
                                            }
                        
                                    }else{
                                        //LOGIKA AKUMULSAI PERTAMA
                                        require 'GetViolationArticleTest.php';
                                        
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
                                    require 'GetViolationArticleTest.php';
            
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
                        
                                                require 'GetViolationArticleTest.php';
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
                                                require 'GetViolationArticleTest.php';
                                                
                                                $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                                $violation_accumulation = $pelanggran_sebelumnya->id;    
                                                $violation_accumulation2 = null;    
                                                $violation_accumulation3 = null;  
                                            }
                    
                                        }else{
                                            //LOGIKA AKUMULSAI PERTAMA
                                            require 'GetViolationArticleTest.php';
                                            
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
                    
                                            require 'GetViolationArticleTest.php';
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
                                            require 'GetViolationArticleTest.php';
                                            
                                            $alphabet_accumulation = $pasal_alphabet_accumulation;    
                                            $violation_accumulation = $pelanggran_sebelumnya->id;    
                                            $violation_accumulation2 = null;    
                                            $violation_accumulation3 = null;  
                                            require 'violationinsert.php';
                                        }
                
                                    }else{
                                        //LOGIKA AKUMULSAI PERTAMA
                                        require 'GetViolationArticleTest.php';
                                        
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

}
